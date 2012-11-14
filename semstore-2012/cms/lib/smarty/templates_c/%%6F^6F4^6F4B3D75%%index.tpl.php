<?php /* Smarty version 2.6.10, created on 2008-01-03 05:07:42
         compiled from modules/ecomstore/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h1 class="page_title">eCommerce Web Site Management Tools</h1>

<fieldset class="tools">
<legend>Tools</legend>

<table class="option_buttons">
<tr>
<!--
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/customers/index.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/customer-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/customers/index.php"><p>Customers</p><a/>
</div>
</td>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/customer_groups/index.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/customer-groups-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/customer_groups/index.php"><p>Customer Groups</p><a/>
</div>
</td>
-->
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/index.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/products-catalogue-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/index.php"><p>Products &amp; Categories</p><a/>
</div>
</td>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/orders-and-payments/index.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/orders-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/orders-and-payments/index.php"><p>Orders</p><a/>
</div>
</td>
<td></td>
<td></td>
</tr>
</table>

</fieldset>
