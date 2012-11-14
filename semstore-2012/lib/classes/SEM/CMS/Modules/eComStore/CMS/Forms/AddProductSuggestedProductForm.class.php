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

class AddProductSuggestedProductForm extends Form
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
        
        
        function AddProductSuggestedProductForm ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_AddProductSuggestedProductForm'.$numArgs),
                        $args);
        }
        
        
        function _AddProductSuggestedProductForm0 ()
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
                
                $product =& new ComboBox('product');
                $product->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $product->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                
                $productList = Product::find('', $GLOBALS['dbConnection']);
                
                foreach ($productList as $productFromList)
                {
                        $product->createOption($productFromList->getId(), $productFromList->getName());
                }
                
                $this->addWidget(
                        $product->getId(),
                        $product,
                        'Product'
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
