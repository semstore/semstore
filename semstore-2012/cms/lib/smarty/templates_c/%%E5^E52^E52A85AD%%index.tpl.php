<?php /* Smarty version 2.6.10, created on 2008-01-03 05:08:12
         compiled from modules/ecomstore/product_catalogue/product_type_management/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h1 class="page_title">Product Type Management</h1>

<fieldset class="tools">
<legend>Tools</legend>
<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_type_management/add_product_type.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/add-product-type-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_type_management/add_product_type.php"><p>Add Product Type</p><a/>
</div>
</td>
<td></td>
<td></td>
<td></td>
</tr>
</table>
</fieldset>




<div class="product_types">
<fieldset>
<legend>Product Types</legend>


<?php if ($this->_tpl_vars['types']): ?>
<table width="100%" class="trhover">
<tr>
<th ><strong>Type Name</strong></th>
<th width="150" align="center" ><strong>Options</strong></th>
</tr>
<?php $_from = $this->_tpl_vars['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['type']):
?>
<tr>
<td ><?php echo $this->_tpl_vars['type']->getName(); ?>
</td>
<td align="center" >
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_type_management/manage_product_type.php?typeid=<?php echo $this->_tpl_vars['type']->getId(); ?>
">View</a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_type_management/remove_product_type.php?typeid=<?php echo $this->_tpl_vars['type']->getId(); ?>
">Remove</a></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<p>There are currently no product attributes in the database.</p>
<?php endif; ?>
</div>

</fieldset>
</div>