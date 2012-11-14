<?php /* Smarty version 2.6.10, created on 2008-01-03 05:27:18
         compiled from modules/ecomstore/product_catalogue/product_management/upload_product_gallery_images/upload_gallery_image_form.tpl */ ?>
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

<input name="productImage" type="file" />

<div class="form_controls">
<input name="button" value="Submit Details" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>