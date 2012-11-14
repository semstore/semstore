<?php /* Smarty version 2.6.10, created on 2009-02-17 08:45:08
         compiled from _ecomstore/checkout/choose_payment_method.tpl */ ?>
<p class="checkout_progress"><span class="complete">Confirm Basket</span> &gt; <span class="complete">Enter Delivery Details</span> &gt; <span class="complete">Enter Billing Details</span> &gt; <span class="current">Confirm Order</span> &gt; Payment </p>

<h3>Choose your Payment Method</h3>

<div class="form">

<form action="<?php echo $this->_tpl_vars['formAction']; ?>
" method="<?php echo $this->_tpl_vars['formMethod']; ?>
" enctype="<?php echo $this->_tpl_vars['formEncoding']; ?>
">
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
<input name="continue_button" value="Continue" type="image" src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_images_webpath'); ?>
/site/buttons/buttons_26.gif" />
<input name="cancel_button" value="Cancel" type="image" src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_images_webpath'); ?>
/site/buttons/cancel.png" />
</form>

</div>