<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 *  @date 2005-06-27
 * @package HTML.Forms.Widgets.Basic
 */

require_once('HTML/Forms/FormWidget.class.php');


class DateOfBirth extends FormWidget
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
        
        var $selected = '';
        var $size = 1;
        var $selectedDay = '';
        var $selectedMonth = '';
        var $selectedYear = '';
        
        /*
	 * Class Methods
	 */
        
        
        /*
	 * Constructors
	 */
        
        
        function DateOfBirth ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array( array( &$this, '_DateOfBirth'.$numArgs),  $args);
        }
        
        
        function _DateOfBirth0 ()
        {
                $this->_initialise();
        }
        
        
        function _DateOfBirth1 ( $id )
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
        
        
        function &getOptions ()
        {
                return $this->options;
        }
        
        
        function setOptions ( &$options )
        {
                $this->options =& $options;
        }
        
        
        function getSize ()
        {
                return $this->size;
        }
        
        
        function setSize ( $size )
        {
                $this->size = $size;
        }
        
        
        /*
	 * Command Methods
	 */
        
        
       
        
        
        function &getOption ( $optionId )
        {
                foreach ( array_keys($this->options) as $index )
                {
                        $option =& $this->options[$index];
                        if ( $option->getId() == $optionId )
                        {
                                return $option;
                        }
                }
                
                return NULL;
        }
        
        
        function getSelectedDay ()
        {
                return $this->selectedDay;
        }
        
        function getSelectedMonth ()
        {
                return $this->selectedMonth;
        }
                
        function getSelectedYear ()
        {
                return $this->selectedYear;
        }
        
        
        function setSelectedYear ( $optionValue )
        {
                $this->selectedYear = $optionValue;
        }
        
        
        function setSelectedDay ( $optionValue )
        {
                $this->selectedDay = $optionValue;
        }
        
        
        function setSelectedMonth ( $optionValue )
        {
                $this->selectedMonth = $optionValue;
        }
        
        function getDayValue ()
        {
                return $this->getSelectedDay();
        }
        
        function getMonthValue ( )
        {
                return $this->getSelectedMonth();
        }
        
        function getYearValue ( )
        {
                return $this->getSelectedYear();
        }
        
        
        
        function isSelected ( $optionName )
        {
                return $this->selected == $optionName;
        }
        
        
        function isValidOption ( )
        {
                              $originaldate = $this->getSelectedYear().'-'.$this->getSelectedMonth().'-'.$this->getSelectedDay();
                              
                              $parseddate = date('Y-n-j', strtotime($originaldate));
                              
                              if ( $originaldate == $parseddate && ($this->getSelectedYear() >= 1902) && ($this->getSelectedYear() <= 2000) )
                              {
                                return TRUE;
                              }
                              else
                              {
                                return FALSE;
                              }
                        
        }
        
                
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
        
                $html = '<select';
                $html .= ( $this->getId() != '' ?
                        ' name="'.$this->getId().'Day"' :
                        '' );
                $html .= ( $this->getSize() != '' ?
                        ' size="'.$this->getSize().'"' :
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
                
                //day
                for ($i=1; $i<=31; $i++)
                {
                        if ( $i == $this->getSelectedDay() )
                        {
                               $selected = 'selected';
                        }
                        else
                        {
                               $selected = '';
                        }
                        
                        $html.= '<option value="'.$i.'" '.$selected.' />'.$i;
                }
                
                $html .= '</select>';
                
                
                $html .= ' <select';
                $html .= ( $this->getId() != '' ?
                        ' name="'.$this->getId().'Month"' :
                        '' );
                $html .= ( $this->getSize() != '' ?
                        ' size="'.$this->getSize().'"' :
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
                
                //month
                if ( 1 == $this->getSelectedMonth() )
                {
                      $selected = 'selected';
                }
                else
                {
                      $selected = '';
                }
                
                $html.= '<option value="1" '.$selected.'/> January';
                
                
                if ( 2 == $this->getSelectedMonth() )
                {
                      $selected = 'selected';
                }
                else
                {
                      $selected = '';
                }
                
                $html.= '<option value="2" '.$selected.'/> Febuary';
                
                
                if ( 3 == $this->getSelectedMonth() )
                {
                      $selected = 'selected';
                }
                else
                {
                      $selected = '';
                }
                
                $html.= '<option value="3" '.$selected.'/> March';
                
                
                if ( 4 == $this->getSelectedMonth() )
                {
                      $selected = 'selected';
                }
                else
                {
                      $selected = '';
                }
                
                $html.= '<option value="4" '.$selected.'/> April';
                
                
                if ( 5 == $this->getSelectedMonth() )
                {
                      $selected = 'selected';
                }
                else
                {
                      $selected = '';
                }
                
                $html.= '<option value="5" '.$selected.'/> May';
                
                
                if ( 6 == $this->getSelectedMonth() )
                {
                      $selected = 'selected';
                }
                else
                {
                      $selected = '';
                }
                
                $html.= '<option value="6" '.$selected.'/> June';
                
                
                if ( 7 == $this->getSelectedMonth() )
                {
                      $selected = 'selected';
                }
                else
                {
                      $selected = '';
                }
                
                $html.= '<option value="7" '.$selected.'/> July';
                
                
                if ( 8 == $this->getSelectedMonth() )
                {
                      $selected = 'selected';
                }
                else
                {
                      $selected = '';
                }
                
                $html.= '<option value="8" '.$selected.'/> August';
                
                
                if ( 9 == $this->getSelectedMonth() )
                {
                      $selected = 'selected';
                }
                else
                {
                      $selected = '';
                }
                
                $html.= '<option value="9" '.$selected.'/> September';
                
                
                if ( 10 == $this->getSelectedMonth() )
                {
                      $selected = 'selected';
                }
                else
                {
                      $selected = '';
                }
                
                $html.= '<option value="10" '.$selected.'/> October';
                
                
                if ( 11 == $this->getSelectedMonth() )
                {
                      $selected = 'selected';
                }
                else
                {
                      $selected = '';
                }
                
                $html.= '<option value="11" '.$selected.'/> November';
                
                
                if ( 12 == $this->getSelectedMonth() )
                {
                      $selected = 'selected';
                }
                else
                {
                      $selected = '';
                }
                
                $html.= '<option value="12" '.$selected.'/> December';
                
                $html .= '</select>';
                
                $html .= ' <select';
                $html .= ( $this->getId() != '' ?
                        ' name="'.$this->getId().'Year"' :
                        '' );
                $html .= ( $this->getSize() != '' ?
                        ' size="'.$this->getSize().'"' :
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
                
                
                //year
                for ($i=2000; $i>=1902; $i--)
                {
                
                        if ( $i == $this->getSelectedYear() )
                        {
                               $selected = 'selected';
                        }
                        else
                        {
                               $selected = '';
                        }
                                                
                        $html.= '<option value="'.$i.'" '.$selected.'/>'.$i;
                }
                
                $html .= '</select>';                
                
                return $html;
        }
        
        
        function isComplete ()
        {
                if ( $this->getSelectedDay() == '' )
                {
                       return false;
                }
                
                if ( $this->getSelectedMonth() == '' )
                {
                       return false;
                }
                
                if ( $this->getSelectedYear() == '' )
                {
                       return false;
                }
                return true;
        }
        
        
        function &validate ()
        {
                $errors = array();
                
                if ( !$this->isValidOption() )
                {
                        
                        $errors[$this->INVALID_OPTION] =
                                "Please select a valid date.";
                }
                
                return $errors;
        }
}

?>
