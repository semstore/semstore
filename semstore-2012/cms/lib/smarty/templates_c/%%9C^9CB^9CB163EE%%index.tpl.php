<?php /* Smarty version 2.6.10, created on 2008-01-03 05:07:45
         compiled from modules/ecomstore/product_catalogue/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h1 class="page_title">Products &amp; Categories</h1>

<fieldset class="tools">
<legend>Tools</legend>

<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/index.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/manage-products-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/index.php"><p>Manage Products</p><a/>
</div>
</td>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_global_attribute_management/index.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/general-features-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_global_attribute_management/index.php"><p>Manage General Features</p><a/>
</div>
</td>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_type_management/index.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/product-types-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_type_management/index.php"><p>Manage Product Types</p><a/>
</div>
</td>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/index.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/manage-catalogue-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/index.php"><p>Manage Categories</p><a/>
</div>
</td>
<td></td>
</tr>
</table>

</fieldset>
