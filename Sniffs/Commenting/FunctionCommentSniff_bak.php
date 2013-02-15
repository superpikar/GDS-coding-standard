<?php
///**
// * This file is part of the Symfony2-coding-standard (phpcs standard)
// *
// * PHP version 5
// *
// * @category PHP
// * @package  JDS
// * @author   Symfony2-phpcs-authors <Symfony2-coding-standard@opensky.github.com>
// * @author   Ahmad Dzulfikar Adi Putra <dzulfikar.adiputra@gmail.com>
// * @license  http://spdx.org/licenses/MIT MIT License
// * @version  GIT: master
// * @link     https://github.com/opensky/Symfony2-coding-standard
// */
//
//if (class_exists('PHP_CodeSniffer_CommentParser_ClassCommentParser', true) === false) {
//    $error = 'Class PHP_CodeSniffer_CommentParser_ClassCommentParser not found';
//    throw new PHP_CodeSniffer_Exception($error);
//}
//
//if (class_exists('PEAR_Sniffs_Commenting_FileCommentSniff', true) === false) {
//    $error = 'Class PEAR_Sniffs_Commenting_FileCommentSniff not found';
//    throw new PHP_CodeSniffer_Exception($error);
//}
//
///**
// * Symfony2 standard customization to PEARs FunctionCommentSniff.
// *
// * Verifies that :
// * <ul>
// *  <li>There is a &#64;return tag if a return statement exists inside the method</li>
// * </ul>
// *
// * @category PHP
// * @package  PHP_CodeSniffer
// * @author   Felix Brandt <mail@felixbrandt.de>
// * @license  http://spdx.org/licenses/BSD-3-Clause BSD 3-clause "New" or "Revised" License
// * @link     http://pear.php.net/package/PHP_CodeSniffer
// */
//class JDS_Sniffs_Commenting_FunctionCommentSniff extends PEAR_Sniffs_Commenting_FileCommentSniff
//{
//    /**
//     * The header comment parser for the current file.
//     *
//     * @var PHP_CodeSniffer_Comment_Parser_ClassCommentParser
//     */
//    protected $commentParser = null;
//    protected $additionalCommentParser = null;
//
//    /**
//     * The current PHP_CodeSniffer_File object we are processing.
//     *
//     * @var PHP_CodeSniffer_File
//     */
//    protected $currentFile = null;
//
//    /**
//     * Tags in correct order and related info.
//     *
//     * @var array
//     */
//    protected $tags = array(
//        'category'   => array(
//            'required'       => false,
//            'allow_multiple' => false,
//            'order_text'     => 'precedes @package',
//        ),
//        'package'    => array(
//            'required'       => false,
//            'allow_multiple' => false,
//            'order_text'     => 'follows @category',
//        ),
//        'subpackage' => array(
//            'required'       => false,
//            'allow_multiple' => false,
//            'order_text'     => 'follows @package',
//        ),
//        'author'     => array(
//            'required'       => true,
//            'allow_multiple' => true,
//            'order_text'     => 'follows @subpackage (if used) or @package',
//        ),
//        'copyright'  => array(
//            'required'       => false,
//            'allow_multiple' => true,
//            'order_text'     => 'follows @author',
//        ),
//        'license'    => array(
//            'required'       => false,
//            'allow_multiple' => false,
//            'order_text'     => 'follows @copyright (if used) or @author',
//        ),
//        'version'    => array(
//            'required'       => false,
//            'allow_multiple' => false,
//            'order_text'     => 'follows @license',
//        ),
//        'link'       => array(
//            'required'       => false,
//            'allow_multiple' => true,
//            'order_text'     => 'follows @version',
//        ),
//        'see'        => array(
//            'required'       => false,
//            'allow_multiple' => true,
//            'order_text'     => 'follows @link',
//        ),
//        'since'      => array(
//            'required'       => false,
//            'allow_multiple' => false,
//            'order_text'     => 'follows @see (if used) or @link',
//        ),
//        'deprecated' => array(
//            'required'       => false,
//            'allow_multiple' => false,
//            'order_text'     => 'follows @since (if used) or @see (if used) or @link',
//        ),
//    );
//
//    /**
//     * Tags in correct order and related info.
//     *
//     * @var array
//     */
//    protected $secondTags = array(
//        'access'   => array(
//            'required'       => true,
//            'allow_multiple' => false,
//            'order_text'     => 'precedes @package',
//        ),
//    );
//
//    /**
//     *
//     * @return type
//     */
//    public function register()
//    {
//        return array(T_FUNCTION);
//    }
//
//    /**
//     *
//     * @param PHP_CodeSniffer_File $phpcsFile The current file being processed.
//     * @param int                  $stackPtr  The position of the current token
//     *                                        in the stack passed in $tokens.
//     */
//    public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
//    {
//        $find = array(
//                 T_COMMENT,
//                 T_DOC_COMMENT,
//                 T_CLASS,
//                 T_FUNCTION,
//                 T_OPEN_TAG,
//            );
//        $docBlockType = 'function';
//
//        $commentEnd = $phpcsFile->findPrevious($find, ($stackPtr - 1));
//
//        if ($commentEnd === false) {
//            return;
//        }
//
//        $this->currentFile = $phpcsFile;
//        $tokens            = $phpcsFile->getTokens();
//
//        // If the token that we found was a class or a function, then this
//        // function has no doc comment.
//        $code = $tokens[$commentEnd]['code'];
//
//        if ($code === T_COMMENT) {
//            $error = 'You must use "/**" style comments for a function comment';
//            $phpcsFile->addError($error, $stackPtr, 'WrongStyle');
//            return;
//        } else if ($code !== T_DOC_COMMENT) {
//            $phpcsFile->addError('Missing function doc comment', $stackPtr, 'Missing');
//            return;
//        }
//
//        // If there is any code between the function keyword and the doc block
//        // then the doc block is not for us.
//        $ignore    = PHP_CodeSniffer_Tokens::$scopeModifiers;
//        $ignore[]  = T_STATIC;
//        $ignore[]  = T_WHITESPACE;
//        $ignore[]  = T_ABSTRACT;
//        $ignore[]  = T_FINAL;
//        $prevToken = $phpcsFile->findPrevious($ignore, ($stackPtr - 1), null, true);
//        if ($prevToken !== $commentEnd) {
//            $phpcsFile->addError('Missing function doc comment', $stackPtr, 'Missing');
//            return;
//        }
//
//        $this->_functionToken = $stackPtr;
//
//        $this->_classToken = null;
//        foreach ($tokens[$stackPtr]['conditions'] as $condPtr => $condition) {
//            if ($condition === T_CLASS || $condition === T_INTERFACE) {
//                $this->_classToken = $condPtr;
//                break;
//            }
//        }
//
//        // If the first T_OPEN_TAG is right before the comment, it is probably
//        // a file comment.
//        $commentStart = ($phpcsFile->findPrevious(T_DOC_COMMENT, ($commentEnd - 1), null, true) + 1);
//        $prevToken    = $phpcsFile->findPrevious(T_WHITESPACE, ($commentStart - 1), null, true);
//        if ($tokens[$prevToken]['code'] === T_OPEN_TAG) {
//            // Is this the first open tag?
//            if ($stackPtr === 0 || $phpcsFile->findPrevious(T_OPEN_TAG, ($prevToken - 1)) === false) {
//                $phpcsFile->addError('Missing function doc comment', $stackPtr, 'Missing');
//                return;
//            }
//        }
//
//        $comment           = $phpcsFile->getTokensAsString($commentStart, ($commentEnd - $commentStart + 1));
//        $this->_methodName = $phpcsFile->getDeclarationName($stackPtr);
//
//        try {
//            $this->commentParser = new PHP_CodeSniffer_CommentParser_ClassCommentParser($comment, $phpcsFile);
//            $this->commentParser->parse();
//
//            // I add this because need to parse secondTags
//            $this->additionalCommentParser = new JDS_Sniffs_Commenting_AdditionalClassCommentParser($comment, $phpcsFile);
//            $this->additionalCommentParser->parse();
//
//        } catch (PHP_CodeSniffer_CommentParser_ParserException $e) {
//            $line = ($e->getLineWithinComment() + $commentStart);
//            $phpcsFile->addError($e->getMessage(), $line, 'FailedParse');
//            return;
//        }
//        $comment = $this->commentParser->getComment();
//        if (is_null($comment) === true) {
//            $error = 'Function doc comment is empty';
//            $phpcsFile->addError($error, $commentStart, 'Empty');
//            return;
//        }
//
//        // process the default tags for function
//        $this->processTags($commentStart, $commentEnd);
//
//        // process additional tags for function
//        $this->processAnotherTags($commentStart, $commentEnd, 'function');
//    }
//
//
//    /**
//     *
//     * @param type $commentStart
//     * @param type $commentEnd
//     * @param type $arrayTags
//     * @param type $docBlockType
//     */
//    protected function processAnotherTags($commentStart, $commentEnd, $docBlockType)
//    {
//        $this->commentParser = $this->additionalCommentParser;
//        $docBlock    = $docBlockType;
//        $foundTags   = $this->commentParser->getTagOrders();
//        $orderIndex  = 0;
//        $indentation = array();
//        $longestTag  = 0;
//        $errorPos    = 0;
//
//        foreach ($arrayTags as $tag => $info) {
//            // Required tag missing.
//            if ($info['required'] === true && in_array($tag, $foundTags) === false) {
//                $error = 'Missing @%s tag in %s comment';
//                $data  = array(
//                              $tag,
//                              $docBlock,
//                             );
//                $this->currentFile->addError($error, $commentEnd, 'MissingTag', $data);
//                continue;
//            }
//
//             // Get the line number for current tag.
//            $tagName = ucfirst($tag);
//            if ($info['allow_multiple'] === true) {
//                $tagName .= 's';
//            }
//
//            $getMethod  = 'get'.$tagName;
//            $tagElement = $this->commentParser->$getMethod();
//            if (is_null($tagElement) === true || empty($tagElement) === true) {
//                continue;
//            }
//
//            $errorPos = $commentStart;
//            if (is_array($tagElement) === false) {
//                $errorPos = ($commentStart + $tagElement->getLine());
//            }
//
//            // Get the tag order.
//            $foundIndexes = array_keys($foundTags, $tag);
//
//            if (count($foundIndexes) > 1) {
//                // Multiple occurance not allowed.
//                if ($info['allow_multiple'] === false) {
//                    $error = 'Only 1 @%s tag is allowed in a %s comment';
//                    $data  = array(
//                              $tag,
//                              $docBlock,
//                             );
//                    $this->currentFile->addError($error, $errorPos, 'DuplicateTag', $data);
//                } else {
//                    // Make sure same tags are grouped together.
//                    $i     = 0;
//                    $count = $foundIndexes[0];
//                    foreach ($foundIndexes as $index) {
//                        if ($index !== $count) {
//                            $errorPosIndex
//                                = ($errorPos + $tagElement[$i]->getLine());
//                            $error = '@%s tags must be grouped together';
//                            $data  = array($tag);
//                            $this->currentFile->addError($error, $errorPosIndex, 'TagsNotGrouped', $data);
//                        }
//
//                        $i++;
//                        $count++;
//                    }
//                }
//            }//end if
//
//            // Check tag order.
//            if ($foundIndexes[0] > $orderIndex) {
//                $orderIndex = $foundIndexes[0];
//            } else {
//                if (is_array($tagElement) === true && empty($tagElement) === false) {
//                    $errorPos += $tagElement[0]->getLine();
//                }
//
//                $error = 'The @%s tag is in the wrong order; the tag %s';
//                $data  = array(
//                          $tag,
//                          $info['order_text'],
//                         );
//                $this->currentFile->addError($error, $errorPos, 'WrongTagOrder', $data);
//            }
//
//            // Store the indentation for checking.
//            $len = strlen($tag);
//            if ($len > $longestTag) {
//                $longestTag = $len;
//            }
//
//            if (is_array($tagElement) === true) {
//                foreach ($tagElement as $key => $element) {
//                    $indentation[] = array(
//                                      'tag'   => $tag,
//                                      'space' => $this->getIndentation($tag, $element),
//                                      'line'  => $element->getLine(),
//                                     );
//                }
//            } else {
//                $indentation[] = array(
//                                  'tag'   => $tag,
//                                  'space' => $this->getIndentation($tag, $tagElement),
//                                 );
//            }
//
//            $method = 'process'.$tagName;
//            if (method_exists($this, $method) === true) {
//                // Process each tag if a method is defined.
//                call_user_func(array($this, $method), $errorPos);
//            } else {
//                if (is_array($tagElement) === true) {
//                    foreach ($tagElement as $key => $element) {
//                        $element->process(
//                            $this->currentFile,
//                            $commentStart,
//                            $docBlock
//                        );
//                    }
//                } else {
//                     $tagElement->process(
//                         $this->currentFile,
//                         $commentStart,
//                         $docBlock
//                     );
//                }
//            }
//        }
//
//    }//end processUnknownTags
//
//
//}//end class
