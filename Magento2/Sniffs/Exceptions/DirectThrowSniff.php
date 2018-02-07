<?php
/**
 * Copyright © Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento2\Sniffs\Exceptions;

/**
 * Class DirectThrowSniff
 * Detects possible direct throws of Exceptions.
 */
class DirectThrowSniff extends \Magento1\Sniffs\Exceptions\DirectThrowSniff
{
    /**
     * String representation of warning.
     */
    // @codingStandardsIgnoreLine
    protected $warningMessage = 'Direct throw of Exception is discouraged. Use \Magento\Framework\Exception\LocalizedException instead.';
}
