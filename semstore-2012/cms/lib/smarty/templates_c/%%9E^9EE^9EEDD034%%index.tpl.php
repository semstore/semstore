<?php /* Smarty version 2.6.10, created on 2008-01-03 05:20:14
         compiled from modules/ecomstore/product_catalogue/catalogue_management/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1 class="page_title">Category Management</h1>

<fieldset class="tools">
<legend>Tools</legend>
<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/add_top_level_product_category.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/add-category-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/add_top_level_product_category.php"><p>Add Top Level Category</p></a>
</div>
</td>
<td></td>
<td></td>
<td></td>
</tr>
</table>
</fieldset>


<div class="product_categories">
<fieldset>
<legend>Top Level Categories</legend>
<?php if ($this->_tpl_vars['roots']): ?>
<table class="trhover">
<tr>
<th >Category Name</th>
<th width="150" align="center">Options</th>
</tr>
<?php $_from = $this->_tpl_vars['roots']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['root']):
?>
<tr>
<td ><?php echo $this->_tpl_vars['root']->getName(); ?>
</td>
<td align="center">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/manage_product_category.php?categoryid=<?php echo $this->_tpl_vars['root']->getId(); ?>
">View</a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/remove_top_level_product_category.php?categoryid=<?php echo $this->_tpl_vars['root']->getId(); ?>
">Remove</a>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<p>There are currently no top level categories in the database.</p>
<?php endif; ?>
</fieldset>
</div>
