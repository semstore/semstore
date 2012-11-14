
<form class="registration" action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}" onsubmit="return validateRegistrationForm();">
<div id="registration">
<input name="{$action_parameter_name}" value="{$action_parameter_value}" type="hidden"/>
<p class="required"><label for="title">Title*<br/>
<select id="title"  name="title">
{foreach item="titleOption" from=$titleOptions}
<option value="{$titleOption.id}"{if $reg_title eq $titleOption.id} selected{/if}>{$titleOption.value}</option>
{/foreach}
</select></label></p>
{if $reg_title_error}
		<p class="error">{$reg_title_error}</p>
{/if}


<p class="required"><label for="firstname">Firstname*<br/>
<input id="firstname" name="firstname" value="{$reg_firstname}" type="text" /></label></p>
{if $reg_firstname_error}
<p class="error">{$reg_firstname_error}</p>
{/if}



<p class="required"><label for="surname">Surname*<br/>
<input id="surname" name="surname" value="{$reg_surname}" type="text" /></label></p>
{if $reg_surname_error}
<p class="error">{$reg_surname_error}</p>
{/if}



<p class="required"><label for="email">Email*<br/>
<input id="email" name="email" value="{$reg_email}" type="email"/></label></p>
{if $reg_email_error}
<p class="error">{$reg_email_error}</p>
{/if}


<p><label for="company_name">Company Name<br/>
<input id="company_name" name="company_name" value="{$reg_company_name}" type="text"/></label></p>
{if $reg_company_name_error}
<p class="error">{$reg_company_name_error}</p>
{/if}


<p><label for="building_name">Building Name<br/>
<input id="building_name" name="building_name" value="{$reg_building_name}" type="text"/></label></p>
{if $reg_building_name_error}
<p class="error">{$reg_building_name_error}</p>
{/if}



<p><label for="building_number">Building Number<br/>
<input id="building_number" name="building_number" value="{$reg_building_number}" type="text"/></label></p>
{if $reg_building_number_error}
<p class="error">{$reg_building_number_error}</p>
{/if}

<p class="required"><label for="street">Street*<br/>
<input id="street" name="street" value="{$reg_street}" type="text"/></label></p>
{if $reg_street_error}
<p class="error">{$reg_street_error}</p>
{/if}



<p><label for="area">Area<br/>
<input id="area" name="area" value="{$reg_area}" type="text"/></label></p>
{if $reg_area_error}
<p class="error">{$reg_area_error}</p>
{/if}



<p class="required"><label for="city">City*<br/>
<input id="city" name="city" value="{$reg_city}" type="text"/></label></p>
{if $reg_city_error}
<p class="error">{$reg_city_error}</p>
{/if}


<p class="required"><label for="county">County*<br/>
<input id="county" name="county" value="{$reg_county}" type="text"/></label></p>
{if $reg_county_error}
<p class="error">{$reg_county_error}</p>
{/if}


{if $reg_international}
<p class="required"><label for="country">Country*<br/>
<input id="country" name="country" value="{$reg_country}" type="text"/></label></p>
{if $reg_country_error}
<p class="error">{$reg_country_error}</p>
{/if}
{/if}


<p class="required"><label for="postcode">Postcode*<br/>
<input id="postcode" name="postcode" value="{$reg_postcode}" type="text"/></label></p>
{if $reg_postcode_error}
        <p class="error">{$reg_postcode_error}</p>
{/if}

{if !$reg_autogenpass}
<p class="required"><label for="password">Password*<br/>
<input id="password" name="password" value="{$reg_password}" type="password"/></label></p>
{if $reg_password_error}
<p class="error">{$reg_password_error}</p>
{/if}


<p class="required"><label for="password2">Confirm Password*<br/>
<input id="password2" name="password2" value="{$reg_password2}" type="password"/></label></p>
{if $reg_password2_error}
<p class="error">{$reg_password2_error}</p>
{/if}
{/if}
</div><p><input name="button" value="Submit" type="image" src="./images/site/buttons/buttons_26.gif" /></p>
<p class="specials">_ecomstore/customer_registration/customer_registration_form.tpl</p>
</form>
