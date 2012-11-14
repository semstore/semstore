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
        <tr>
                <td class="cell1">Type</td>
                <td class="cell2">{$typename}</td>
        </tr>
        <tr>
                <td class="cell1">{$form->getWidgetLabel($codeWidget->getId())}</td>
                <td class="cell2">{$codeWidget->render()}</td>
        </tr>
        <tr>
                <td class="cell1">{$form->getWidgetLabel($priceWidget->getId())}</td>
                <td class="cell2">{$priceWidget->render()}</td>
        </tr>
        <tr>
                <td class="cell1">{$form->getWidgetLabel($vatstatusWidget->getId())}</td>
                <td class="cell2">{$vatstatusWidget->render()}</td>
        </tr>
        <tr>
                <td class="cell1">{$form->getWidgetLabel($descriptionWidget->getId())}</td>
                <td class="cell2">{$descriptionWidget->render()}</td>
        </tr>
</table>

{$actionWidget->render()}

<div class="form_controls">
{$submitButtonWidget->render()}
{$cancelButtonWidget->render()}
</div>

</form>
</div>
