<?php /* Smarty version 2.6.10, created on 2008-01-03 05:26:14
         compiled from modules/ecomstore/product_catalogue/product_type_management/add_product_type/add_product_type_confirmation.tpl */ ?>
<div class="input_confirmation">
<p>Please confirm that the following details for the product type are correct.  If they are correct then click 'Submit Details'.</p>
<p>If they are incorrect then click 'Edit Details' to return to the previous page and edit the details.</p>

<table>
        <tr>
                <td class="cell1">Type Name</td>
                <td class="cell2"><?php echo $this->_tpl_vars['name']; ?>
</td>
        </tr>
</table>

<form action="<?php echo $this->_tpl_vars['formAction']; ?>
" method="<?php echo $this->_tpl_vars['formMethod']; ?>
" enctype="<?php echo $this->_tpl_vars['formEncType']; ?>
">

<input name="action" value="<?php echo $this->_tpl_vars['action']; ?>
" type="hidden" />

<div class="input_controls">
<input name="button" value="Submit Details" type="submit" />
<input name="button" value="Edit Details" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>