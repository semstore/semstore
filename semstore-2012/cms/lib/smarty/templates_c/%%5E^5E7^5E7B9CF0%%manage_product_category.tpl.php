<?php /* Smarty version 2.6.10, created on 2008-01-03 05:22:27
         compiled from modules/ecomstore/product_catalogue/catalogue_management/manage_product_category.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1 class="page_title">Category: <?php echo $this->_tpl_vars['category']->getName(); ?>
</h1>

<fieldset class="tools">
<legend>Tools</legend>
<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/edit_product_category.php?categoryid=<?php echo $this->_tpl_vars['category']->getId(); ?>
"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/edit-category-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/edit_product_category.php?categoryid=<?php echo $this->_tpl_vars['category']->getId(); ?>
"><p>Edit Category</p></a>
</div>
</td>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/upload_product_category_image.php?categoryid=<?php echo $this->_tpl_vars['category']->getId(); ?>
"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/upload-category-image.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/upload_product_category_image.php?categoryid=<?php echo $this->_tpl_vars['category']->getId(); ?>
"><p>Upload Category Image</p></a>
</div>
</td>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/add_product_subcategory.php?categoryid=<?php echo $this->_tpl_vars['category']->getId(); ?>
"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/add-sub-category.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/add_product_subcategory.php?categoryid=<?php echo $this->_tpl_vars['category']->getId(); ?>
"><p>Add Subcategory</p></a>
</div>
</td>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/add_product_to_category.php?categoryid=<?php echo $this->_tpl_vars['category']->getId(); ?>
"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/add-product-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/add_product_to_category.php?categoryid=<?php echo $this->_tpl_vars['category']->getId(); ?>
"><p>Add Product</p></a>
</div>
</td>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/manage_products_in_category.php?categoryid=<?php echo $this->_tpl_vars['category']->getId(); ?>
"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/add-product-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/manage_products_in_category.php?categoryid=<?php echo $this->_tpl_vars['category']->getId(); ?>
"><p>Manage Products in Category</p></a>
</div>
</td>
</tr>
</table>
</fieldset>







<div class="category_details">
<fieldset>
<legend>Category Details</legend>
<br />
<table cellpadding="5" cellspacing="5">
        <tr>
                <th align="right" valign="top">Name</th>
                <td valign="top"><?php echo $this->_tpl_vars['category']->getName(); ?>
</td>
        </tr>
        <tr>
                <th align="right" valign="top">Description</th>
                <td valign="top"><?php echo $this->_tpl_vars['category']->getDescription(); ?>
</td>
        </tr>
        <tr>
                <th align="right" valign="top">Image</th>
                <td valign="top"><?php if ($this->_tpl_vars['category']->getImage() != ''): ?><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('product_category_images_webpath'); ?>
/<?php echo $this->_tpl_vars['category']->getImage(); ?>
"/><?php else: ?>&lt; No Image Available &gt;
                <?php endif; ?></td>
        </tr>
</table>
<br />
</fieldset>
</div>





<div class="product_categories">
<fieldset>
<legend>Subcategories</legend>
<?php if ($this->_tpl_vars['subcategories']): ?>
<table class="trhover">
<tr>
<th >Category Name</th>
<th width="150" align="center" >Options</th>
</tr>
<?php $_from = $this->_tpl_vars['subcategories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subcategory']):
?>
<tr>
<td ><?php echo $this->_tpl_vars['subcategory']->getName(); ?>
</td>
<td align="center" >
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/manage_product_category.php?categoryid=<?php echo $this->_tpl_vars['subcategory']->getId(); ?>
">View</a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/remove_product_subcategory.php?categoryid=<?php echo $this->_tpl_vars['subcategory']->getId(); ?>
">Remove</a></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<p>There are currently no subcategories in the database for this category.</p>
<?php endif; ?>
</fieldset>
</div>





<div class="product_categories">
<fieldset>
<legend>Products</legend>
<?php if ($this->_tpl_vars['products']): ?>
<table class="trhover">
<tr>
<th >Product Name</th>
<th width="150" align="center" >Options</th>
</tr>
<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['product']):
?>
<tr>
<td ><?php echo $this->_tpl_vars['product']->getName(); ?>
</td>
<td align="center" >
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/catalogue_management/remove_product_from_category.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
&amp;categoryid=<?php echo $this->_tpl_vars['category']->getId(); ?>
">Remove</a></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<p>There are currently no products in the database added to this category.</p>
<?php endif; ?>
</fieldset>
</div>

