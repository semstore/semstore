<?php /* Smarty version 2.6.10, created on 2008-01-03 06:00:52
         compiled from modules/ecomstore/product_catalogue/product_management/add_to_featured_products/add_to_featured_products_confirmation.tpl */ ?>
<div class="input_confirmation">
<p>Please confirm that you wish to make the following product a featured product.</p>

<table>
        <tr>
                <td class="cell1">Product Name</td>
                <td class="cell2"><?php echo $this->_tpl_vars['name']; ?>
</td>
        </tr>
</table>

<form action="<?php echo $this->_tpl_vars['formAction']; ?>
" method="<?php echo $this->_tpl_vars['formMethod']; ?>
" enctype="<?php echo $this->_tpl_vars['formEncoding']; ?>
">

<input name="action" value="<?php echo $this->_tpl_vars['action']; ?>
" type="hidden" />

<div class="input_controls">
<input name="button" value="Make Featured Product" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>