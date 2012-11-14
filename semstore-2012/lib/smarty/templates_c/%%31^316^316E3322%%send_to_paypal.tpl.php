<?php /* Smarty version 2.6.10, created on 2009-02-18 08:52:08
         compiled from _ecomstore/checkout/send_to_paypal.tpl */ ?>
<p class="checkout_progress"><span class="complete">Confirm Basket</span> &gt; <span class="complete">Enter Delivery Details</span> &gt; <span class="complete">Enter Billing Details</span> &gt; <span class="current">Confirm Order</span> &gt; Payment </p>

<p>Thank you for your order, you're now at the final stage of the ordering process.</p>
<p>To complete your order, please click the <b>Submit Order</b> button below to be re-directed
to our secure online payment agent <a href="http://www.paypal.com" target="_new"><b>paypal</b> (for more information click here)</a>.</p>

<br>


<form action="<?php echo $this->_tpl_vars['action']; ?>
" method="POST" name="paypal_form">
        <input type="hidden" name="cmd" value="_cart" />
        <input type="hidden" name="upload" value="1" />
	<input type="hidden" name="notify_url" value="<?php echo $this->_tpl_vars['notify_url']; ?>
"/>
	<input type="hidden" name="business" value="<?php echo $this->_tpl_vars['business_email']; ?>
"/>
	
	<input type="hidden" name="item_name" value="<?php echo $this->_tpl_vars['item_name']; ?>
" />
	
	<input type="hidden" name="invoice" value="<?php echo $this->_tpl_vars['invoice_id']; ?>
" />
	
	<?php if ($this->_tpl_vars['basketitems']): ?>
	      <?php $this->assign('count', '0'); ?>
	
              <?php $_from = $this->_tpl_vars['basketitems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['basketitem']):
?>
	             <?php $this->assign('count', $this->_tpl_vars['count']+1); ?>
	             
        <input type="hidden" name="item_name_<?php echo $this->_tpl_vars['count']; ?>
" value="<?php echo $this->_tpl_vars['basketitem']->getProductName(); ?>
" />
       
        <input type="hidden" name="amount_<?php echo $this->_tpl_vars['count']; ?>
" value="<?php echo $this->_tpl_vars['basketitem']->formattedPriceExVat(); ?>
" />
        
        <input type="hidden" name="quantity_<?php echo $this->_tpl_vars['count']; ?>
" value="<?php echo $this->_tpl_vars['basketitem']->getQuantity(); ?>
" />
                     
              <?php endforeach; endif; unset($_from); ?>
	<?php endif; ?>
	
	
       <?php $this->assign('count', $this->_tpl_vars['count']+1); ?>
	             
	
	<input type="hidden" name="item_name_<?php echo $this->_tpl_vars['count']; ?>
" value="VAT" />
       
        <input type="hidden" name="amount_<?php echo $this->_tpl_vars['count']; ?>
" value="<?php echo $this->_tpl_vars['taxamount']/100; ?>
" />
        
        <input type="hidden" name="quantity_<?php echo $this->_tpl_vars['count']; ?>
" value="1" />
        
	
	
       <?php $this->assign('count', $this->_tpl_vars['count']+1); ?>
	             
	<input type="hidden" name="item_name_<?php echo $this->_tpl_vars['count']; ?>
" value="Carriage" />
       
        <input type="hidden" name="amount_<?php echo $this->_tpl_vars['count']; ?>
" value="<?php echo $this->_tpl_vars['carriagecharge']; ?>
" />
        
        <input type="hidden" name="quantity_<?php echo $this->_tpl_vars['count']; ?>
" value="1" />
	
	<button class="large-button" type="submit" value="Submit to Paypal" name="button">Submit to Paypal</button>


	
	<input type="hidden" name="return" value="<?php echo $this->_tpl_vars['successUrl']; ?>
" />
	<input type="hidden" name="cancel_return" value="<?php echo $this->_tpl_vars['cancelUrl']; ?>
" />
	<input type="hidden" name="rm" value="2" />
	<input type="hidden" name="currency_code" value="GBP" />
        <input type="hidden" name="bn" value="SemSolutions_ShoppingCart_ST">
	
	<input type="hidden" name="cbt" value="Continue" />

</form>

<p>All prices include UK VAT where applicable.</p>
