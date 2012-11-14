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

<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">
<input name="action" value="confirm_basket_submit" type="hidden" />
<input name="continue_button" value="Continue" type="image" src="{$configuration->getParameter('site_images_webpath')}/site/buttons/buttons_26.gif" />
<input name="cancel_button" value="Cancel" type="image" src="{$configuration->getParameter('site_images_webpath')}/site/buttons/cancel.png" />
</form>

