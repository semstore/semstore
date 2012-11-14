<?php /* Smarty version 2.6.10, created on 2008-01-03 06:02:19
         compiled from modules/ecomstore/product_catalogue/subproduct_management/add_subproduct/add_subproduct_confirmation.tpl */ ?>
<div class="input_confirmation">
<p>Please confirm that the following details for the new product are correct.  If they are correct then click 'Submit Details'.  If they are incorrect then click 'Edit Details' to return to the previous page and edit the details.</p>

<table>
        <tr>
                <td class="cell1">Subproduct Name</td>
                <td class="cell2"><?php echo $this->_tpl_vars['name']; ?>
</td>
        </tr>
        <tr>
                <td class="cell1">Type</td>
                <td class="cell2"><?php echo $this->_tpl_vars['typename']; ?>
</td>
        </tr>
        <tr>
                <td class="cell1">Code</td>
                <td class="cell2"><?php echo $this->_tpl_vars['code']; ?>
</td>
        </tr>
        <tr>
                <td class="cell1">Price</td>
                <td class="cell2">&pound;<?php echo $this->_tpl_vars['formattedPrice']; ?>
</td>
        </tr>
        <tr>
                <td class="cell1">VAT Status</td>
                <td class="cell2">
                <?php if ($this->_tpl_vars['vatStatus'] == $this->_tpl_vars['PRODUCT']->PRODUCT_IS_VAT_EXEMPT()): ?>
                This product is exempt from VAT
                <?php elseif ($this->_tpl_vars['vatStatus'] == $this->_tpl_vars['PRODUCT']->PRICE_IS_VAT_EXCLUSIVE()): ?>
                The price is exclusive of VAT
                <?php elseif ($this->_tpl_vars['vatStatus'] == $this->_tpl_vars['PRODUCT']->PRICE_IS_VAT_INCLUSIVE()): ?>
                The price is inclusive of VAT
                <?php endif; ?>
                </td>
        </tr>
        <tr>
                <td class="cell1">Description</td>
                <td class="cell2"><?php echo $this->_tpl_vars['description']; ?>
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
<input name="button" value="Submit Details" type="submit" />
<input name="button" value="Edit Details" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>