<?php /* Smarty version 2.6.10, created on 2008-01-03 05:27:50
         compiled from modules/ecomstore/product_catalogue/product_management/remove_product_gallery_image/remove_product_gallery_image_confirmation.tpl */ ?>
<div class="input_confirmation">
<p>Please confirm that you wish to remove the following gallery image from the database.</p>
<p>Once removed this cannot be undone.</p>

<table>
        <tr>
                <td class="cell1">Product Image</td>
                <td class="cell2"><img src="<?php echo $this->_tpl_vars['Configuration']->getParameter('site_root_webpath'); ?>
/images/products/<?php echo $this->_tpl_vars['image']; ?>
"/></td>
        </tr>
</table>

<form action="<?php echo $this->_tpl_vars['formAction']; ?>
" method="<?php echo $this->_tpl_vars['formMethod']; ?>
" enctype="<?php echo $this->_tpl_vars['formEncoding']; ?>
">

<input name="action" value="<?php echo $this->_tpl_vars['action']; ?>
" type="hidden" />

<div class="input_controls">
<input name="button" value="Remove" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>