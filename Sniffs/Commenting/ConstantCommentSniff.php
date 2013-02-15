<?php
/**
 * This file is part of the Symfony2-coding-standard (phpcs standard)
 *
 * PHP version 5
 *
 * @category PHP
 * @package  JDS
 * @author   Symfony2-phpcs-authors <Symfony2-coding-standard@opensky.github.com>
 * @author   Ahmad Dzulfikar Adi Putra <dzulfikar.adiputra@gmail.com>
 * @license  http://spdx.org/licenses/MIT MIT License
 * @version  GIT: master
 * @link     https://github.com/opensky/Symfony2-coding-standard
 */

if (class_exists('PHP_CodeSniffer_CommentParser_ClassCommentParser', true) === false) {
    $error = 'Class PHP_CodeSniffer_CommentParser_ClassCommentParser not found';
    throw new PHP_CodeSniffer_Exception($error);
}

if (class_exists('JDS_Sniffs_Commenting_FunctionCommentSniff', true) === false) {
    $error = 'Class JDS_Sniffs_Commenting_FunctionCommentSniff not found';
    throw new PHP_CodeSniffer_Exception($error);
}

/**
 * Symfony2 standard customization to PEARs FunctionCommentSniff.
 *
 * Verifies that :
 * <ul>
 *  <li>There is a &#64;return tag if a return statement exists inside the method</li>
 * </ul>
 *
 * @category PHP
 * @package  PHP_CodeSniffer
 * @author   Felix Brandt <mail@felixbrandt.de>
 * @license  http://spdx.org/licenses/BSD-3-Clause BSD 3-clause "New" or "Revised" License
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 */
class JDS_Sniffs_Commenting_ConstantCommentSniff extends JDS_Sniffs_Commenting_FunctionCommentSniff
{
    /**
     * The header comment parser for the current file.
     *
     * @var PHP_CodeSniffer_Comment_Parser_ClassCommentParser
     */
    protected $commentParser = null;
    protected $additionalCommentParser = null;

    /**
     * The current PHP_CodeSniffer_File object we are processing.
     *
     * @var PHP_CodeSniffer_File
     */
    protected $currentFile = null;

    /**
     * Tags in correct order and related info.
     *
     * @var array
     */
    protected $tags = array(
        'author'     => array(
            'required'       => true,
            'allow_multiple' => true,
            'order_text'     => 'follows @subpackage (if used) or @package',
        ),
    );

    /**
     * Tags in correct order and related info.
     *
     * @var array
     */
    protected $secondTags = array(
        'const'   => array(
            'required'       => true,
            'allow_multiple' => false,
            'order_text'     => 'precedes @package',
        ),
    );

    /**
     *
     * @return type
     */
    public function register()
    {
        return array(T_CONST);
    }

    /**
     *
     * @param PHP_CodeSniffer_File $phpcsFile The current file being processed.
     * @param int                  $stackPtr  The position of the current token
     *                                        in the stack passed in $tokens.
     */
    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
    {
        $arrayFind = array(
            'find' => array(
                 T_COMMENT,
                 T_DOC_COMMENT,
                 T_CONST,
                 T_OPEN_TAG,
            ),
            'docBlockType' => 'constant',
        );

        $this->processForAsperand($phpcsFile, $stackPtr, $arrayFind );

    }



}//end class
