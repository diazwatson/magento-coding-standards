<?php

namespace Magento2\Sniffs\Plugins;

use PHP_CodeSniffer\Sniffs\Sniff;
use PHP_CodeSniffer\Files\File;

class MethodSignatureSniff implements Sniff
{
    const PARAMS_QTY = 2;

    const P_BEFORE = 'before';

    const P_AROUND = 'around';

    const P_AFTER = 'after';

    private $prefixes = [
        self::P_BEFORE,
        self::P_AROUND,
        self::P_AFTER
    ];

    /**
     * @var array
     */
    private $exclude = [];

    /**
     * @return array|int[]
     */
    public function register()
    {
        return [T_FUNCTION];
    }

    /**
     * @param File $phpcsFile
     * @param int  $stackPtr
     * @return int|void
     */
    public function process(File $phpcsFile, $stackPtr)
    {
        $functionName = $phpcsFile->getDeclarationName($stackPtr);

        $plugin = $this->startsWith($functionName, $this->prefixes, $this->exclude);
        if ($plugin) {
            $paramsQty = count($phpcsFile->getMethodParameters($stackPtr));
            if ($paramsQty < self::PARAMS_QTY) {
                $phpcsFile->addWarning(
                    'Plugin ' . $functionName . ' function should have at least two parameters.',
                    $stackPtr,
                    'Warning'
                );
            }

            if ($plugin === self::P_BEFORE) {
                return;
            }

            $tokens = $phpcsFile->getTokens();

            $hasReturn = false;
            foreach ($tokens as $currToken) {
                if ($currToken['code'] === T_RETURN && isset($currToken['conditions'][$stackPtr])) {
                    $hasReturn = true;
                    break;
                }
            }

            if (!$hasReturn) {
                $phpcsFile->addError(
                    'Plugin ' . $functionName . ' function must return value.',
                    $stackPtr,
                    'Error'
                );
            }
        }
    }

    /**
     * @param       $haystack
     * @param array $needle
     * @param array $excludeFunctions
     * @return bool|mixed
     */
    private function startsWith($haystack, array $needle, array $excludeFunctions = [])
    {
        if (in_array($haystack, $excludeFunctions, false)) {
            return false;
        }
        $haystackLength = strlen($haystack);
        foreach ($needle as $currPref) {
            $length = strlen($currPref);
            if ($haystackLength !== $length && 0 === strpos($haystack, $currPref)) {
                return $currPref;
            }
        }
        return false;
    }
}
