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
{foreach item="basketItem" from=$basketItems}
<tr>
<td id="product">
        {if $displayProductImages eq TRUE}<img src="{$product_images_webpath}/{$basketItem.product->getProductBasketImage()}" />{/if}
        <p>{$basketItem.product->getName()}{if $displayProductCodes eq TRUE}<br/ ><span>Code: {$basketItem.product->getCode()}</span>{/if}</p>
</td>
<td id="quantity">{$basketItem.qty}</td>
<td id="price">&pound;{$basketItem.item->formattedPriceExVat()}</td>
<td id="price">&pound;{$basketItem.item->formattedPriceIncVat()}</td>
<td id="linetotal">&pound;{$basketItem.item->formattedLineTotalExVat()}</td>
</tr>
{/foreach}
</table>

<table class="basket_totals">
        <tr>
                <th class="basket_subtotal_label">Subtotal</th>
                <td class="basket_subtotal_cell">&pound;{$basket->formattedSubtotalExVat()}</td>
        </tr>
        <tr>
                <th class="basket_pandp_label">Carriage</th>
                <td class="basket_pandp_cell">&pound;{$basket->formattedCarriageChargeExVat()}</td>
        </tr>
        <tr>
                <th class="basket_vat_label">VAT</th>
                <td class="basket_vat_cell">&pound;{$basket->formattedVat()}</td>
        </tr>
        <tr>
                <th class="basket_total_label">Total</th>
                <td class="basket_total_cell">&pound;{$basket->formattedTotal()}</td>
        </tr>
</table>

<h3>Delivery Address</h3>

<div class="form" />

<div class="row">
<label>Firstname</label>
<div>
{$delivery_firstname}
</div>
</div>

<div class="row">
<label>Surname</label>
<div>
{$delivery_surname}
</div>
</div>

<div class="row">
<label>Address</label>
<div>{$delivery_address1}</div>
<div>{$delivery_address2}</div>
</div>

<div class="row">
<label>City</label>
<div>
{$delivery_city}
</div>
</div>

<div class="row">
<label>County</label>
<div>
{$delivery_county}
</div>
</div>

<div class="row">
<label>Postcode</label>
<div>
{$delivery_postcode}
</div>
</div>

<div class="row">
<label>Email Address</label>
<div>
{$delivery_email}
</div>
</div>

<div class="row">
<label>Contact Number</label>
<div>
{$delivery_contactNumber}
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
{$billing_firstname}
</div>
</div>

<div class="row">
<label>Surname</label>
<div>
{$billing_surname}
</div>
</div>

<div class="row">
<label>Address</label>
<div>{$billing_address1}</div>
<div>{$billing_address2}</div>
</div>

<div class="row">
<label>City</label>
<div>
{$billing_city}
</div>
</div>

<div class="row">
<label>County</label>
<div>
{$billing_county}
</div>
</div>

<div class="row">
<label>Postcode</label>
<div>
{$billing_postcode}
</div>
</div>







{if !$fromPaypal && $payment_method != "paypal_websitepaymentsstandard"}


     <h3> Credit card details</h3>
    
     <div class="row">
          <label>Type</label>
          
          <div>
               {$creditcardtype}
          </div>
          
     </div>



     <div class="row">
          <label>Card Number</label>
          
          <div>
               {$creditcardnumber}
          </div>
     </div>
     
     
     <div class="row">
          <label>CVV2</label>
          
          <div>{$cvv2}</div>
     </div>
     
     
     
     <div class="row">
          <label>Issue Number</label>
          <div>{$issuenumber}</div>
     </div>
     
     
     <div class="row">
          <label>Start Date</label>
          
          <div>{$startdatemonth} {$startdateyear} </div>
          
         
     </div>
     
     
     <div class="row">
          <label>Expiry Date</label>
          
          <div>{$expirydatemonth} {$expirydateyear}</div>
          
     </div>
     

{/if}

{if $payment_method != "paypal_websitepaymentsstandard"}
<div>
     <h3>By clicking continue, the transaction will be authorized and your card will be charged.</h3>

</div>
{/if}


</div>


<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">

{if $fromPaypal}
<input name="action" value="confirm_all_details_submit_from_paypal" type="hidden" />
{else}
<input name="action" value="confirm_all_details_submit" type="hidden" />
{/if}
<input name="continue_button" value="Continue" type="image" src="{$configuration->getParameter('site_images_webpath')}/site/buttons/buttons_26.gif" />
<input name="cancel_button" value="Cancel" type="image" src="{$configuration->getParameter('site_images_webpath')}/site/buttons/cancel.png" />
</form>

</div>
