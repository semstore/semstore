<?php /* Smarty version 2.6.10, created on 2008-01-03 05:08:04
         compiled from modules/ecomstore/product_catalogue/product_management/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h1 class="page_title">Product Management</h1>



<fieldset class="tools">
<legend>Tools</legend>
<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/add_product.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/add-product-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/add_product.php"><p>Add Product</p><a/>
</div>
</td>
<td></td>
<td></td>
<td></td>
</tr>
</table>
</fieldset>


<fieldset class="tools">
<legend>Search</legend>
<form action="" method="GET">
<p> Product Name <input type="text" name="productName" value="<?php echo $this->_tpl_vars['searchValue']; ?>
" /> <input type="submit" value="Submit"/> <input type="reset" value="Reset" /></p>
</fieldset>

<div class="products">
<fieldset>
<legend>Products</legend>

<?php if ($this->_tpl_vars['searchPager']['totalPages'] > 1): ?>
<p>Showing <?php echo $this->_tpl_vars['searchPager']['hitsPerPage']; ?>
 results starting at <?php echo $this->_tpl_vars['searchPager']['criteria']['st']+1; ?>
 of <?php echo $this->_tpl_vars['searchPager']['totalHits']; ?>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['products']): ?>
<table width="100%" class="trhover">
<tr>
<th align="center" >Product Name</th>
<th align="center" >Code</th>
<th align="center" >Price</th>
<th width="150" align="center" >Options</th>
</tr>
<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
<tr>
<td ><?php echo $this->_tpl_vars['product']->getName(); ?>
</td>
<td align="center" ><?php echo $this->_tpl_vars['product']->getCode(); ?>
</td>
<td align="center" >&pound;<?php echo $this->_tpl_vars['product']->formattedPrice(); ?>
</td>
<td width="150" align="center" >
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/manage_product.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">View</a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/remove_product.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Remove</a></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<?php if ($this->_tpl_vars['searchPager']['totalPages'] > 1): ?>
<p>Page
<?php $_from = $this->_tpl_vars['searchPager']['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pageNumber'] => $this->_tpl_vars['pagerPage']):
?>
<?php if ($this->_tpl_vars['pagerPage']['is_current']): ?>
<?php if (! $this->_tpl_vars['pagerPage']['is_last']): ?>
<?php echo $this->_tpl_vars['pageNumber']; ?>
&nbsp;|&nbsp;
<?php else: ?>
<?php echo $this->_tpl_vars['pageNumber']; ?>

<?php endif; ?>
<?php elseif (! $this->_tpl_vars['pagerPage']['is_last']): ?>
<a href="?<?php echo $this->_tpl_vars['pagerPage']['uri']; ?>
"><?php echo $this->_tpl_vars['pageNumber']; ?>
</a>&nbsp;|&nbsp;
<?php else: ?>
<a href="?<?php echo $this->_tpl_vars['pagerPage']['uri']; ?>
"><?php echo $this->_tpl_vars['pageNumber']; ?>
</a>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
of <?php echo $this->_tpl_vars['searchPager']['totalPages']; ?>
</p>
<?php endif; ?>
<?php else: ?>
<p>There are currently no products in the database.</p>
<?php endif; ?>
</div>

