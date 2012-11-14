<div class="input_confirmation">
<p>Please confirm that you wish to make the following product a featured product.</p>

<table>
        <tr>
                <td class="cell1">Product Name</td>
                <td class="cell2">{$name}</td>
        </tr>
</table>

<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">

<input name="action" value="{$action}" type="hidden" />

<div class="input_controls">
<input name="button" value="Make Featured Product" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>
