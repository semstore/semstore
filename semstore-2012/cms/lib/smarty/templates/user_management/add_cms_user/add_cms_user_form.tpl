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
<form action="{$form->getAction()}" method="{$form->getMethod()}" enctype="{$form->getEncoding()}">

<table>
        <tr>
                <td class="cell1">{$form->getWidgetLabel($firstnameWidget->getId())}</td>
                <td class="cell2">{$firstnameWidget->render()}</td>
        </tr>
        <tr>
                <td class="cell1">{$form->getWidgetLabel($surnameWidget->getId())}</td>
                <td class="cell2">{$surnameWidget->render()}</td>
        </tr>
        <tr>
                <td class="cell1">{$form->getWidgetLabel($emailWidget->getId())}</td>
                <td class="cell2">{$emailWidget->render()}</td>
        </tr>
        <tr>
                <td class="cell1">{$form->getWidgetLabel($usernameWidget->getId())}</td>
                <td class="cell2">{$usernameWidget->render()}</td>
        </tr>
        <tr>
                <td class="cell1">{$form->getWidgetLabel($passwordWidget->getId())}</td>
                <td class="cell2">{$passwordWidget->render()}</td>
        </tr>
        <tr>
                <td class="cell1">{$form->getWidgetLabel($password2Widget->getId())}</td>
                <td class="cell2">{$password2Widget->render()}</td>
        </tr>
        <tr>
                <td class="cell1">{$form->getWidgetLabel($autopasswordWidget->getId())}</td>
                <td class="cell2">{$autopasswordWidget->render()}</td>
        </tr>
        <tr>
                <td class="cell1">{$form->getWidgetLabel($emailuserdetailsWidget->getId())}</td>
                <td class="cell2">{$emailuserdetailsWidget->render()}</td>
        </tr>
</table>

{$actionWidget->render()}

<div class="form_controls">
{$submitButtonWidget->render()}
{$cancelButtonWidget->render()}
</div>

</form>
</div>
