<?php /* Smarty version 2.6.10, created on 2008-01-03 05:27:16
         compiled from modules/ecomstore/product_catalogue/product_management/manage_product_image_gallery.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1 class="page_title">Product Image Gallery for <span><?php echo $this->_tpl_vars['product']->getName(); ?>
<span></h1>

<div class="thumbnails">

<?php $_from = $this->_tpl_vars['galleryItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['galleryItem']):
?>
<div class="gallery_thumbnail">
<img src="<?php echo $this->_tpl_vars['Configuration']->getParameter('site_root_webpath'); ?>
/images/products/<?php echo $this->_tpl_vars['galleryItem']->getThumbnail(); ?>
" /><br />
<p>
<a href="remove_product_gallery_image.php?gallery=<?php echo $this->_tpl_vars['galleryItem']->getGalleryId(); ?>
">Delete Image</a>
</p>
</div>
<?php endforeach; endif; unset($_from); ?>



<a href="upload_product_gallery_image.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Upload a new Image</a>

</div>