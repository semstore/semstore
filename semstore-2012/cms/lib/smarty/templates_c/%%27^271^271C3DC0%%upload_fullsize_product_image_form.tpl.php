<?php /* Smarty version 2.6.10, created on 2008-01-03 05:28:09
         compiled from modules/ecomstore/product_catalogue/product_management/upload_product_images/upload_fullsize_product_image_form.tpl */ ?>
<?php if ($this->_tpl_vars['formErrorCount'] > 0): ?>
<div class="form_errors">
<p class="title">Submission Errors</p>
<p>There were errors with the data you have submitted.  
Please correct the errors list below and submit the data again.</p>
<ul>
        <li><?php echo $this->_tpl_vars['uploadedImageFileErrMsg']; ?>
</li>
</ul>
</div>
<?php endif; ?>


<div class="input_form">
<form action="<?php echo $this->_tpl_vars['formAction']; ?>
" method="<?php echo $this->_tpl_vars['formMethod']; ?>
" enctype="<?php echo $this->_tpl_vars['formEncoding']; ?>
">
<input name="action" value="<?php echo $this->_tpl_vars['action']; ?>
" type="hidden" />

<input id="createProductBrowserImage" name="createProductBrowserImage" value="true" type="checkbox"<?php if ($this->_tpl_vars['createProductBrowserImage'] == 'true'): ?> checked<?php endif; ?> />
<label for="createProductBrowserImage">Create Product Browser Image</label>
<br />

<input id="createProductDetailsPageImage" name="createProductDetailsPageImage" value="true" type="checkbox"<?php if ($this->_tpl_vars['createProductDetailsPageImage'] == 'true'): ?> checked<?php endif; ?> />
<label for="createProductDetailsPageImage">Create Product Details Page Image</label>
<br />

<input id="createBasketImage" name="createBasketImage" value="true" type="checkbox"<?php if ($this->_tpl_vars['createBasketImage'] == 'true'): ?> checked<?php endif; ?> />
<label for="createBasketImage">Create Basket Image</label>
<br />

<input name="productImage" type="file" />

<div class="form_controls">
<input name="button" value="Submit Details" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>