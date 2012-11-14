<?php

/**
 *  @author Adam Dowling (adam@semsolutions.co.uk)
 *  @version 1.0
 *  @date 2005-06-14
 */

require_once('HTML/Forms/FormWidget.class.php');

class FileSelector extends FormWidget
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
        
        
        var $value = '';
        var $defaultValue = '';
        var $filename = '';
        var $type = '';
        var $size = '';
        var $tmpName = '';
        var $error = '';
        
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function FileSelector ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_FileSelector'.$numArgs),  $args);
        }
        
        
        function _FileSelector0 ()
        {
                ;
        }
        
        
        function _FileSelector1 ( $id )
        {
                $this->setId($id);
        }
        
        
        /*
	 * Accessor & Mutator Methods
	 */
        
        
        function getValue ()
        {
                return $this->value;
        }
        
        
        function setValue ( $value )
        {
                $this->value = $value;
        }
        
        
        function getDefaultValue ()
        {
                return $this->defaultValue;
        }
        
        
        function setDefaultValue ( $defaultValue )
        {
                $this->defaultValue = $defaultValue;
        }
        
        
        function getFilename ()
        {
                return $this->filename;
        }
        
        
        function setFilename ( $filename )
        {
                $this->filename = $filename;
        }
        
        
        function getType ()
        {
                return $this->type;
        }
        
        
        function setType ( $type )
        {
                $this->type = $type;
        }
        
        
        function getSize ()
        {
                return $this->size;
        }
        
        
        function setSize ( $size )
        {
                $this->size = $size;
        }
        
        
        function getTmpName ()
        {
                return $this->tmpName;
        }
        
        
        function setTmpName ( $tmpName )
        {
                $this->tmpName = $tmpName;
        }
        
        
        function getError ()
        {
                return $this->error;
        }
        
        
        function setError ( $error )
        {
                $this->error = $error;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
        function render ()
        {
                $html = '<input type="file"';
                $html .= ( $this->getId() != '' ?
                        ' name="'.$this->getId().'"' :
                        '' );
                $html .= ( $this->getValue() != '' ?
                        ' value="'.$this->getValue().'"' :
                        ' value="'.$this->getDefaultValue().'"' );
                $html .= ' />';
                
                return $html;
        }
        
        
        function renderWithCSS ( $cssType, $css )
        {
                $html = '<input';
                if ( $cssType == $this->CSS_TYPE_ID )
                {
                        $html .= ' id="' . $css . '"';
                }
                else if ( $cssType == $this->CSS_TYPE_CLASS )
                {
                        $html .= ' class="' . $css . '"';
                }
                else if ( $cssType == $this->CSS_TYPE_STYLE )
                {
                        $html .= ' style="' . $css . '"';
                }
                
                $html .= ' type="file"';
                $html .= ( $this->getId() != '' ?
                        ' name="'.$this->getId().'"' :
                        '' );
                $html .= ( $this->getValue() != '' ?
                        ' value="'.htmlspecialchars($this->getValue()).'"' :
                        ' value="'.htmlspecialchars($this->getDefaultValue()).'"' );
                $html .= ' />';
                
                return $html;
        }
        
        
        
        function &validate ()
        {
                return array();
        }
        
        
        function isComplete ()
        {
                return TRUE;
        }
        
        
        function _populate0 ()
        {
                $this->populate(RequestParams::getParam($this->getName()));
                /*
                $this->setFilename($_FILES[$this->getName()]['name']);
                $this->setType($_FILES[$this->getName()]['type']);
                $this->setSize($_FILES[$this->getName()]['size']);
                $this->setTmpName($_FILES[$this->getName()]['tmp_name']);
                $this->setError($_FILES[$this->getName()]['error']);
                */
        }
        
        
        function _populateFromArray ( $array )
        {
                $this->setValue($array[$this->getName()]);
        }
        
        
        function _populateFromScalar ( $scalar )
        {
                $this->setValue($scalar);
        }
}

?>
