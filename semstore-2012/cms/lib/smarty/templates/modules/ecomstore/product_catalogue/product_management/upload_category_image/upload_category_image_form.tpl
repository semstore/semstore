{if $formErrorCount > 0}
<div class="form_errors">
<p class="title">Submission Errors</p>
<p>There were errors with the data you have submitted.  
Please correct the errors list below and submit the data again.</p>
<ul>
        <li>{$uploadedImageFileErrMsg}</li>
</ul>
</div>
{/if}


<div class="input_form">
<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">
<input name="action" value="{$action}" type="hidden" />

<input name="categoryImage" type="file" />

<div class="form_controls">
<input name="button" value="Submit Details" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>
