<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2005-10-10
 * @package SEM.CMS.Modules.eComStore.CMS.Forms
 */

require_once('HTML/Forms/Form.class.php');

require_once('HTML/Forms/Widgets/Basic/FormAction.class.php');
require_once('HTML/Forms/Widgets/Basic/Hidden.class.php');
require_once('HTML/Forms/Widgets/Basic/TextBox.class.php');
require_once('HTML/Forms/Widgets/Basic/TextArea.class.php');
require_once('HTML/Forms/Widgets/Basic/ComboBox.class.php');
require_once('HTML/Forms/Widgets/Basic/ComboBoxOption.class.php');
require_once('HTML/Forms/Widgets/Basic/FileSelector.class.php');
require_once('HTML/Forms/Widgets/Basic/SubmitButton.class.php');

class AddGlobalProductAttributeGroupForm extends Form
{
        /*
         *
	 * Class Constants
         *
	 */
	
        
        
        
        
	/*
         *
	 * Class Variables
         *
	 */
        
        
        
        
        
	/*
         *
	 * Instance Variables
         *
	 */
        
        
        
        
        
	/*
         *
	 * Constructors
         *
	 */
        
        
        function AddGlobalProductAttributeGroupForm ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_AddGlobalProductAttributeGroupForm'.$numArgs),
                        $args);
        }
        
        
        function _AddGlobalProductAttributeGroupForm0 ()
        {
                $this->_initialize();
                $this->_initWidgets();
        }
        
        
        /*
         *
	 * Accessor & Mutator Methods
         *
	 */
        
        
        
        
        
        /*
         *
	 * Class Methods
         *
	 */
        
        
        
        
        
        /*
         *
	 * Command Methods
         *
	 */
        
        
        function _initialize ()
        {
                ;
        }
        
        
        function _initWidgets ()
        {
                $this->setAction($_SERVER['PHP_SELF']);
                $this->setMethod('post');
                $this->setEncoding(Form::URLENCODED());
                
                $action =& new FormAction();
                $action->setValue('');
                $action->setCompletionRequirement(FormWidget::COMPLETION_NOT_REQUIRED());
                $action->setValidationRequirement(FormWidget::VALIDATE_NEVER());
                $this->addWidget(
                        $action->getId(),
                        $action,
                        ''
                        );
                
                
                $name =& new TextBox('name');
                $name->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $name->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                $name->setSize(30);
                $name->setMaxLength(100);
                $this->addWidget(
                        $name->getId(),
                        $name,
                        'Group Name'
                        );
                
                $submitButton =& new SubmitButton('button');
                $submitButton->setValue('Submit Details');
                $submitButton->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $submitButton->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                $this->addWidget(
                        'submitButton',
                        $submitButton,
                        ''
                        );
                
                $cancelButton =& new SubmitButton('button');
                $cancelButton->setValue('Cancel');
                $cancelButton->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $cancelButton->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                $this->addWidget(
                        'cancelButton',
                        $cancelButton,
                        ''
                        );
        }
}

?>
