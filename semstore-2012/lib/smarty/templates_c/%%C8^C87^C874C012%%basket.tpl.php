<?php /* Smarty version 2.6.10, created on 2008-10-10 09:56:30
         compiled from _ecomstore/basket.tpl */ ?>


<div class="basket">

<div class="breadcrumb">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('site_root_webpath'); ?>
/">Home</a> &gt;
        View Basket
</div>

<h3>Your Basket</h3>

<p class="bluebox">
Before proceeding to Checkout please check your Qty boxes.<br />
<br />
If you wish to make any changes, please do so now and click Update to refresh
your basket and re-calculate the relevant charges.
</p>


<?php if ($this->_tpl_vars['continueShoppingLink']): ?>
<p class="continue_shopping"><a href="<?php echo $this->_tpl_vars['continueShoppingLink']; ?>
">Click here to continue shopping</a></p>
<?php endif; ?>

<?php if (count ( $this->_tpl_vars['basketItems'] ) > 0): ?>
<form action="basket.php" method="post" enctype="application/x-www-form-urlencoded">
<table class="basket">
<tr>
<th id="product">Product</th>
<th id="quantity">Qty</th>
<?php if ($this->_tpl_vars['displayPriceExVat'] == TRUE): ?>
<th id="price">Price (ex. VAT)</th>
<?php endif; ?>
<?php if ($this->_tpl_vars['displayPriceIncVat'] == TRUE): ?>
<th id="price">Price (inc. VAT)</th>
<?php endif; ?>
<?php if ($this->_tpl_vars['displayPriceExVat'] == TRUE): ?>
<th id="linetotal">Line Total (ex. VAT)</th>
<?php endif; ?>
<?php if ($this->_tpl_vars['displayPriceIncVat'] == TRUE): ?>
<th id="linetotal">Line Total (inc. VAT)</th>
<?php endif; ?>
<?php $_from = $this->_tpl_vars['basketItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['basketItem']):
?>
<tr>
<td id="product">
        <a class="removeControl" href="<?php echo $this->_tpl_vars['configuration']->getParameter('site_root_webpath'); ?>
/basket.php?productid=<?php echo $this->_tpl_vars['basketItem']['product']->getId(); ?>
&amp;action=remove"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_images_webpath'); ?>
/site/buttons/buttons_19.gif" /></a>
        <?php if ($this->_tpl_vars['displayProductImages'] == TRUE):  if ($this->_tpl_vars['basketItem']['product']->getProductBasketImage() != ''): ?><img class="basket_img" src="<?php echo $this->_tpl_vars['configuration']->getParameter('product_images_webpath'); ?>
/<?php echo $this->_tpl_vars['basketItem']['product']->getProductBasketImage(); ?>
" /><?php else: ?><img class="basket_img" src="<?php echo $this->_tpl_vars['configuration']->getParameter('default_product_image_basket'); ?>
" /><?php endif;  endif; ?>
        <p><?php echo $this->_tpl_vars['basketItem']['product']->getName(); ?>
<br/ ><?php if ($this->_tpl_vars['displayProductCodes'] == TRUE): ?><span>Code: <?php echo $this->_tpl_vars['basketItem']['product']->getCode(); ?>
</span><?php endif; ?></p>
        
</td>
<td id="quantity"><input class="qty" name="qty<?php echo $this->_tpl_vars['basketItem']['product']->getId(); ?>
" value="<?php echo $this->_tpl_vars['basketItem']['qty']; ?>
" type="text" /></td>
<?php if ($this->_tpl_vars['displayPriceExVat'] == TRUE): ?>
<td id="price">&pound;<?php echo $this->_tpl_vars['basketItem']['item']->formattedPriceExVat(); ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['displayPriceIncVat'] == TRUE): ?>
<td id="price">&pound;<?php echo $this->_tpl_vars['basketItem']['item']->formattedPriceIncVat(); ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['displayPriceExVat'] == TRUE): ?>
<td id="linetotal">&pound;<?php echo $this->_tpl_vars['basketItem']['item']->formattedLineTotalExVat(); ?>
</td>
<?php endif; ?>
<?php if ($this->_tpl_vars['displayPriceIncVat'] == TRUE): ?>
<td id="linetotal">&pound;<?php echo $this->_tpl_vars['basketItem']['item']->formattedLineTotalIncVat(); ?>
</td>
<?php endif; ?>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>


<table class="basket_totals">
        <tr>
                <th class="basket_subtotal_label">Subtotal</th>
                <td class="basket_subtotal_cell">&pound;<?php echo $this->_tpl_vars['basket']->formattedSubtotalExVat(); ?>
</td>
        </tr>
        <tr>
                <th class="basket_pandp_label">Carriage</th>
                <td class="basket_pandp_cell">&pound;<?php echo $this->_tpl_vars['basket']->formattedCarriageChargeExVat(); ?>
</td>
        </tr>
        <tr>
                <th class="basket_vat_label">VAT</th>
                <td class="basket_vat_cell">&pound;<?php echo $this->_tpl_vars['basket']->formattedVat(); ?>
</td>
        </tr>
        <tr>
                <th class="basket_total_label">Total</th>
                <td class="basket_total_cell">&pound;<?php echo $this->_tpl_vars['basket']->formattedTotal(); ?>
</td>
        </tr>
</table>

<p>
<input name="action" value="updatebasket" type="image" src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_images_webpath'); ?>
/site/buttons/buttons_22.gif" />
<a href="basket.php?action=emptybasket"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_images_webpath'); ?>
/site/buttons/empty.gif" /></a>
<a href="checkout.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_images_webpath'); ?>
/site/buttons/buttons_24.gif" /></a>

       <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('site_root_webpath'); ?>
/checkout.php?view=paypalexpresscheckout">
       
       <img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" style="margin-right:7px;">
       
       
       </a>

</form>
</p>
<?php else: ?>
<p>Your basket is currently empty!</p>
<?php endif; ?>

</div>