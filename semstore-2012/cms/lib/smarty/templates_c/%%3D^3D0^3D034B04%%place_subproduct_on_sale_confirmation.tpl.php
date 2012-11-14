<?php /* Smarty version 2.6.10, created on 2008-01-03 06:02:59
         compiled from modules/ecomstore/product_catalogue/subproduct_management/place_subproduct_on_sale/place_subproduct_on_sale_confirmation.tpl */ ?>
<div class="input_confirmation">
<p>Please confirm that you wish to place the following subproduct on sale in your store.</p>

<table>
        <tr>
                <td class="cell1">Product Name</td>
                <td class="cell2"><?php echo $this->_tpl_vars['subproduct']->getName(); ?>
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
<input name="button" value="Place On Sale" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>