<?php /* Smarty version 2.6.10, created on 2009-02-17 08:49:22
         compiled from _ecomstore/checkout/confirm_all_details.tpl */ ?>
<p class="checkout_progress"><span class="complete">Confirm Basket</span> &gt; <span class="complete">Enter Delivery Details</span> &gt; <span class="complete">Enter Billing Details</span> &gt; <span class="current">Confirm Order</span> &gt; Payment </p>

<h3>Confirm Details</h3>

<div class="form">

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

<h3>Delivery Address</h3>

<div class="form" />

<div class="row">
<label>Firstname</label>
<div>
<?php echo $this->_tpl_vars['delivery_firstname']; ?>

</div>
</div>

<div class="row">
<label>Surname</label>
<div>
<?php echo $this->_tpl_vars['delivery_surname']; ?>

</div>
</div>

<div class="row">
<label>Address</label>
<div><?php echo $this->_tpl_vars['delivery_address1']; ?>
</div>
<div><?php echo $this->_tpl_vars['delivery_address2']; ?>
</div>
</div>

<div class="row">
<label>City</label>
<div>
<?php echo $this->_tpl_vars['delivery_city']; ?>

</div>
</div>

<div class="row">
<label>County</label>
<div>
<?php echo $this->_tpl_vars['delivery_county']; ?>

</div>
</div>

<div class="row">
<label>Postcode</label>
<div>
<?php echo $this->_tpl_vars['delivery_postcode']; ?>

</div>
</div>

<div class="row">
<label>Email Address</label>
<div>
<?php echo $this->_tpl_vars['delivery_email']; ?>

</div>
</div>

<div class="row">
<label>Contact Number</label>
<div>
<?php echo $this->_tpl_vars['delivery_contactNumber']; ?>

</div>
</div>



<div>



</div>
</div>

</div>



<h3>Billing Details</h3>

<div class="form" />

<div class="row">
<label>Firstname</label>
<div>
<?php echo $this->_tpl_vars['billing_firstname']; ?>

</div>
</div>

<div class="row">
<label>Surname</label>
<div>
<?php echo $this->_tpl_vars['billing_surname']; ?>

</div>
</div>

<div class="row">
<label>Address</label>
<div><?php echo $this->_tpl_vars['billing_address1']; ?>
</div>
<div><?php echo $this->_tpl_vars['billing_address2']; ?>
</div>
</div>

<div class="row">
<label>City</label>
<div>
<?php echo $this->_tpl_vars['billing_city']; ?>

</div>
</div>

<div class="row">
<label>County</label>
<div>
<?php echo $this->_tpl_vars['billing_county']; ?>

</div>
</div>

<div class="row">
<label>Postcode</label>
<div>
<?php echo $this->_tpl_vars['billing_postcode']; ?>

</div>
</div>







<?php if (! $this->_tpl_vars['fromPaypal'] && $this->_tpl_vars['payment_method'] != 'paypal_websitepaymentsstandard'): ?>


     <h3> Credit card details</h3>
    
     <div class="row">
          <label>Type</label>
          
          <div>
               <?php echo $this->_tpl_vars['creditcardtype']; ?>

          </div>
          
     </div>



     <div class="row">
          <label>Card Number</label>
          
          <div>
               <?php echo $this->_tpl_vars['creditcardnumber']; ?>

          </div>
     </div>
     
     
     <div class="row">
          <label>CVV2</label>
          
          <div><?php echo $this->_tpl_vars['cvv2']; ?>
</div>
     </div>
     
     
     
     <div class="row">
          <label>Issue Number</label>
          <div><?php echo $this->_tpl_vars['issuenumber']; ?>
</div>
     </div>
     
     
     <div class="row">
          <label>Start Date</label>
          
          <div><?php echo $this->_tpl_vars['startdatemonth']; ?>
 <?php echo $this->_tpl_vars['startdateyear']; ?>
 </div>
          
         
     </div>
     
     
     <div class="row">
          <label>Expiry Date</label>
          
          <div><?php echo $this->_tpl_vars['expirydatemonth']; ?>
 <?php echo $this->_tpl_vars['expirydateyear']; ?>
</div>
          
     </div>
     

<?php endif; ?>

<?php if ($this->_tpl_vars['payment_method'] != 'paypal_websitepaymentsstandard'): ?>
<div>
     <h3>By clicking continue, the transaction will be authorized and your card will be charged.</h3>

</div>
<?php endif; ?>


</div>


<form action="<?php echo $this->_tpl_vars['formAction']; ?>
" method="<?php echo $this->_tpl_vars['formMethod']; ?>
" enctype="<?php echo $this->_tpl_vars['formEncoding']; ?>
">

<?php if ($this->_tpl_vars['fromPaypal']): ?>
<input name="action" value="confirm_all_details_submit_from_paypal" type="hidden" />
<?php else: ?>
<input name="action" value="confirm_all_details_submit" type="hidden" />
<?php endif; ?>
<input name="continue_button" value="Continue" type="image" src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_images_webpath'); ?>
/site/buttons/buttons_26.gif" />
<input name="cancel_button" value="Cancel" type="image" src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_images_webpath'); ?>
/site/buttons/cancel.png" />
</form>

</div>