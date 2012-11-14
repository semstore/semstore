<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-08-25
 * @package SEM.CMS.Modules.eComStore.CMS.Forms
 */

require_once('HTML/Forms/Form.class.php');

require_once('HTML/Forms/Widgets/Basic/FormAction.class.php');
require_once('HTML/Forms/Widgets/Basic/Hidden.class.php');
require_once('HTML/Forms/Widgets/Basic/TextBox.class.php');
require_once('HTML/Forms/Widgets/Basic/TextArea.class.php');
require_once('HTML/Forms/Widgets/Basic/ComboBox.class.php');
require_once('HTML/Forms/Widgets/Basic/ComboBoxOption.class.php');
require_once('HTML/Forms/Widgets/Basic/SubmitButton.class.php');
require_once('HTML/Forms/Widgets/Basic/FileSelector.class.php');

class AddProductFileForm extends Form
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
        
        
        function AddProductFileForm ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_AddProductFileForm'.$numArgs),
                        $args);
        }
        
        
        function _AddProductFileForm0 ()
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
                $this->setMethod(Form::METHOD_POST());
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
                        
                $productFile =& new FileSelector('productfile');
                $productFile->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $productFile->setValidationRequirement(FormWidget::VALIDATE_NEVER());
                $this->addWidget(
                        'productfile',
                        $productFile,
                        'Product File'
                        );
                
                
                $description =& new TextBox('description');
                $description->setCompletionRequirement(FormWidget::COMPLETION_NOT_REQUIRED());
                $description->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                $description->setSize(30);
                $description->setMaxLength(50);
                $this->addWidget(
                        $description->getId(),
                        $description,
                        'File Description'
                        );
                        
                
                $hfid =& new TextBox('hfid');
                $hfid->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $hfid->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                $hfid->setSize(30);
                $hfid->setMaxLength(50);
                $this->addWidget(
                        $hfid->getId(),
                        $hfid,
                        'Human Friendly Identifier'
                        );
                        
                $submitButton =& new SubmitButton('button');
                $submitButton->setValue('Submit Details');
                $submitButton->setCompletionRequirement(FormWidget::COMPLETION_NOT_REQUIRED());
                $submitButton->setValidationRequirement(FormWidget::VALIDATE_NEVER());
                $this->addWidget(
                        'submitButton',
                        $submitButton,
                        ''
                        );
                
                $cancelButton =& new SubmitButton('button');
                $cancelButton->setValue('Cancel');
                $cancelButton->setCompletionRequirement(FormWidget::COMPLETION_NOT_REQUIRED());
                $cancelButton->setValidationRequirement(FormWidget::VALIDATE_NEVER());
                $this->addWidget(
                        'cancelButton',
                        $cancelButton,
                        ''
                        );
        }
}

?>
