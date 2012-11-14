<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-06-14
 */

require_once('HTML/Forms/FormWidget.class.php');

class TextArea extends FormWidget
{
        /*
	 * Class Constants
	 */
	
        
        
        
        
	/*
	 * Class Variables
	 */
        
        
	/*
	 * Instance Variables
	 */
        
        
        var $rows = 5;
        var $cols = 30;
        var $maxlength = 0;
        var $value = '';
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function TextArea ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_TextArea'.$numArgs),  $args);
        }
        
        
        function _TextArea0 ()
        {
                $this->_initialise();
        }
        
        
        function _TextArea1 ( $id )
        {
                $this->_initialise();
                $this->setId($id);
        }
        
        
        function _initialise ()
        {
                ;
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function getRows ()
        {
                return $this->rows;
        }
        
        
        function setRows ( $rows )
        {
                $this->rows = $rows;
        }
        
        
        function getCols ()
        {
                return $this->cols;
        }
        
        
        function setCols ( $cols )
        {
                $this->cols = $cols;
        }
        
        
        function getMaxLength ()
        {
                return $this->maxlength;
        }
        
        
        function setMaxLength ( $maxlength )
        {
                $this->maxlength = $maxlength;
        }
        
        
        function getValue ()
        {
                return $this->value;
        }
        
        
        function setValue ( $value )
        {
                $this->value = $value;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function render ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                return call_user_func_array(
                        array( &$this, '_render'.$numArgs),  $args );
        }
        
        
        function _render0 ()
        {
                return $this->render('', '', '');
        }
        
        
        function _render3 ( $cssId, $cssClass, $cssStyle )
        {
                $html = '<textarea';
                $html .= ( $this->getId() != '' ?
                        ' name="'.$this->getId().'"' :
                        '' );
                $html .= ( $this->getRows() != '' ?
                        ' rows="'.$this->getRows().'"' :
                        '' );
                $html .= ( $this->getCols() != '' ?
                        ' cols="'.$this->getcols().'"' :
                        '' );
                if ( !is_null($cssId) && $cssId != '' )
                {
                        $html .= ' ' . $this->renderCssId($cssId);
                }
                
                if ( !is_null($cssClass) && $cssClass != '' )
                {
                        $html .= ' ' . $this->renderCssClass($cssClass);
                }
                
                if ( !is_null($cssStyle) && $cssStyle != '' )
                {
                        $html .= ' ' . $this->renderCssStyle($cssStyle);
                }
                $html .= ' />';
                
                $html .= ( $this->getValue() != '' ?
                        htmlspecialchars($this->getValue()) :
                        '' );
                
                $html .= '</textarea>';
                
                return $html;
        }
        
        
        function isComplete ()
        {
                return TRUE;
        }
        
        
        function &validate ()
        {
                $errors = array();
                
                if ( $this->maxLengthExceeded() )
                {
                        array_push($errors,
                                'The information entered exceeded the maximum size of ' .
                                $this->getMaxLength() . ' characters');
                }
                
                return $errors;
        }
        
        
        function maxLengthExceeded ()
        {
                if ( strlen($this->getValue()) > $this->getMaxLength() )
                {
                        return TRUE;
                }
                
                return FALSE;
        }
}

?>
