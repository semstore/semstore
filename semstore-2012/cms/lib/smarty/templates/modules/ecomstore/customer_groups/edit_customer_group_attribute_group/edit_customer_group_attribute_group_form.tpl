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
                <td class="cell1">{$form->getWidgetLabel($nameWidget->getId())}</td>
                <td class="cell2">{$nameWidget->render()}</td>
        </tr>
</table>

{$actionWidget->render()}

<div class="form_controls">
{$submitButtonWidget->render()}
{$cancelButtonWidget->render()}
</div>

</form>
</div>
