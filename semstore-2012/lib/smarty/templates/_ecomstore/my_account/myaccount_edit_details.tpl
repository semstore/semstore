<form class="registration" action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}" onsubmit="return validateRegistrationForm();">
<input name="{$action_parameter_name}" value="{$action_parameter_value}" type="hidden"/>

<div class="row">
        <label for="title">Title<span class="required">*</span></label>
        <select id="title"  name="title">
        {foreach item="titleOption" from=$titleOptions}
                <option value="{$titleOption.id}"{if $reg_title eq $titleOption.id} selected{/if}>{$titleOption.value}</option>
        {/foreach}
        </select>
        {if $reg_title_error}
        <div class="error">
                <p class="errormessage">{$reg_title_error}</p>
        </div>
        {/if}
</div>

<div class="row">
        <label for="firstname">Firstname<span class="required">*</span></label>
        <span><input id="firstname" name="firstname" value="{$reg_firstname}" type="text" /></span>
        {if $reg_firstname_error}
        <div class="error">
                <p class="errormessage">{$reg_firstname_error}</p>
        </div>
        {/if}
</div>

<div class="row">
        <label for="surname">Surname<span class="required">*</span></label>
        <span><input id="surname" name="surname" value="{$reg_surname}" type="text" /></span>
        {if $reg_surname_error}
        <div class="error">
                <p class="errormessage">{$reg_surname_error}</p>
        </div>
        {/if}
</div>

<div class="row">
        <label for="email">Email<span class="required">*</span></label>
        <span><input id="email" name="email" value="{$reg_email}" type="email"/></span>
        {if $reg_email_error}
        <div class="error">
                <p class="errormessage">{$reg_email_error}</p>
        </div>
        {/if}
</div>

<div class="row">
        <label for="company_name">Company Name</label>
        <span><input id="company_name" name="company_name" value="{$reg_company_name}" type="text"/></span>
        {if $reg_company_name_error}
        <div class="error">
                <p class="errormessage">{$reg_company_name_error}</p>
        </div>
        {/if}
</div>

<div class="row">
        <label for="building_name">Building Name</label>
        <span><input id="building_name" name="building_name" value="{$reg_building_name}" type="text"/></span>
        {if $reg_building_name_error}
        <div class="error">
                <p class="errormessage">{$reg_building_name_error}</p>
        </div>
        {/if}
</div>

<div class="row">
        <label for="building_number">Building Number</label>
        <span><input id="building_number" name="building_number" value="{$reg_building_number}" type="text"/></span>
        {if $reg_building_number_error}
        <div class="error">
                <p class="errormessage">{$reg_building_number_error}</p>
        </div>
        {/if}
</div>

<div class="row">
        <label for="street">Street<span class="required">*</span></label>
        <span><input id="street" name="street" value="{$reg_street}" type="text"/></span>
        {if $reg_street_error}
        <div class="error">
                <p class="errormessage">{$reg_street_error}</p>
        </div>
        {/if}
</div>

<div class="row">
        <label for="area">Area</label>
        <span><input id="area" name="area" value="{$reg_area}" type="text"/></span>
        {if $reg_area_error}
        <div class="error">
                <p class="errormessage">{$reg_area_error}</p>
        </div>
        {/if}
</div>

<div class="row">
        <label for="city">City<span class="required">*</span></label>
        <span><input id="city" name="city" value="{$reg_city}" type="text"/></span>
        {if $reg_city_error}
        <div class="error">
                <p class="errormessage">{$reg_city_error}</p>
        </div>
        {/if}
</div>

<div class="row">
        <label for="county">County<span class="required">*</span></label>
        <span><input id="county" name="county" value="{$reg_county}" type="text"/></span>
        {if $reg_county_error}
        <div class="error">
                <p class="errormessage">{$reg_county_error}</p>
        </div>
        {/if}
</div>

{if $reg_international}
<div class="row">
        <label for="country">Country<span class="required">*</span></label>
        <span><input id="country" name="country" value="{$reg_country}" type="text"/></span>
        {if $reg_country_error}
        <div class="error">
                <p class="errormessage">{$reg_country_error}</p>
        </div>
        {/if}
</div>
{/if}

<div class="row">
        <label for="postcode">Postcode<span class="required">*</span></label>
        <span><input id="postcode" name="postcode" value="{$reg_postcode}" type="text"/></span>
        {if $reg_postcode_error}
        <div class="error">
                <p class="errormessage">{$reg_postcode_error}</p>
        </div>
        {/if}
</div>

<!--<input type="image" src="images/site/buttons/buttons_15.gif" />-->
<input name="button" value="Submit" type="image" src="./images/site/buttons/buttons_26.gif" />

</form>
