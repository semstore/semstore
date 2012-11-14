<div class="input_confirmation">
<p>Please confirm that you wish to remove the following product file.</p>

<table>
        <tr>
                <td class="cell1">Product File</td>
                <td class="cell2"><a href="{$filenamepath}">{$filename}</a></td>
        </tr>
        <tr>
                <td class="cell1">Human Friendly Identifier</td>
                <td class="cell2">{$hfid}</td>
        </tr>
        <tr>
                <td class="cell1">File Description</td>
                <td class="cell2">{$description}</td>
        </tr>
</table>

<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">

<input name="action" value="{$action}" type="hidden" />

<div class="input_controls">
<input name="button" value="Remove Product File" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>

