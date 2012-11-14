<div class="input_confirmation">
<p>Please confirm that the following details for the product are correct.  If they are correct then click 'Submit Details'.  If they are incorrect then click 'Edit Details' to return to the previous page and edit the details.</p>

{foreach item="group" from=$fieldsArray}
<fieldset>
<legend>{$group.name}</legend>
{if $group.attributes}
<table>
        {foreach item="attribute" from=$group.attributes}
        <tr>
                <td class="cell1">{$attribute.name}</td>
                <td class="cell2">{$attribute.value}</td>
        </tr>
        {/foreach}
</table>
{/if}
</fieldset>
{/foreach}

<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">

<input name="action" value="{$action}" type="hidden" />

<div class="input_controls">
<input name="button" value="Submit Details" type="submit" />
<input name="button" value="Edit Details" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>
