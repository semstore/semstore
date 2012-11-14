<?php /* Smarty version 2.6.10, created on 2008-01-03 06:19:08
         compiled from modules/ecomstore/product_catalogue/subproduct_management/manage_subproduct.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h1 class="page_title">Profile for subproduct <span><?php echo $this->_tpl_vars['subproduct']->getName(); ?>
<span></h1>


<fieldset class="tools">
<legend>Tools</legend>
<br />
<?php if ($this->_tpl_vars['subproduct']->onSale()): ?>
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/subproduct_management/remove_subproduct_from_sale.php?subproductid=<?php echo $this->_tpl_vars['subproduct']->getId(); ?>
">Remove Subproduct from Sale</a>
<?php else: ?>
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/subproduct_management/place_subproduct_on_sale.php?subproductid=<?php echo $this->_tpl_vars['subproduct']->getId(); ?>
">Place Subproduct on Sale</a>
<?php endif; ?>
<br /><br />
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/subproduct_management/manage_subproduct_images.php?subproductid=<?php echo $this->_tpl_vars['subproduct']->getId(); ?>
">Manage Subproduct Images</a>
<br /><br />
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/subproduct_management/copy_subproduct.php?subproductid=<?php echo $this->_tpl_vars['subproduct']->getId(); ?>
">Copy Subproduct</a>
</fieldset>


<div class="product_details">
<fieldset>
<legend>Product Details</legend>
<table cellspacing="0">
        <tr>
                <th>Product Name</th>
                <td><?php echo $this->_tpl_vars['subproduct']->getName(); ?>
</td>
        </tr>
        <tr>
                <th>Product Type</th>
                <td><?php if ($this->_tpl_vars['type']):  echo $this->_tpl_vars['type']->getName();  else: ?>None<?php endif; ?></td>
        </tr>
        <tr>
                <th>Product Code</th>
                <td><?php echo $this->_tpl_vars['subproduct']->getCode(); ?>
</td>
        </tr>
        <tr>
                <th>Product Price</th>
                <td>&pound;<?php echo $this->_tpl_vars['subproduct']->formattedPrice(); ?>
</td>
        </tr>
        <tr>
                <th>VAT Status</th>
                <td>
                <?php if ($this->_tpl_vars['subproduct']->getVatStatus() == $this->_tpl_vars['subproduct']->PRODUCT_IS_VAT_EXEMPT()): ?>
                This product is exempt from VAT
                <?php elseif ($this->_tpl_vars['subproduct']->getVatStatus() == $this->_tpl_vars['subproduct']->PRICE_IS_VAT_EXCLUSIVE()): ?>
                The price is exclusive of VAT
                <?php elseif ($this->_tpl_vars['subproduct']->getVatStatus() == $this->_tpl_vars['subproduct']->PRICE_IS_VAT_INCLUSIVE()): ?>
                The price is inclusive of VAT
                <?php else: ?>
                There is a problem in the database with this products VAT status flag
                <?php endif; ?>
                </td>
        </tr>
        <tr>
                <th>Description</th>
                <td><?php echo $this->_tpl_vars['subproduct']->getDescription(); ?>
</td>
        </tr>
</table>
</fieldset>

<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/subproduct_management/edit_subproduct.php?subproductid=<?php echo $this->_tpl_vars['subproduct']->getId(); ?>
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
/ecomstore/product_catalogue/subproduct_management/edit_global_subproduct_attributes.php?subproductid=<?php echo $this->_tpl_vars['subproduct']->getId(); ?>
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
/ecomstore/product_catalogue/subproduct_management/edit_subproduct_type_attributes.php?subproductid=<?php echo $this->_tpl_vars['subproduct']->getId(); ?>
">Edit</a>
</div>

