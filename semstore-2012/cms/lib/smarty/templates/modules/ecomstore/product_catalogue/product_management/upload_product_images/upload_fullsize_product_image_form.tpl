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

<input id="createProductBrowserImage" name="createProductBrowserImage" value="true" type="checkbox"{if $createProductBrowserImage eq 'true'} checked{/if} />
<label for="createProductBrowserImage">Create Product Browser Image</label>
<br />

<input id="createProductDetailsPageImage" name="createProductDetailsPageImage" value="true" type="checkbox"{if $createProductDetailsPageImage eq 'true'} checked{/if} />
<label for="createProductDetailsPageImage">Create Product Details Page Image</label>
<br />

<input id="createBasketImage" name="createBasketImage" value="true" type="checkbox"{if $createBasketImage eq 'true'} checked{/if} />
<label for="createBasketImage">Create Basket Image</label>
<br />

<input name="productImage" type="file" />

<div class="form_controls">
<input name="button" value="Submit Details" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>
