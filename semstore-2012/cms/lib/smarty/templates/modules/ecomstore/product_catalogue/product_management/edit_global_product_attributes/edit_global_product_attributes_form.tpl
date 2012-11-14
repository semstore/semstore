{if $formErrors}
<div class="form_errors">
<p class="title">Submission Errors</p>
<p>There were errors with the data you have submitted.  
Please correct the errors list below and submit the data again.</p>
<ul>
{foreach item="formError" from=$formErrors}
        <li>{$formError}</li>
{/foreach}
</ul>
</div>
{/if}

<div class="input_form">
<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">

{foreach item="group" from=$fieldsArray}
<fieldset>
<legend>{$group.name}</legend>
{if $group.attributes}
<table>
        {foreach item="attribute" from=$group.attributes}
        <tr>
                <td class="cell1">{$attribute.name}</td>
                <td class="cell2">
                        <textarea name="attribute{$attribute.attributeId}" cols="30" rows="3">{$attribute.value}</textarea>
                </td>
        </tr>
        {/foreach}
</table>
{/if}
</fieldset>
{/foreach}


<input name="action" value="{$action}" type="hidden" />

<div class="form_controls">
<input name="button" value="Submit Details" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>
