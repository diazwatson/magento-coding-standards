# Magento Coding Standard [![Build Status](https://travis-ci.org/diazwatson/magento-coding-standards.svg?branch=master)](https://travis-ci.org/diazwatson/magento-coding-standards)

Magento Coding Standard is a set of rules and sniffs for [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) tool.

It allows automatically check your code against some of the common Magento and PHP coding issues, like:
- raw SQL queries;
- SQL queries inside a loop;
- Direct class instantiation;
- Unnecessary collection loading;
- Excessive code complexity;
- Use of dangerous functions;
- Use of PHP super globals;
- Code style issues

and many others.

**Magento Coding Standard** consists of two rulesets - Magento1 for Magento and Magento2 for Magento 2. Each of them contains the rules depending on the requirements of each version.

## Usage
```sh
$ cd magento-coding-standard
```
Select the standard to run with PHP_CodeSniffer. To check Magento extension run:
```sh
$ vendor/bin/phpcs /path/to/your/extension --standard=Magento1
```
To check Magento 2 extension run:
```sh
$ vendor/bin/phpcs /path/to/your/extension --standard=Magento2
```
By default, PHP_CodeSniffer will check any file it finds with a `.inc`, .`php`, `.js` or `.css` extension. To check design templates you can specify `--extensions=php,phtml` option.

To check syntax with specific PHP version set paths to php binary dir:
```sh
$ vendor/bin/phpcs --config-set php7.1_path /path/to/your/php7.1
$ vendor/bin/phpcs --config-set php7.0_path /path/to/your/php7
$ vendor/bin/phpcs --config-set php5.4_path /path/to/your/php5.4
```
# Fixing Errors Automatically

PHP_CodeSniffer offers the PHP Code Beautifier and Fixer (`phpcbf`) tool. It can be used in place of `phpcs` to automatically generate and fix all fixable issues. We highly recommend run following command to fix as many sniff violations as possible:
```sh
$ vendor/bin/phpcbf /path/to/your/extension --standard=Magento2
```
# Dynamic Sniffs

Sniffs with complex logic, like Magento2.Classes.CollectionDependency and Magento2.SQL.CoreTablesModification require path to installed Magento 2 instance. You can specify it by running following command:
```sh
$ vendor/bin/phpcs --config-set m2-path /path/to/magento2
```

>Notice: Dynamic sniffs will not work without specified ```m2-path``` configuration option.

>Notice: Don't forget to clear `cache` folder in project root directory if you want to run sniffs for other Magento versions.

# Marketplace Technical Review
To make sure your extension will pass CodeSniffer checks of Magento Marketplace Technical Review, you could run `phpcs` command with `--severity=10` option.
```sh
$ vendor/bin/phpcs /path/to/your/extension --standard=Magento2 --severity=10 --extensions=php,phtml
```
**All severity 10 errors must be fixed in order to successfully pass Level 1 CodeSniffer checks.**
 
## Requirements

* PHP >=5.5.0
* [Composer](https://getcomposer.org)
* [PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer) 3.*

> Notice: PHP and Composer should be accessible globally.

## Contribution

Please feel free to contribute new sniffs or any fixes or improvements for the existing ones.
