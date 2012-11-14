<?php /* Smarty version 2.6.10, created on 2008-01-03 06:55:49
         compiled from _ecomstore/customer_registration/customer_registration_form.tpl */ ?>

<form class="registration" action="<?php echo $this->_tpl_vars['formAction']; ?>
" method="<?php echo $this->_tpl_vars['formMethod']; ?>
" enctype="<?php echo $this->_tpl_vars['formEncoding']; ?>
" onsubmit="return validateRegistrationForm();">
<div id="registration">
<input name="<?php echo $this->_tpl_vars['action_parameter_name']; ?>
" value="<?php echo $this->_tpl_vars['action_parameter_value']; ?>
" type="hidden"/>
<p class="required"><label for="title">Title*<br/>
<select id="title"  name="title">
<?php $_from = $this->_tpl_vars['titleOptions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['titleOption']):
?>
<option value="<?php echo $this->_tpl_vars['titleOption']['id']; ?>
"<?php if ($this->_tpl_vars['reg_title'] == $this->_tpl_vars['titleOption']['id']): ?> selected<?php endif; ?>><?php echo $this->_tpl_vars['titleOption']['value']; ?>
</option>
<?php endforeach; endif; unset($_from); ?>
</select></label></p>
<?php if ($this->_tpl_vars['reg_title_error']): ?>
		<p class="error"><?php echo $this->_tpl_vars['reg_title_error']; ?>
</p>
<?php endif; ?>


<p class="required"><label for="firstname">Firstname*<br/>
<input id="firstname" name="firstname" value="<?php echo $this->_tpl_vars['reg_firstname']; ?>
" type="text" /></label></p>
<?php if ($this->_tpl_vars['reg_firstname_error']): ?>
<p class="error"><?php echo $this->_tpl_vars['reg_firstname_error']; ?>
</p>
<?php endif; ?>



<p class="required"><label for="surname">Surname*<br/>
<input id="surname" name="surname" value="<?php echo $this->_tpl_vars['reg_surname']; ?>
" type="text" /></label></p>
<?php if ($this->_tpl_vars['reg_surname_error']): ?>
<p class="error"><?php echo $this->_tpl_vars['reg_surname_error']; ?>
</p>
<?php endif; ?>



<p class="required"><label for="email">Email*<br/>
<input id="email" name="email" value="<?php echo $this->_tpl_vars['reg_email']; ?>
" type="email"/></label></p>
<?php if ($this->_tpl_vars['reg_email_error']): ?>
<p class="error"><?php echo $this->_tpl_vars['reg_email_error']; ?>
</p>
<?php endif; ?>


<p><label for="company_name">Company Name<br/>
<input id="company_name" name="company_name" value="<?php echo $this->_tpl_vars['reg_company_name']; ?>
" type="text"/></label></p>
<?php if ($this->_tpl_vars['reg_company_name_error']): ?>
<p class="error"><?php echo $this->_tpl_vars['reg_company_name_error']; ?>
</p>
<?php endif; ?>


<p><label for="building_name">Building Name<br/>
<input id="building_name" name="building_name" value="<?php echo $this->_tpl_vars['reg_building_name']; ?>
" type="text"/></label></p>
<?php if ($this->_tpl_vars['reg_building_name_error']): ?>
<p class="error"><?php echo $this->_tpl_vars['reg_building_name_error']; ?>
</p>
<?php endif; ?>



<p><label for="building_number">Building Number<br/>
<input id="building_number" name="building_number" value="<?php echo $this->_tpl_vars['reg_building_number']; ?>
" type="text"/></label></p>
<?php if ($this->_tpl_vars['reg_building_number_error']): ?>
<p class="error"><?php echo $this->_tpl_vars['reg_building_number_error']; ?>
</p>
<?php endif; ?>

<p class="required"><label for="street">Street*<br/>
<input id="street" name="street" value="<?php echo $this->_tpl_vars['reg_street']; ?>
" type="text"/></label></p>
<?php if ($this->_tpl_vars['reg_street_error']): ?>
<p class="error"><?php echo $this->_tpl_vars['reg_street_error']; ?>
</p>
<?php endif; ?>



<p><label for="area">Area<br/>
<input id="area" name="area" value="<?php echo $this->_tpl_vars['reg_area']; ?>
" type="text"/></label></p>
<?php if ($this->_tpl_vars['reg_area_error']): ?>
<p class="error"><?php echo $this->_tpl_vars['reg_area_error']; ?>
</p>
<?php endif; ?>



<p class="required"><label for="city">City*<br/>
<input id="city" name="city" value="<?php echo $this->_tpl_vars['reg_city']; ?>
" type="text"/></label></p>
<?php if ($this->_tpl_vars['reg_city_error']): ?>
<p class="error"><?php echo $this->_tpl_vars['reg_city_error']; ?>
</p>
<?php endif; ?>


<p class="required"><label for="county">County*<br/>
<input id="county" name="county" value="<?php echo $this->_tpl_vars['reg_county']; ?>
" type="text"/></label></p>
<?php if ($this->_tpl_vars['reg_county_error']): ?>
<p class="error"><?php echo $this->_tpl_vars['reg_county_error']; ?>
</p>
<?php endif; ?>


<?php if ($this->_tpl_vars['reg_international']): ?>
<p class="required"><label for="country">Country*<br/>
<input id="country" name="country" value="<?php echo $this->_tpl_vars['reg_country']; ?>
" type="text"/></label></p>
<?php if ($this->_tpl_vars['reg_country_error']): ?>
<p class="error"><?php echo $this->_tpl_vars['reg_country_error']; ?>
</p>
<?php endif; ?>
<?php endif; ?>


<p class="required"><label for="postcode">Postcode*<br/>
<input id="postcode" name="postcode" value="<?php echo $this->_tpl_vars['reg_postcode']; ?>
" type="text"/></label></p>
<?php if ($this->_tpl_vars['reg_postcode_error']): ?>
        <p class="error"><?php echo $this->_tpl_vars['reg_postcode_error']; ?>
</p>
<?php endif; ?>

<?php if (! $this->_tpl_vars['reg_autogenpass']): ?>
<p class="required"><label for="password">Password*<br/>
<input id="password" name="password" value="<?php echo $this->_tpl_vars['reg_password']; ?>
" type="password"/></label></p>
<?php if ($this->_tpl_vars['reg_password_error']): ?>
<p class="error"><?php echo $this->_tpl_vars['reg_password_error']; ?>
</p>
<?php endif; ?>


<p class="required"><label for="password2">Confirm Password*<br/>
<input id="password2" name="password2" value="<?php echo $this->_tpl_vars['reg_password2']; ?>
" type="password"/></label></p>
<?php if ($this->_tpl_vars['reg_password2_error']): ?>
<p class="error"><?php echo $this->_tpl_vars['reg_password2_error']; ?>
</p>
<?php endif; ?>
<?php endif; ?>
</div><p><input name="button" value="Submit" type="image" src="./images/site/buttons/buttons_26.gif" /></p>
<p class="specials">_ecomstore/customer_registration/customer_registration_form.tpl</p>
</form>