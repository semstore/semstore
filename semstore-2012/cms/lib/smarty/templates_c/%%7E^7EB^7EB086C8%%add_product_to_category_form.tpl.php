<?php /* Smarty version 2.6.10, created on 2008-01-03 05:24:26
         compiled from modules/ecomstore/product_catalogue/catalogue_management/add_product_to_category/add_product_to_category_form.tpl */ ?>
<?php if ($this->_tpl_vars['formErrors']): ?>
<div class="form_errors">
<p class="title">Submission Errors</p>
<p>There were errors with the data you have submitted.  
Please correct the errors list below and submit the data again.</p>
<ul>
<?php $_from = $this->_tpl_vars['formErrors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['formError']):
?>
        <li><?php echo $this->_tpl_vars['formError']; ?>
</li>
<?php endforeach; endif; unset($_from); ?>
</ul>
</div>
<?php endif; ?>

<div class="input_form">

<table>
        <?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
        <tr>
                <td class="cell1"><?php echo $this->_tpl_vars['product']->getName(); ?>
</td>
                <td class="cell2"><a href="add_product_to_category.php?categoryid=<?php echo $this->_tpl_vars['category']->getId(); ?>
&amp;productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
&amp;action=add_product_to_category">Add</a></td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
</table>

<form action="<?php echo $this->_tpl_vars['formAction']; ?>
" method="<?php echo $this->_tpl_vars['formMethod']; ?>
" enctype="<?php echo $this->_tpl_vars['formEncoding']; ?>
">
<input name="action" value="<?php echo $this->_tpl_vars['action']; ?>
" type="hidden" />
<div class="form_controls">
<input name="button" value="Cancel" type="submit" />
</div>
</form>

</div>