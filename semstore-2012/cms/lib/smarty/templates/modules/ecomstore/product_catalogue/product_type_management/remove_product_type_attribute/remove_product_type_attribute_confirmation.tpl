<div class="input_confirmation">
<p>Please confirm that you wish to remove the following product type feature from the database.</p>
<p>Once removed this cannot be undone.</p>

<table>
        <tr>
                <td class="cell1">Feature Name</td>
                <td class="cell2">{$name}</td>
        </tr>
</table>

<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">

<input name="action" value="{$action}" type="hidden" />

<div class="input_controls">
<input name="button" value="Remove" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>
