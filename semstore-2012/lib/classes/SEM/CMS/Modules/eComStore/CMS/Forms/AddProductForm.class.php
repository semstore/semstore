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
require_once('HTML/Forms/Widgets/Basic/SubmitButton.class.php');

require_once('SEM/CMS/Modules/eComStore/Product.class.php');

class AddProductForm extends Form
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
        
        
        function AddProductForm ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_AddProductForm'.$numArgs),
                        $args);
        }
        
        
        function _AddProductForm0 ()
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
                
                $name =& new TextBox('name');
                $name->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $name->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                $name->setSize(30);
                $name->setMaxLength(50);
                $this->addWidget(
                        $name->getId(),
                        $name,
                        'Product Name'
                        );
                
                $type =& new ComboBox('type');
                $type->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $type->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                $this->addWidget(
                        $type->getId(),
                        $type,
                        'Product Type'
                        );
                
                $code =& new TextBox('code');
                $code->setCompletionRequirement(FormWidget::COMPLETION_NOT_REQUIRED());
                $code->setValidationRequirement(FormWidget::VALIDATE_IF_COMPLETE());
                $code->setSize(30);
                $code->setMaxLength(50);
                $this->addWidget(
                        $code->getId(),
                        $code,
                        'Product Code'
                        );
                
                $price =& new TextBox('price');
                $price->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $price->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                $price->setSize(10);
                $price->setMaxLength(10);
                $this->addWidget(
                        $price->getId(),
                        $price,
                        'Price'
                        );
                
                $vatStatus =& new ComboBox('vatstatus');
                $vatStatus->createOption(
                        Product::PRICE_IS_VAT_EXCLUSIVE(),
                        'Price is VAT Exclusive');
                $vatStatus->createOption(
                        Product::PRICE_IS_VAT_INCLUSIVE(),
                        'Price is VAT Inclusive');
                $vatStatus->createOption(
                        Product::PRODUCT_IS_VAT_EXEMPT(),
                        'Product is VAT Exempt');
                $vatStatus->setCompletionRequirement(
                        FormWidget::COMPLETION_REQUIRED());
                $vatStatus->setValidationRequirement(
                        FormWidget::VALIDATE_ALWAYS());
                $this->addWidget(
                        $vatStatus->getId(),
                        $vatStatus,
                        'VAT Status'
                        );
                
                $description =& new TextArea('description');
                $description->setCompletionRequirement(FormWidget::COMPLETION_NOT_REQUIRED());
                $description->setValidationRequirement(FormWidget::VALIDATE_IF_COMPLETE());
                $description->setRows(5);
                $description->setCols(40);
                $description->setMaxLength(255);
                $this->addWidget(
                        $description->getId(),
                        $description,
                        'Description'
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
        
        
        function populateTypes ( &$typesArray )
        {
                $typeWidget =& $this->getWidget('type');
                foreach ( array_keys($typesArray) as $index )
                {
                        $type =& $typesArray[$index];
                        $typeWidget->createOption(
                                $type->getId(),
                                $type->getName() );
                }
        }
}

?>
