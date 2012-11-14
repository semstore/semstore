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
require_once('HTML/Forms/Widgets/Basic/FileSelector.class.php');
require_once('HTML/Forms/Widgets/Basic/SubmitButton.class.php');

class UploadProductImagesForm extends Form
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
        
        
        function UploadProductImagesForm ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_UploadProductImagesForm'.$numArgs),
                        $args);
        }
        
        
        function _UploadProductImagesForm0 ()
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
                $this->setEncoding(Form::MULTIPART_FORM_DATA());
                
                $action =& new FormAction();
                $action->setValue('');
                $action->setCompletionRequirement(FormWidget::COMPLETION_NOT_REQUIRED());
                $action->setValidationRequirement(FormWidget::VALIDATE_NEVER());
                $this->addWidget(
                        $action->getId(),
                        $action,
                        ''
                        );
                
                
                $pfImage =& new FileSelector('productinfo_image');
                $pfImage->setCompletionRequirement(FormWidget::COMPLETION_NOT_REQUIRED());
                $pfImage->setValidationRequirement(FormWidget::VALIDATE_NEVER());
                $this->addWidget(
                        'productinfo_image',
                        $pfImage,
                        'Product Information Page Image'
                        );
                
                $tnImage =& new FileSelector('thumbnail_image');
                $tnImage->setCompletionRequirement(FormWidget::COMPLETION_NOT_REQUIRED());
                $tnImage->setValidationRequirement(FormWidget::VALIDATE_NEVER());
                $this->addWidget(
                        'thumbnail_image',
                        $tnImage,
                        'Thumbnail Image'
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
