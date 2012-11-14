<?php /* Smarty version 2.6.10, created on 2008-06-27 06:59:19
         compiled from _ecomstore/products/productinfo.tpl */ ?>
<div id="middle">
<div class="breadcrumb">
        <a href="/">Home</a> &gt;
        <a href="products.php" title="Products">Products</a> &gt;
        <?php $_from = $this->_tpl_vars['ancestorCategories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ancestorCategory']):
?>
        <a href="products.php?categoryid=<?php echo $this->_tpl_vars['ancestorCategory']->getId(); ?>
" title="<?php echo $this->_tpl_vars['ancestorCategory']->getName(); ?>
"><?php echo $this->_tpl_vars['ancestorCategory']->getName(); ?>
</a> &gt;
        <?php endforeach; endif; unset($_from); ?>
        <?php if ($this->_tpl_vars['currentCategory']): ?>
        <?php echo $this->_tpl_vars['currentCategory']->getName(); ?>

        <?php endif; ?>
</div>

<div class="product">
<h2><?php echo $this->_tpl_vars['product']->getName(); ?>
</h2>

<div class="pricing1">
<p class="priceExVAT">&pound;<?php echo $this->_tpl_vars['product']->formattedPriceExVat(); ?>
 ex. VAT</p>
<p class="priceIncVAT">&pound;<?php echo $this->_tpl_vars['product']->formattedPriceIncVat(); ?>
 inc. VAT</p>
<a href="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/basket.php?action=add&amp;productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
"><img src="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/images/site/buttons/buttons_07.gif" alt="Add Item to Basket" title="Add Item to Basket" /></a>
</div>

<?php if ($this->_tpl_vars['product']->getProductDetailsPageImage() != ''): ?>
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('webapp_product_images_webpath'); ?>
/<?php echo $this->_tpl_vars['product']->getFullsizeImage(); ?>
" target="_blank"><img class="product_image" src="<?php echo $this->_tpl_vars['configuration']->getParameter('webapp_product_images_webpath'); ?>
/<?php echo $this->_tpl_vars['product']->getProductDetailsPageImage(); ?>
" alt="<?php echo $this->_tpl_vars['product']->getName(); ?>
" title="<?php echo $this->_tpl_vars['product']->getName(); ?>
" /></a>
<?php else: ?>
<img class="product_image" src="<?php echo $this->_tpl_vars['configuration']->getParameter('webapp_default_product_image'); ?>
" alt="<?php echo $this->_tpl_vars['product']->getName(); ?>
" title="<?php echo $this->_tpl_vars['product']->getName(); ?>
" />
<?php endif; ?>

<p class="description">
<span class="boldtext">Description</span><br />
<?php echo $this->_tpl_vars['product']->getDescription(); ?>

</p>

<?php if ($this->_tpl_vars['attributeGroups']): ?>
<div class="features">

<?php $_from = $this->_tpl_vars['attributeGroups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attributeGroup']):
?>
<div class="feature_group">
<h4><?php echo $this->_tpl_vars['attributeGroup']->getName(); ?>
</h4>
<table>
        <?php if ($this->_tpl_vars['attributeGroup']->getAttributes()): ?>
        <tr>
                <th class="feature_heading">Feature</th>
                <th class="feature_value_heading">Value</th>
        </tr>
        <?php $_from = $this->_tpl_vars['attributeGroup']->getAttributes(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attribute']):
?>
        <tr>
                <td class="feature"><?php echo $this->_tpl_vars['attribute']->getName(); ?>
</td>
                <td class="feature_value"><?php echo $this->_tpl_vars['attribute']->getValue(); ?>
</td>
        </tr>
        <?php endforeach; endif; unset($_from); ?>
        <?php endif; ?>
</table>
</div>
<?php endforeach; endif; unset($_from); ?>

</div>
<?php endif; ?>





<div class="pricing2">



<p class="priceExVAT">&pound;<?php echo $this->_tpl_vars['product']->formattedPriceExVat(); ?>
 ex. VAT</p>
<p class="priceIncVAT">&pound;<?php echo $this->_tpl_vars['product']->formattedPriceIncVat(); ?>
 inc. VAT</p>




<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
   <input type="hidden" name="cmd" value="_xclick">
   <input type="hidden" name="business" value="allsem_1213274970_biz@semsolutions.co.uk">
   <input type="hidden" name="item_name" value="<?php echo $this->_tpl_vars['product']->getName(); ?>
">
   <input type="hidden" name="item_number" value="<?php echo $this->_tpl_vars['product']->getId(); ?>
">
   <input type="hidden" name="amount" value="<?php echo $this->_tpl_vars['product']->formattedPriceIncVat(); ?>
">
   <input type="hidden" name="no_shipping" value="2">
   <input type="hidden" name="no_note" value="1">
   <input type="hidden" name="currency_code" value="GBP">
   <input type="hidden" name="bn" value="SemSolutions_ShoppingCart_ST_UK">
   <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but23.gif" 
   name="submit" alt="Make payments with payPal - it's fast, free and secure!">
   <img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>






<a href="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/basket.php?action=add&amp;productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
"><img src="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/images/site/buttons/buttons_07.gif" alt="Add Item to Basket" title="Add Item to Basket" /></a>
</div>

</div>


<?php if ($this->_tpl_vars['subproducts']): ?>
<div class="subproducts">
<ul>
<?php $_from = $this->_tpl_vars['subproducts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['subproduct']):
?>
<li><a href="<?php echo $this->_tpl_vars['configuration']->getParameter('site_root_webpath'); ?>
/products.php?subproductid=<?php echo $this->_tpl_vars['subproduct']->getId(); ?>
"><?php echo $this->_tpl_vars['subproduct']->getName(); ?>
</a></li>
<?php endforeach; endif; unset($_from); ?>
</ul>
</div>
<?php endif; ?>
</div>