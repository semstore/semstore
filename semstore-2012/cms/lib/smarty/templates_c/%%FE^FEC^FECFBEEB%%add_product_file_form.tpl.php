<?php /* Smarty version 2.6.10, created on 2008-01-03 06:05:44
         compiled from modules/ecomstore/product_catalogue/product_management/add_product_file/add_product_file_form.tpl */ ?>
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
<form action="<?php echo $this->_tpl_vars['form']->getAction(); ?>
" method="<?php echo $this->_tpl_vars['form']->getMethod(); ?>
" enctype="multipart/form-data">

<table>
        <tr>
                <td class="cell2" colspan="2"><a href="<?php echo $this->_tpl_vars['filenamepath']; ?>
"><?php echo $this->_tpl_vars['filename']; ?>
</a></td>
        </tr>
        <tr>
                <td class="cell1"><?php echo $this->_tpl_vars['form']->getWidgetLabel($this->_tpl_vars['productfileWidget']->getId()); ?>
</td>
                <td class="cell2"><?php echo $this->_tpl_vars['productfileWidget']->render(); ?>
 </td>
        </tr>
        
        <tr>
                <td class="cell1"><?php echo $this->_tpl_vars['form']->getWidgetLabel($this->_tpl_vars['hfidWidget']->getId()); ?>
</td>
                <td class="cell2"><?php echo $this->_tpl_vars['hfidWidget']->render(); ?>
</td>
        </tr>
        <tr>
                <td class="cell1"><?php echo $this->_tpl_vars['form']->getWidgetLabel($this->_tpl_vars['descriptionWidget']->getId()); ?>
</td>
                <td class="cell2"><?php echo $this->_tpl_vars['descriptionWidget']->render(); ?>
</td>
        </tr>
</table>

<?php echo $this->_tpl_vars['actionWidget']->render(); ?>


<div class="form_controls">
<?php echo $this->_tpl_vars['submitButtonWidget']->render(); ?>

<?php echo $this->_tpl_vars['cancelButtonWidget']->render(); ?>

</div>

</form>
</div>