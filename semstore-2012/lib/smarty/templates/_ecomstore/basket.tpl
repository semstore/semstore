
{*}<div id="commerce">
<div class="breadcrumb"><a href="{$siteRootWebpath}/index.php">Home</a> &gt; View Basket</div>

<h3>Your Basket</h3>

{if count($basketItems) > 0}
<table class="basket">
<tr>
<th id="product">Product</th>
<th id="quantity">Qty</th>
{if $displayPriceExVat eq TRUE}
<th id="price">Price (ex. VAT)</th>
{/if}
{if $displayPriceIncVat eq TRUE}
<th id="price">Price (inc. VAT)</th>
{/if}
{if $displayPriceExVat eq TRUE && $displayPriceIncVat eq TRUE}
<th id="linetotal">Line Total (ex. VAT)</th>
<th id="linetotal">Line Total (inc. VAT)</th>
{else}
<th id="linetotal">Line Total</th>
{/if}
</tr>
{foreach item="basketItem" from=$basketItems}
<tr>
<td id="product">
        {if $displayProductImages eq TRUE}<img src="{$product_images_webpath}/{$basketItem.product->getProductBasketImage()}" />{/if}
        <p>{$basketItem.product->getName()}<br/ >{if $displayProductCodes eq TRUE}<span>Code: {$basketItem.product->getCode()}</span>{/if}</p>
</td>
<td id="quantity"><input class="qty" name="qty" value="{$basketItem.qty}" type="text" /></td>
<td id="price">&pound;{$basketItem.product->formattedPriceExVat()}</td>
<td id="linetotal">&pound;20.00</td>
</tr>
{/foreach}
</table>
{else}
<p>Your basket is currently empty!</p>
{/if}

</div>
{/*}

<div class="basket">

<div class="breadcrumb">
        <a href="{$configuration->getParameter('site_root_webpath')}/">Home</a> &gt;
        View Basket
</div>

<h3>Your Basket</h3>

<p class="bluebox">
Before proceeding to Checkout please check your Qty boxes.<br />
<br />
If you wish to make any changes, please do so now and click Update to refresh
your basket and re-calculate the relevant charges.
</p>


{if $continueShoppingLink}
<p class="continue_shopping"><a href="{$continueShoppingLink}">Click here to continue shopping</a></p>
{/if}

{if count($basketItems) > 0}
<form action="basket.php" method="post" enctype="application/x-www-form-urlencoded">
<table class="basket">
<tr>
<th id="product">Product</th>
<th id="quantity">Qty</th>
{if $displayPriceExVat eq TRUE}
<th id="price">Price (ex. VAT)</th>
{/if}
{if $displayPriceIncVat eq TRUE}
<th id="price">Price (inc. VAT)</th>
{/if}
{if $displayPriceExVat eq TRUE}
<th id="linetotal">Line Total (ex. VAT)</th>
{/if}
{if $displayPriceIncVat eq TRUE}
<th id="linetotal">Line Total (inc. VAT)</th>
{/if}
{foreach item="basketItem" from=$basketItems}
<tr>
<td id="product">
        <a class="removeControl" href="{$configuration->getParameter('site_root_webpath')}/basket.php?productid={$basketItem.product->getId()}&amp;action=remove"><img src="{$configuration->getParameter('site_images_webpath')}/site/buttons/buttons_19.gif" /></a>
        {if $displayProductImages eq TRUE}{if $basketItem.product->getProductBasketImage() != ''}<img class="basket_img" src="{$configuration->getParameter('product_images_webpath')}/{$basketItem.product->getProductBasketImage()}" />{else}<img class="basket_img" src="{$configuration->getParameter('default_product_image_basket')}" />{/if}{/if}
        <p>{$basketItem.product->getName()}<br/ >{if $displayProductCodes eq TRUE}<span>Code: {$basketItem.product->getCode()}</span>{/if}</p>
        
</td>
<td id="quantity"><input class="qty" name="qty{$basketItem.product->getId()}" value="{$basketItem.qty}" type="text" /></td>
{if $displayPriceExVat eq TRUE}
<td id="price">&pound;{$basketItem.item->formattedPriceExVat()}</td>
{/if}
{if $displayPriceIncVat eq TRUE}
<td id="price">&pound;{$basketItem.item->formattedPriceIncVat()}</td>
{/if}
{if $displayPriceExVat eq TRUE}
<td id="linetotal">&pound;{$basketItem.item->formattedLineTotalExVat()}</td>
{/if}
{if $displayPriceIncVat eq TRUE}
<td id="linetotal">&pound;{$basketItem.item->formattedLineTotalIncVat()}</td>
{/if}
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

<p>
<input name="action" value="updatebasket" type="image" src="{$configuration->getParameter('site_images_webpath')}/site/buttons/buttons_22.gif" />
<a href="basket.php?action=emptybasket"><img src="{$configuration->getParameter('site_images_webpath')}/site/buttons/empty.gif" /></a>
<a href="checkout.php"><img src="{$configuration->getParameter('site_images_webpath')}/site/buttons/buttons_24.gif" /></a>

       <a href="{$configuration->getParameter('site_root_webpath')}/checkout.php?view=paypalexpresscheckout">
       
       <img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" style="margin-right:7px;">
       
       
       </a>

</form>
</p>
{else}
<p>Your basket is currently empty!</p>
{/if}

</div>
