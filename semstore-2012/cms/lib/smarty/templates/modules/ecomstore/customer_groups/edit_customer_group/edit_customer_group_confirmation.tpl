<div class="input_confirmation">
<p>Please confirm that the following details for the customer group are correct.  If they are correct then click 'Submit Details'.</p>
<p>If they are incorrect then click 'Edit Details' to return to the previous page and edit the details.</p>

<table>
        <tr>
                <td class="cell1">Group Name</td>
                <td class="cell2">{$name}</td>
        </tr>
        <tr>
                <td class="cell1">Description</td>
                <td class="cell2">{$description}</td>
        </tr>
</table>

<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">

<input name="action" value="{$action}" type="hidden" />

<div class="input_controls">
<input name="button" value="Submit Details" type="submit" />
<input name="button" value="Edit Details" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>
