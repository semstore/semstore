<?php /* Smarty version 2.6.10, created on 2008-01-03 06:07:17
         compiled from modules/ecomstore/product_catalogue/product_management/add_product_file/add_product_file_confirmation.tpl */ ?>
<div class="input_confirmation">
<p>Please confirm that the following details for the new product are correct.  If they are correct then click 'Submit Details'.  If they are incorrect then click 'Edit Details' to return to the previous page and edit the details.</p>

<table>
        <tr>
                <td class="cell1">Product File</td>
                <td class="cell2"><a href="<?php echo $this->_tpl_vars['filenamepath']; ?>
"><?php echo $this->_tpl_vars['filename']; ?>
</a></td>
        </tr>
        <tr>
                <td class="cell1">Human Friendly Identifier</td>
                <td class="cell2"><?php echo $this->_tpl_vars['hfid']; ?>
</td>
        </tr>
        <tr>
                <td class="cell1">File Description</td>
                <td class="cell2"><?php echo $this->_tpl_vars['description']; ?>
</td>
        </tr>
</table>

<form action="<?php echo $this->_tpl_vars['formAction']; ?>
" method="<?php echo $this->_tpl_vars['formMethod']; ?>
" enctype="multipart/form-data">

<input name="action" value="<?php echo $this->_tpl_vars['action']; ?>
" type="hidden" />

<div class="input_controls">
<input name="button" value="Submit Details" type="submit" />
<input name="button" value="Edit Details" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>