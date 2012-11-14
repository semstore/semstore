<p class="checkout_progress"><span class="complete">Confirm Basket</span> &gt; <span class="complete">Enter Delivery Details</span> &gt; <span class="complete">Enter Billing Details</span> &gt; <span class="current">Confirm Order</span> &gt; Payment </p>

<h3>Choose your Payment Method</h3>

<div class="form">

<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">
<div class="row">
<label>Payment method</label>
<div>
       <select name="paymentmethod" >
              <option value="paypal_websitepaymentspro">Paypal (PayFlow Pro)</option>
              <option value="paypal_websitepaymentsstandard">Website Payments Standard</option>
       </select>
</div>
</div>

<input name="action" value="choose_payment_method_submit" type="hidden" />
<input name="continue_button" value="Continue" type="image" src="{$configuration->getParameter('site_images_webpath')}/site/buttons/buttons_26.gif" />
<input name="cancel_button" value="Cancel" type="image" src="{$configuration->getParameter('site_images_webpath')}/site/buttons/cancel.png" />
</form>

</div>