<?php

/**
 * @author Adam Dowling <adam@semsolutions.co.uk>
 * @version 1.0
 * @date 2006-08-15
 * @package SEM.CMS.Forms
 */

require_once('HTML/Forms/Form.class.php');

require_once('HTML/Forms/Widgets/Basic/FormAction.class.php');
require_once('HTML/Forms/Widgets/Basic/Hidden.class.php');
require_once('HTML/Forms/Widgets/Basic/TextBox.class.php');
require_once('HTML/Forms/Widgets/Basic/PasswordBox.class.php');
require_once('HTML/Forms/Widgets/Basic/CheckBox.class.php');
require_once('HTML/Forms/Widgets/Basic/SubmitButton.class.php');

class AddCMSUserForm extends Form
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
        
        
        function AddCMSUserForm ()
        {
                $numArgs = func_num_args();
                $args =& func_get_args();
                call_user_func_array(
                        array(&$this, '_AddCMSUserForm'.$numArgs),
                        $args);
        }
        
        
        function _AddCMSUserForm0 ()
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
                
                $firstname =& new TextBox('firstname');
                $firstname->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $firstname->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                $firstname->setSize(30);
                $firstname->setMaxLength(50);
                $this->addWidget(
                        $firstname->getId(),
                        $firstname,
                        'Firstname'
                        );
                
                $surname =& new TextBox('surname');
                $surname->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $surname->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                $surname->setSize(30);
                $surname->setMaxLength(50);
                $this->addWidget(
                        $surname->getId(),
                        $surname,
                        'Surname'
                        );
                
                $email =& new TextBox('email');
                $email->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $email->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                $email->setSize(30);
                $email->setMaxLength(100);
                $this->addWidget(
                        $email->getId(),
                        $email,
                        'Email'
                        );
                
                $username =& new TextBox('username');
                $username->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $username->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                $username->setSize(30);
                $username->setMaxLength(100);
                $this->addWidget(
                        $username->getId(),
                        $username,
                        'Username'
                        );
                
                $password =& new PasswordBox('password');
                $password->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $password->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                $password->setSize(20);
                $password->setMaxLength(30);
                $this->addWidget(
                        $password->getId(),
                        $password,
                        'Password'
                        );
                
                $password2 =& new PasswordBox('password2');
                $password2->setCompletionRequirement(FormWidget::COMPLETION_REQUIRED());
                $password2->setValidationRequirement(FormWidget::VALIDATE_ALWAYS());
                $password2->setSize(20);
                $password2->setMaxLength(30);
                $this->addWidget(
                        $password2->getId(),
                        $password2,
                        'Confirm Password'
                        );
                
                $autogenPassword =& new Checkbox('autopassword');
                $autogenPassword->setChecked(FALSE);
                $this->addWidget(
                        $autogenPassword->getId(),
                        $autogenPassword,
                        'Generate Password Automatically'
                        );
                
                $emailUserDetails =& new Checkbox('emailuserdetails');
                $emailUserDetails->setChecked(FALSE);
                $this->addWidget(
                        $emailUserDetails->getId(),
                        $emailUserDetails,
                        'Email Account Details to new User'
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
