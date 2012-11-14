<form class="registration" action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}" onsubmit="return validateRegistrationForm();">
<input name="{$action_parameter_name}" value="{$action_parameter_value}" type="hidden"/>

<div class="row">
        <label for="currentpassword">Current Password<span class="required">*</span></label>
        <span><input id="currentpassword" name="currentpassword" value="{$reg_currentpassword}" type="text"/></span>
        {if $reg_currentpassword_error}
        <div class="error">
                <p class="errormessage">{$reg_currentpassword_error}</p>
        </div>
        {/if}
</div>


<div class="row">
        <label for="password1">New Password<span class="required">*</span></label>
        <span><input id="password1" name="password1" value="{$reg_password1}" type="text"/></span>
        {if $reg_password1_error}
        <div class="error">
                <p class="errormessage">{$reg_password1_error}</p>
        </div>
        {/if}
</div>


<div class="row">
        <label for="password2">Confirm New Password<span class="required">*</span></label>
        <span><input id="password2" name="password2" value="{$reg_password2}" type="text"/></span>
        {if $reg_password2_error}
        <div class="error">
                <p class="errormessage">{$reg_password2_error}</p>
        </div>
        {/if}
</div>

<!--<input type="image" src="images/site/buttons/buttons_15.gif" />-->
<input name="button" value="Submit" type="image" src="./images/site/buttons/buttons_26.gif" />

</form>
