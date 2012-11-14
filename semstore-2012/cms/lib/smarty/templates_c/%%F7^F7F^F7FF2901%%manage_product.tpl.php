<?php /* Smarty version 2.6.10, created on 2008-01-03 05:27:08
         compiled from modules/ecomstore/product_catalogue/product_management/manage_product.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h1 class="page_title">Profile for product <span><?php echo $this->_tpl_vars['product']->getName(); ?>
<span></h1>


<fieldset class="tools">
<legend>Tools</legend>
<br />
<?php if ($this->_tpl_vars['product']->onSale()): ?>
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/remove_product_from_sale.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Remove Product from Sale</a>
<?php else: ?>
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/place_product_on_sale.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Place Product on Sale</a>
<?php endif; ?>
<br /><br />
<a href="manage_product_image_gallery.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Manage Product Image Gallery</a>
<br /><br />
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/manage_product_images.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Manage Product Images</a>
<br /><br />
<?php if ($this->_tpl_vars['product']->isSpecialOffer()): ?>
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/remove_product_special_offer.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Remove Product from Special Offers</a>
<?php else: ?>
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/make_product_special_offer.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Make Product a Special Offer</a>
<?php endif; ?>
<br /><br />
<?php if ($this->_tpl_vars['product']->isFeaturedProduct()): ?>
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/remove_from_featured_products.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Remove from Featured Products</a>
<?php else: ?>
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/add_to_featured_products.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Add to Featured Products</a>
<?php endif; ?>
<br /><br />
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/subproduct_management/add_subproduct.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Add Subproduct</a>
<br /><br />
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/add_suggested_product.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Add Suggested Product</a>
<br /><br />
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/add_product_file.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Add Product File</a>
<br /><br />
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/copy_product.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Copy Product</a>
</fieldset>


<div class="product_details">
<fieldset>
<legend>Product Details</legend>
<table cellspacing="0">
        <tr>
                <th>Product Name</th>
                <td><?php echo $this->_tpl_vars['product']->getName(); ?>
</td>
        </tr>
        <tr>
                <th>Product Type</th>
                <td><?php if ($this->_tpl_vars['type']):  echo $this->_tpl_vars['type']->getName();  else: ?>None<?php endif; ?></td>
        </tr>
        <tr>
                <th>Product Code</th>
                <td><?php echo $this->_tpl_vars['product']->getCode(); ?>
</td>
        </tr>
        <tr>
                <th>Product Price</th>
                <td>&pound;<?php echo $this->_tpl_vars['product']->formattedPrice(); ?>
</td>
        </tr>
        <tr>
                <th>VAT Status</th>
                <td>
                <?php if ($this->_tpl_vars['product']->getVatStatus() == $this->_tpl_vars['product']->PRODUCT_IS_VAT_EXEMPT()): ?>
                This product is exempt from VAT
                <?php elseif ($this->_tpl_vars['product']->getVatStatus() == $this->_tpl_vars['product']->PRICE_IS_VAT_EXCLUSIVE()): ?>
                The price is exclusive of VAT
                <?php elseif ($this->_tpl_vars['product']->getVatStatus() == $this->_tpl_vars['product']->PRICE_IS_VAT_INCLUSIVE()): ?>
                The price is inclusive of VAT
                <?php else: ?>
                There is a problem in the database with this products VAT status flag
                <?php endif; ?>
                </td>
        </tr>
        <tr>
                <th>Description</th>
                <td><?php echo $this->_tpl_vars['product']->getDescription(); ?>
</td>
        </tr>
</table>
</fieldset>

<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/edit_product.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Edit</a>
</div>




<div class="product_details">
<fieldset>
<legend>Product Wide Feature Points and Features</legend>
<?php $_from = $this->_tpl_vars['globalGroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['globalGroup']):
?>
<h2><?php echo $this->_tpl_vars['globalGroup']->getName(); ?>
</h2>
<?php if ($this->_tpl_vars['globalGroup']->getAttributes()): ?>
<table cellspacing="0">
        <tr>
                <th>Feature Name</th>
                <th>Feature Value</th>
        <tr>
        <?php $_from = $this->_tpl_vars['globalGroup']->getAttributes(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['globalAttribute']):
?>
        <tr>
                <td><?php echo $this->_tpl_vars['globalAttribute']->getName(); ?>
</td>
                <td><?php echo $this->_tpl_vars['globalAttribute']->getValue(); ?>
</td>
        <tr>
        <?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<p>This group does not have any attributes in it.</p>
<?php endif;  endforeach; endif; unset($_from); ?>
</fieldset>
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/edit_global_product_attributes.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Edit</a>
</div>




<div class="product_details">
<fieldset>
<legend>Product Type Feature Points and Features</legend>
<?php $_from = $this->_tpl_vars['typeGroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['typeGroup']):
?>
<h2><?php echo $this->_tpl_vars['typeGroup']->getName(); ?>
</h2>
<?php if ($this->_tpl_vars['typeGroup']->getAttributes()): ?>
<table cellspacing="0">
        <tr>
                <th>Feature Name</th>
                <th>Feature Value</th>
        <tr>
        <?php $_from = $this->_tpl_vars['typeGroup']->getAttributes(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['typeAttribute']):
?>
        <tr>
                <td><?php echo $this->_tpl_vars['typeAttribute']->getName(); ?>
</td>
                <td><?php echo $this->_tpl_vars['typeAttribute']->getValue(); ?>
</td>
        <tr>
        <?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<p>This group does not have any attributes in it.</p>
<?php endif;  endforeach; endif; unset($_from); ?>
</fieldset>
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/edit_product_type_attributes.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Edit</a>
</div>



<div class="product_details">
<fieldset>
<legend>Subproducts</legend>
<?php if ($this->_tpl_vars['subproducts']): ?>
<table>
<tr>
<th class="type_column_heading">Subproduct Name</th>
<th class="options_column_heading">Options</th>
</tr>
<?php $_from = $this->_tpl_vars['subproducts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subproduct']):
?>
<tr>
<td class="type_column"><?php echo $this->_tpl_vars['subproduct']->getName(); ?>
</td>
<td class="options_column">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/subproduct_management/manage_subproduct.php?subproductid=<?php echo $this->_tpl_vars['subproduct']->getId(); ?>
">View</a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/subproduct_management/remove_subproduct.php?subproductid=<?php echo $this->_tpl_vars['subproduct']->getId(); ?>
">Remove</a>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<p>There are currently no products in the database.</p>
<?php endif; ?>
</div>





<div class="product_details">
<fieldset>
<legend>Suggested Products</legend>
<?php if ($this->_tpl_vars['suggestedProductLinks']): ?>
<table>
<tr>
<th class="type_column_heading">Suggested Product Name</th>
<th class="options_column_heading">Options</th>
</tr>
<?php $_from = $this->_tpl_vars['suggestedProductLinks']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['suggestedProductLink']):
 $this->assign('suggestedProduct', $this->_tpl_vars['suggestedProductLink']->suggestedProduct()); ?>
<tr>
<td class="type_column"><?php echo $this->_tpl_vars['suggestedProduct']->getName(); ?>
</td>
<td class="options_column">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/remove_suggested_product.php?suggestedproductid=<?php echo $this->_tpl_vars['suggestedProductLink']->getId(); ?>
">Remove</a>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<p>There are currently no products in the database.</p>
<?php endif; ?>
</div>






<div class="product_details">
<fieldset>
<legend>Product Files</legend>
<?php if ($this->_tpl_vars['productFiles']): ?>
<table>
<tr>
<th class="type_column_heading">Human Friendly Identifier</th>
<th class="type_column_heading">Description</th>
<th class="options_column_heading">Options</th>
</tr>
<?php $_from = $this->_tpl_vars['productFiles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['productFile']):
?>
<tr>
<td class="type_column"><?php echo $this->_tpl_vars['productFile']->getHFID(); ?>
</td>
<td class="type_column"><?php echo $this->_tpl_vars['productFile']->getDescription(); ?>
</td>
<td class="options_column">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_management/remove_product_file.php?fileid=<?php echo $this->_tpl_vars['productFile']->getId(); ?>
">Remove</a>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<p>There are currently no files for this product in the database.</p>
<?php endif; ?>

</div>