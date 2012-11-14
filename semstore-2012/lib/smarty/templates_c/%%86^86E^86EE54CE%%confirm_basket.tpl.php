<?php /* Smarty version 2.6.10, created on 2008-01-03 06:28:43
         compiled from _ecomstore/checkout/confirm_basket.tpl */ ?>
<p class="checkout_progress"><span class="current">Confirm Basket</span> &gt; Enter Delivery Details &gt; Enter Billing Details &gt; Confirm Order &gt; Payment </p>

<p class="instructions">Please check the contents of your basket carefully and confirm that they are correct.  Once you are ready to continue just click "Continue".</p><p class="instructions">To return to your basket to make changes click "Cancel"</p>

<table class="basket">
<tr>
<th id="product">Product</th>
<th id="quantity">Qty</th>
<th id="price">Price<br />(ex. VAT)</th>
<th id="price">Price<br />(inc. VAT)</th>
<th id="linetotal">Line Total (ex. VAT)</th>
</tr>
<?php $_from = $this->_tpl_vars['basketItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['basketItem']):
?>
<tr>
<td id="product">
        <?php if ($this->_tpl_vars['displayProductImages'] == TRUE): ?><img src="<?php echo $this->_tpl_vars['product_images_webpath']; ?>
/<?php echo $this->_tpl_vars['basketItem']['product']->getProductBasketImage(); ?>
" /><?php endif; ?>
        <p><?php echo $this->_tpl_vars['basketItem']['product']->getName();  if ($this->_tpl_vars['displayProductCodes'] == TRUE): ?><br/ ><span>Code: <?php echo $this->_tpl_vars['basketItem']['product']->getCode(); ?>
</span><?php endif; ?></p>
</td>
<td id="quantity"><?php echo $this->_tpl_vars['basketItem']['qty']; ?>
</td>
<td id="price">&pound;<?php echo $this->_tpl_vars['basketItem']['item']->formattedPriceExVat(); ?>
</td>
<td id="price">&pound;<?php echo $this->_tpl_vars['basketItem']['item']->formattedPriceIncVat(); ?>
</td>
<td id="linetotal">&pound;<?php echo $this->_tpl_vars['basketItem']['item']->formattedLineTotalExVat(); ?>
</td>
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

<form action="<?php echo $this->_tpl_vars['formAction']; ?>
" method="<?php echo $this->_tpl_vars['formMethod']; ?>
" enctype="<?php echo $this->_tpl_vars['formEncoding']; ?>
">
<input name="action" value="confirm_basket_submit" type="hidden" />
<input name="continue_button" value="Continue" type="image" src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_images_webpath'); ?>
/site/buttons/buttons_26.gif" />
<input name="cancel_button" value="Cancel" type="image" src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_images_webpath'); ?>
/site/buttons/cancel.png" />
</form>
