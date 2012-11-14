<?php /* Smarty version 2.6.10, created on 2008-01-03 05:28:06
         compiled from modules/ecomstore/product_catalogue/product_management/manage_product_images.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1 class="page_title">Product Images for <span><?php echo $this->_tpl_vars['product']->getName(); ?>
<span></h1>

<div class="browser_thumbnail">
<h2>Product Browser Thumbnail</h2>
<?php if ($this->_tpl_vars['product_browser_thumbnail_image'] != ''): ?>
<img src="<?php echo $this->_tpl_vars['product_browser_thumbnail_image']; ?>
" /><br />
<?php else: ?>
<div class="browser_thumbnail_placeholder"></div>
<?php endif; ?>
<a href="upload_browser_thumbnail_image.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Upload a new Image</a>
</div>

<div class="product_details_page_image">
<h2>Product Details Page Image</h2>
<?php if ($this->_tpl_vars['product_details_page_image'] != ''): ?>
<img src="<?php echo $this->_tpl_vars['product_details_page_image']; ?>
" /><br />
<?php else: ?>
<div class="product_details_page_placeholder"></div>
<?php endif; ?>
<a href="upload_product_details_page_image.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Upload a new Image</a>
</div>

<div class="basket_image">
<h2>Basket Image</h2>
<?php if ($this->_tpl_vars['basket_image'] != ''): ?>
<img src="<?php echo $this->_tpl_vars['basket_image']; ?>
" /><br />
<?php else: ?>
<div class="basket_image_placeholder"></div>
<?php endif; ?>
<a href="upload_basket_image.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Upload a new Image</a>
</div>

<div class="product_image">
<h2>Fullsize Product Image</h2>
<?php if ($this->_tpl_vars['product_image'] != ''): ?>
<img src="<?php echo $this->_tpl_vars['product_image']; ?>
" /><br />
<?php else: ?>
<div class="product_image_placeholder"></div>
<?php endif; ?>
<a href="upload_fullsize_product_image.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Upload a new Image</a>
</div>
