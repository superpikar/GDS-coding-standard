<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class JDS_Sniffs_Commenting_AdditionalClassCommentParser extends PHP_CodeSniffer_CommentParser_ClassCommentParser
{
    /**
     * The package element of this class.
     *
     * @var SingleElement
     */
    private $_access = null;

    /**
     * The subpackage element of this class.
     *
     * @var SingleElement
     */
    private $_var = null;

    /**
     * The version element of this class.
     *
     * @var SingleElement
     */
    private $_static = null;

    /**
     * The version element of this class.
     *
     * @var SingleElement
     */
    private $_const = null;


    /**
     * Parses the version tag of this class comment.
     *
     * @param array $tokens The tokens that comprise this tag.
     *
     * @return PHP_CodeSniffer_CommentParser_SingleElement
     */
    protected function parseAccess($tokens)
    {
        $this->_version = new PHP_CodeSniffer_CommentParser_SingleElement(
            $this->previousElement,
            $tokens,
            'access',
            $this->phpcsFile
        );

        return $this->_access;
    }

    /**
     * Returns the version of this class comment.
     *
     * @return PHP_CodeSniffer_CommentParser_SingleElement
     */
    public function getAccess()
    {
        return $this->_access;

    }

    /**
     * Parses the version tag of this class comment.
     *
     * @param array $tokens The tokens that comprise this tag.
     *
     * @return PHP_CodeSniffer_CommentParser_SingleElement
     */
    protected function parseConst($tokens)
    {
        $this->_version = new PHP_CodeSniffer_CommentParser_SingleElement(
            $this->previousElement,
            $tokens,
            'consts',
            $this->phpcsFile
        );

        return $this->_const;
    }

    /**
     * Returns the version of this class comment.
     *
     * @return PHP_CodeSniffer_CommentParser_SingleElement
     */
    public function getConst()
    {
        return $this->_const;

    }

    /**
     * Parses the version tag of this class comment.
     *
     * @param array $tokens The tokens that comprise this tag.
     *
     * @return PHP_CodeSniffer_CommentParser_SingleElement
     */
    protected function parseVar($tokens)
    {
        $this->_version = new PHP_CodeSniffer_CommentParser_SingleElement(
            $this->previousElement,
            $tokens,
            'var',
            $this->phpcsFile
        );

        return $this->_var;
    }

    /**
     * Returns the version of this class comment.
     *
     * @return PHP_CodeSniffer_CommentParser_SingleElement
     */
    public function getvar()
    {
        return $this->_var;

    }

    /**
     * Parses the version tag of this class comment.
     *
     * @param array $tokens The tokens that comprise this tag.
     *
     * @return PHP_CodeSniffer_CommentParser_SingleElement
     */
    protected function parseStatic($tokens)
    {
        $this->_version = new PHP_CodeSniffer_CommentParser_SingleElement(
            $this->previousElement,
            $tokens,
            'static',
            $this->phpcsFile
        );

        return $this->_static;
    }

    /**
     * Returns the version of this class comment.
     *
     * @return PHP_CodeSniffer_CommentParser_SingleElement
     */
    public function getStatic()
    {
        return $this->_static;

    }

}

?>
