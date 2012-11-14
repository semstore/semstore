<div class="input_confirmation">
<p>Please confirm that the following details for the new user are correct.  If they are correct then click 'Submit Details'.  If they are incorrect then click 'Edit Details' to return to the previous page and edit the details.</p>

<table>
        <tr>
                <td class="cell1">Firstname</td>
                <td class="cell2">{$firstname}</td>
        </tr>
        <tr>
                <td class="cell1">Surname</td>
                <td class="cell2">{$surname}</td>
        </tr>
        <tr>
                <td class="cell1">Email</td>
                <td class="cell2">{$email}</td>
        </tr>
        <tr>
                <td class="cell1">Username</td>
                <td class="cell2">{$username}</td>
        </tr>
        <tr>
                <td class="cell1">Password</td>
                <td class="cell2">{$password}</td>
        </tr>
        <tr>
                <td class="cell1">Email Account Details to User?</td>
                <td class="cell2">{if $emailUserDetails}YES{else}NO{/if}</td>
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
