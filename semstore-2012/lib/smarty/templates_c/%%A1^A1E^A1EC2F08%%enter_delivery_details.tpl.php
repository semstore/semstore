<?php /* Smarty version 2.6.10, created on 2009-02-17 11:01:22
         compiled from _ecomstore/checkout/enter_delivery_details.tpl */ ?>
<p class="checkout_progress"><span class="complete">Confirm Basket</span> &gt; <span class="current">Enter Delivery Details</span> &gt; Enter Billing Details &gt; Confirm Order &gt; Payment </p>

<p class="instructions">Please enter your delivery details in the fields provided below.  Once you have completed the form and checked that the details are correct please click "Continue".</p><p class="instructions">To return to your basket to make changes click "Cancel"</p>

<!--<h3>Delivery Details</h3>-->


<div class="delivery_info">


</div>

<div class="form">
<form action="<?php echo $this->_tpl_vars['formAction']; ?>
" method="<?php echo $this->_tpl_vars['formMethod']; ?>
" enctype="<?php echo $this->_tpl_vars['formEncoding']; ?>
">

<div class="row">
<label>Firstname</label>
<div>
<input id="firstname" name="firstname" value="<?php echo $this->_tpl_vars['firstname']; ?>
" type="text" />
<?php if ($this->_tpl_vars['firstnameErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['firstnameErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>


<div class="row">
<label>Surname</label>
<div>
<input id="surname" name="surname" value="<?php echo $this->_tpl_vars['surname']; ?>
" type="text" />
<?php if ($this->_tpl_vars['surnameErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['surnameErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>


<div class="row">
<label>Address 1</label>
<div>
<input id="address1" name="address1" value="<?php echo $this->_tpl_vars['address1']; ?>
" type="text" />
</div>
</div>


<div class="row">
<label>Address 2</label>
<div>
<input id="address2" name="address2" value="<?php echo $this->_tpl_vars['address2']; ?>
" type="text" />
<?php if ($this->_tpl_vars['address2ErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['address2ErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>


<div class="row">
<label>City</label>
<div>
<input id="city" name="city" value="<?php echo $this->_tpl_vars['city']; ?>
" type="text" />
<?php if ($this->_tpl_vars['cityErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['cityErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>


<div class="row">
<label>County</label>
<div>
<input id="county" name="county" value="<?php echo $this->_tpl_vars['county']; ?>
" type="text" />
<?php if ($this->_tpl_vars['countyErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['countyErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>


<div class="row">
<label>Postcode</label>
<div>
<input id="postcode" name="postcode" value="<?php echo $this->_tpl_vars['postcode']; ?>
" type="text" />
<?php if ($this->_tpl_vars['postcodeErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['postcodeErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>

<div class="row">
<label>Email Address</label>
<div>
<input id="emailAddress" name="emailAddress" value="<?php echo $this->_tpl_vars['emailAddress']; ?>
" type="text" />
<?php if ($this->_tpl_vars['emailAddressErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['emailAddressErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>

<div class="row">
<label>Contact Number</label>
<div>
<input id="contactNumber" name="contactNumber" value="<?php echo $this->_tpl_vars['contactNumber']; ?>
" type="text" />
<?php if ($this->_tpl_vars['contactNumberErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['contactNumberErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>

<?php if ($this->_tpl_vars['showDeliverySelector']): ?>
<div class="row">
<label>Delivery Date</label>
<div>
<select id="deliveryDate" name="deliveryDate" size="1">
<?php $_from = $this->_tpl_vars['deliveryDates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['deliveryDate']):
?>
        <option value="<?php echo $this->_tpl_vars['deliveryDate']['selectorValue']; ?>
"<?php if ($this->_tpl_vars['deliveryDate']['selectorValue'] == $this->_tpl_vars['selectedDeliveryDate']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['deliveryDate']['selectorText']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select>
<?php if ($this->_tpl_vars['deliveryDateErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['deliveryDateErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>
<?php endif; ?>




<div class="row">
<label>Where did you hear about our site?</label>
<div>
<select name="heardofsite">

<option value="google" <?php if ($this->_tpl_vars['selectedHeardOfProtec'] == 'google'): ?>selected<?php endif; ?> >Google</option>
<option value="yahoo" <?php if ($this->_tpl_vars['selectedHeardOfProtec'] == 'yahoo'): ?>selected<?php endif; ?>>Yahoo</option>
<option value="directorylisting" <?php if ($this->_tpl_vars['selectedHeardOfProtec'] == 'directorylisting'): ?>selected<?php endif; ?>>Directory Listing</option>
<option value="mailout" <?php if ($this->_tpl_vars['selectedHeardOfProtec'] == 'mailout'): ?>selected<?php endif; ?>>Mail Out</option>
<option value="Ebay" <?php if ($this->_tpl_vars['selectedHeardOfProtec'] == 'Ebay'): ?>selected<?php endif; ?>>Ebay</option>
<option value="other" <?php if ($this->_tpl_vars['selectedHeardOfProtec'] == 'other'): ?>selected<?php endif; ?>>Other</option>

</select>
</div>
</div>


<input name="action" value="enter_delivery_details_submit" type="hidden" />
<input name="continue_button" value="Continue" type="image" src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_images_webpath'); ?>
/site/buttons/buttons_26.gif" />
<input name="cancel_button" value="Cancel" type="image" src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_images_webpath'); ?>
/site/buttons/cancel.png" />


</form>
</div>