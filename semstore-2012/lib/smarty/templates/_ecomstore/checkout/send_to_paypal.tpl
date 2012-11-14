<p class="checkout_progress"><span class="complete">Confirm Basket</span> &gt; <span class="complete">Enter Delivery Details</span> &gt; <span class="complete">Enter Billing Details</span> &gt; <span class="current">Confirm Order</span> &gt; Payment </p>

<p>Thank you for your order, you're now at the final stage of the ordering process.</p>
<p>To complete your order, please click the <b>Submit Order</b> button below to be re-directed
to our secure online payment agent <a href="http://www.paypal.com" target="_new"><b>paypal</b> (for more information click here)</a>.</p>

<br>


<form action="{$action}" method="POST" name="paypal_form">
        <input type="hidden" name="cmd" value="_cart" />
        <input type="hidden" name="upload" value="1" />
	<input type="hidden" name="notify_url" value="{$notify_url}"/>
	<input type="hidden" name="business" value="{$business_email}"/>
	
	<input type="hidden" name="item_name" value="{$item_name}" />
	
	<input type="hidden" name="invoice" value="{$invoice_id}" />
	
	{if $basketitems}
	      {assign var='count' value='0'}
	
              {foreach from=$basketitems item=basketitem}
	             {assign var='count' value=$count+1}
	             
        <input type="hidden" name="item_name_{$count}" value="{$basketitem->getProductName()}" />
       
        <input type="hidden" name="amount_{$count}" value="{$basketitem->formattedPriceExVat()}" />
        
        <input type="hidden" name="quantity_{$count}" value="{$basketitem->getQuantity()}" />
                     
              {/foreach}
	{/if}
	
	
       {assign var='count' value=$count+1}
	             
	
	<input type="hidden" name="item_name_{$count}" value="VAT" />
       
        <input type="hidden" name="amount_{$count}" value="{$taxamount/100}" />
        
        <input type="hidden" name="quantity_{$count}" value="1" />
        
	
	
       {assign var='count' value=$count+1}
	             
	<input type="hidden" name="item_name_{$count}" value="Carriage" />
       
        <input type="hidden" name="amount_{$count}" value="{$carriagecharge}" />
        
        <input type="hidden" name="quantity_{$count}" value="1" />
	
	<button class="large-button" type="submit" value="Submit to Paypal" name="button">Submit to Paypal</button>


	
	<input type="hidden" name="return" value="{$successUrl}" />
	<input type="hidden" name="cancel_return" value="{$cancelUrl}" />
	<input type="hidden" name="rm" value="2" />
	<input type="hidden" name="currency_code" value="GBP" />
        <input type="hidden" name="bn" value="SemSolutions_ShoppingCart_ST">
	
	<input type="hidden" name="cbt" value="Continue" />

</form>

<p>All prices include UK VAT where applicable.</p>

