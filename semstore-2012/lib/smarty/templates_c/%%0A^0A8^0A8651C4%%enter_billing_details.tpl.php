<?php /* Smarty version 2.6.10, created on 2009-02-17 08:37:54
         compiled from _ecomstore/checkout/enter_billing_details.tpl */ ?>
<p class="checkout_progress"><span class="complete">Confirm Basket</span> &gt; <span class="complete">Enter Delivery Details</span> &gt; <span class="current">Enter Billing Details</span> &gt; Confirm Order &gt; Payment </p>

<p class="instructions">Please enter your billing details in the fields provided below.  Once you have completed the form and checked that the details are correct please click "Continue".</p><p class="instructions">To return to your basket to make changes click "Cancel"</p>

<!--<h3>Delivery Details</h3>-->
<script type="text/javascript">
          <?php echo '
          
          function showhidebilling ( )
          {
          
               var detailsRef = document.getElementById("billingdetails");
               
               if ( detailsRef.style.display == "none" )
               {
                    detailsRef.style.display = "";
               }
               else
               {
                    detailsRef.style.display = "none";
               }
          }
          
          '; ?>

</script>

<form action="<?php echo $this->_tpl_vars['formAction']; ?>
" method="<?php echo $this->_tpl_vars['formMethod']; ?>
" enctype="<?php echo $this->_tpl_vars['formEncoding']; ?>
">

<div class="row">
<label>My billing details are the same as my delivery details</label>
<div>
<input id="billingusedeliverydetails" name="billingusedeliverydetails" value="on" type="checkbox" onclick="showhidebilling();" />
</div>
</div>

<div id="billingdetails">

<div class="form">


<div class="row">
<label>Firstname</label>
<div>
<input id="firstname" name="firstname" value="<?php echo $this->_tpl_vars['firstname']; ?>
" type="text" />
<?php if ($this->_tpl_vars['firstnameErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['firstnameErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>


<div class="row">
<label>Surname</label>
<div>
<input id="surname" name="surname" value="<?php echo $this->_tpl_vars['surname']; ?>
" type="text" />
<?php if ($this->_tpl_vars['surnameErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['surnameErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>


<div class="row">
<label>Address 1</label>
<div><input id="address1" name="address1" value="<?php echo $this->_tpl_vars['address1']; ?>
" type="text" /></div>
</div>


<div class="row">
<label>Address 2</label>
<div><input id="address2" name="address2" value="<?php echo $this->_tpl_vars['address2']; ?>
" type="text" /></div>
<div>
<?php if ($this->_tpl_vars['address2ErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['address2ErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>


<div class="row">
<label>City</label>
<div>
<input id="city" name="city" value="<?php echo $this->_tpl_vars['city']; ?>
" type="text" />
<?php if ($this->_tpl_vars['cityErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['cityErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>


<div class="row">
<label>County</label>
<div>
<input id="county" name="county" value="<?php echo $this->_tpl_vars['county']; ?>
" type="text" />
<?php if ($this->_tpl_vars['countyErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['countyErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>


<div class="row">
<label>Postcode</label>
<div>
<input id="postcode" name="postcode" value="<?php echo $this->_tpl_vars['postcode']; ?>
" type="text" />
<?php if ($this->_tpl_vars['postcodeErrorMessage']): ?>
<p class="errormessage"><?php echo $this->_tpl_vars['postcodeErrorMessage']; ?>
</p>
<?php endif; ?>
</div>
</div>

</div>
</div>



<?php if ($this->_tpl_vars['paymentmethod'] == 'paypal_websitepaymentspro'): ?>
     <h3> Credit card details</h3>
    
     <div class="row">
          <label>Type</label>
          
          <div>
               <select id="creditcardtype" name="creditcardtype" >
                    <option value="Visa" <?php if ($this->_tpl_vars['creditcardtype'] == 'Visa'): ?>selected<?php endif; ?>>Visa</option>
                    <option value="MasterCard" <?php if ($this->_tpl_vars['creditcardtype'] == 'MasterCard'): ?>selected<?php endif; ?>>MasterCard</option>
                    <option value="Discover" <?php if ($this->_tpl_vars['creditcardtype'] == 'Discover'): ?>selected<?php endif; ?>>Discover</option>
                    <option value="Amex" <?php if ($this->_tpl_vars['creditcardtype'] == 'Amex'): ?>selected<?php endif; ?>>American Express</option>
                    <option value="Switch" <?php if ($this->_tpl_vars['creditcardtype'] == 'Switch'): ?>selected<?php endif; ?>>Switch</option>
                    <option value="Solo" <?php if ($this->_tpl_vars['creditcardtype'] == 'Solo'): ?>selected<?php endif; ?>>Solo</option>
               </select>
          </div>
          
     </div>




     <div class="row">
          <label>Card Number</label>
          
          <div>
               <input type="text" id="creditcardnumber" name="creditcardnumber" value="<?php echo $this->_tpl_vars['creditcardnumber']; ?>
"  />
          </div>
          
          <?php if ($this->_tpl_vars['creditcardnumberErrorMessage']): ?>
               <p class="errormessage"><?php echo $this->_tpl_vars['creditcardnumberErrorMessage']; ?>
</p>
          <?php endif; ?>
          
     </div>
     
     
     <div class="row">
          <label>CVV2</label>
          
          <div>
               <input type="text" id="cvv2" name="cvv2"  value="<?php echo $this->_tpl_vars['cvv2']; ?>
" />
          </div>
          
          
          <?php if ($this->_tpl_vars['cvv2ErrorMessage']): ?>
               <p class="errormessage"><?php echo $this->_tpl_vars['cvv2ErrorMessage']; ?>
</p>
          <?php endif; ?>
     </div>
     
     
     
     <div class="row">
          <label>Issue Number</label>
          
          <div>
               <input type="text" id="issuenumber" name="issuenumber" value="<?php echo $this->_tpl_vars['issuenumber']; ?>
" />
          </div>
          
          <?php if ($this->_tpl_vars['issuenumberErrorMessage']): ?>
               <p class="errormessage"><?php echo $this->_tpl_vars['issuenumberErrorMessage']; ?>
</p>
          <?php endif; ?>
     </div>
     
     
     <div class="row">
          <label>Start Date</label>
          
          <div>
               <select id="startdatemonth" name="startdatemonth" >
                  <?php unset($this->_sections['month']);
$this->_sections['month']['name'] = 'month';
$this->_sections['month']['start'] = (int)1;
$this->_sections['month']['loop'] = is_array($_loop=13) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['month']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['month']['show'] = true;
$this->_sections['month']['max'] = $this->_sections['month']['loop'];
if ($this->_sections['month']['start'] < 0)
    $this->_sections['month']['start'] = max($this->_sections['month']['step'] > 0 ? 0 : -1, $this->_sections['month']['loop'] + $this->_sections['month']['start']);
else
    $this->_sections['month']['start'] = min($this->_sections['month']['start'], $this->_sections['month']['step'] > 0 ? $this->_sections['month']['loop'] : $this->_sections['month']['loop']-1);
if ($this->_sections['month']['show']) {
    $this->_sections['month']['total'] = min(ceil(($this->_sections['month']['step'] > 0 ? $this->_sections['month']['loop'] - $this->_sections['month']['start'] : $this->_sections['month']['start']+1)/abs($this->_sections['month']['step'])), $this->_sections['month']['max']);
    if ($this->_sections['month']['total'] == 0)
        $this->_sections['month']['show'] = false;
} else
    $this->_sections['month']['total'] = 0;
if ($this->_sections['month']['show']):

            for ($this->_sections['month']['index'] = $this->_sections['month']['start'], $this->_sections['month']['iteration'] = 1;
                 $this->_sections['month']['iteration'] <= $this->_sections['month']['total'];
                 $this->_sections['month']['index'] += $this->_sections['month']['step'], $this->_sections['month']['iteration']++):
$this->_sections['month']['rownum'] = $this->_sections['month']['iteration'];
$this->_sections['month']['index_prev'] = $this->_sections['month']['index'] - $this->_sections['month']['step'];
$this->_sections['month']['index_next'] = $this->_sections['month']['index'] + $this->_sections['month']['step'];
$this->_sections['month']['first']      = ($this->_sections['month']['iteration'] == 1);
$this->_sections['month']['last']       = ($this->_sections['month']['iteration'] == $this->_sections['month']['total']);
?>
                         <option value="<?php echo $this->_sections['month']['index']; ?>
" <?php if ($this->_sections['month']['index'] == $this->_tpl_vars['startdatemonth']): ?>selected<?php endif; ?> ><?php echo $this->_sections['month']['index']; ?>
</option>
                  <?php endfor; endif; ?>
               </select>
               
               
               <select id="startdateyear" name="startdateyear" >
                  <?php unset($this->_sections['year']);
$this->_sections['year']['name'] = 'year';
$this->_sections['year']['start'] = (int)$this->_tpl_vars['currentyear']-5;
$this->_sections['year']['loop'] = is_array($_loop=$this->_tpl_vars['currentyear']+1) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['year']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['year']['show'] = true;
$this->_sections['year']['max'] = $this->_sections['year']['loop'];
if ($this->_sections['year']['start'] < 0)
    $this->_sections['year']['start'] = max($this->_sections['year']['step'] > 0 ? 0 : -1, $this->_sections['year']['loop'] + $this->_sections['year']['start']);
else
    $this->_sections['year']['start'] = min($this->_sections['year']['start'], $this->_sections['year']['step'] > 0 ? $this->_sections['year']['loop'] : $this->_sections['year']['loop']-1);
if ($this->_sections['year']['show']) {
    $this->_sections['year']['total'] = min(ceil(($this->_sections['year']['step'] > 0 ? $this->_sections['year']['loop'] - $this->_sections['year']['start'] : $this->_sections['year']['start']+1)/abs($this->_sections['year']['step'])), $this->_sections['year']['max']);
    if ($this->_sections['year']['total'] == 0)
        $this->_sections['year']['show'] = false;
} else
    $this->_sections['year']['total'] = 0;
if ($this->_sections['year']['show']):

            for ($this->_sections['year']['index'] = $this->_sections['year']['start'], $this->_sections['year']['iteration'] = 1;
                 $this->_sections['year']['iteration'] <= $this->_sections['year']['total'];
                 $this->_sections['year']['index'] += $this->_sections['year']['step'], $this->_sections['year']['iteration']++):
$this->_sections['year']['rownum'] = $this->_sections['year']['iteration'];
$this->_sections['year']['index_prev'] = $this->_sections['year']['index'] - $this->_sections['year']['step'];
$this->_sections['year']['index_next'] = $this->_sections['year']['index'] + $this->_sections['year']['step'];
$this->_sections['year']['first']      = ($this->_sections['year']['iteration'] == 1);
$this->_sections['year']['last']       = ($this->_sections['year']['iteration'] == $this->_sections['year']['total']);
?>
                         <option value="<?php echo $this->_sections['year']['index']; ?>
" <?php if ($this->_sections['year']['index'] == $this->_tpl_vars['startdateyear']): ?>selected<?php endif; ?> ><?php echo $this->_sections['year']['index']; ?>
</option>
                  <?php endfor; endif; ?>
               </select>
          </div>
          
     </div>
     
     
     <div class="row">
          <label>Expiry Date</label>
          
          <div>
               <select id="expirydatemonth" name="expirydatemonth" >
                  <?php unset($this->_sections['month']);
$this->_sections['month']['name'] = 'month';
$this->_sections['month']['start'] = (int)1;
$this->_sections['month']['loop'] = is_array($_loop=13) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['month']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['month']['show'] = true;
$this->_sections['month']['max'] = $this->_sections['month']['loop'];
if ($this->_sections['month']['start'] < 0)
    $this->_sections['month']['start'] = max($this->_sections['month']['step'] > 0 ? 0 : -1, $this->_sections['month']['loop'] + $this->_sections['month']['start']);
else
    $this->_sections['month']['start'] = min($this->_sections['month']['start'], $this->_sections['month']['step'] > 0 ? $this->_sections['month']['loop'] : $this->_sections['month']['loop']-1);
if ($this->_sections['month']['show']) {
    $this->_sections['month']['total'] = min(ceil(($this->_sections['month']['step'] > 0 ? $this->_sections['month']['loop'] - $this->_sections['month']['start'] : $this->_sections['month']['start']+1)/abs($this->_sections['month']['step'])), $this->_sections['month']['max']);
    if ($this->_sections['month']['total'] == 0)
        $this->_sections['month']['show'] = false;
} else
    $this->_sections['month']['total'] = 0;
if ($this->_sections['month']['show']):

            for ($this->_sections['month']['index'] = $this->_sections['month']['start'], $this->_sections['month']['iteration'] = 1;
                 $this->_sections['month']['iteration'] <= $this->_sections['month']['total'];
                 $this->_sections['month']['index'] += $this->_sections['month']['step'], $this->_sections['month']['iteration']++):
$this->_sections['month']['rownum'] = $this->_sections['month']['iteration'];
$this->_sections['month']['index_prev'] = $this->_sections['month']['index'] - $this->_sections['month']['step'];
$this->_sections['month']['index_next'] = $this->_sections['month']['index'] + $this->_sections['month']['step'];
$this->_sections['month']['first']      = ($this->_sections['month']['iteration'] == 1);
$this->_sections['month']['last']       = ($this->_sections['month']['iteration'] == $this->_sections['month']['total']);
?>
                         <option value="<?php echo $this->_sections['month']['index']; ?>
" <?php if ($this->_sections['month']['index'] == $this->_tpl_vars['expirydatemonth']): ?>selected<?php endif; ?>  ><?php echo $this->_sections['month']['index']; ?>
</option>
                  <?php endfor; endif; ?>
               </select>
               
               <select id="expirydateyear" name="expirydateyear" >
                  <?php unset($this->_sections['year']);
$this->_sections['year']['name'] = 'year';
$this->_sections['year']['start'] = (int)$this->_tpl_vars['currentyear'];
$this->_sections['year']['loop'] = is_array($_loop=$this->_tpl_vars['currentyear']+11) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['year']['step'] = ((int)1) == 0 ? 1 : (int)1;
$this->_sections['year']['show'] = true;
$this->_sections['year']['max'] = $this->_sections['year']['loop'];
if ($this->_sections['year']['start'] < 0)
    $this->_sections['year']['start'] = max($this->_sections['year']['step'] > 0 ? 0 : -1, $this->_sections['year']['loop'] + $this->_sections['year']['start']);
else
    $this->_sections['year']['start'] = min($this->_sections['year']['start'], $this->_sections['year']['step'] > 0 ? $this->_sections['year']['loop'] : $this->_sections['year']['loop']-1);
if ($this->_sections['year']['show']) {
    $this->_sections['year']['total'] = min(ceil(($this->_sections['year']['step'] > 0 ? $this->_sections['year']['loop'] - $this->_sections['year']['start'] : $this->_sections['year']['start']+1)/abs($this->_sections['year']['step'])), $this->_sections['year']['max']);
    if ($this->_sections['year']['total'] == 0)
        $this->_sections['year']['show'] = false;
} else
    $this->_sections['year']['total'] = 0;
if ($this->_sections['year']['show']):

            for ($this->_sections['year']['index'] = $this->_sections['year']['start'], $this->_sections['year']['iteration'] = 1;
                 $this->_sections['year']['iteration'] <= $this->_sections['year']['total'];
                 $this->_sections['year']['index'] += $this->_sections['year']['step'], $this->_sections['year']['iteration']++):
$this->_sections['year']['rownum'] = $this->_sections['year']['iteration'];
$this->_sections['year']['index_prev'] = $this->_sections['year']['index'] - $this->_sections['year']['step'];
$this->_sections['year']['index_next'] = $this->_sections['year']['index'] + $this->_sections['year']['step'];
$this->_sections['year']['first']      = ($this->_sections['year']['iteration'] == 1);
$this->_sections['year']['last']       = ($this->_sections['year']['iteration'] == $this->_sections['year']['total']);
?>
                         <option value="<?php echo $this->_sections['year']['index']; ?>
" <?php if ($this->_sections['year']['index'] == $this->_tpl_vars['expirydateyear']): ?>selected<?php endif; ?>  ><?php echo $this->_sections['year']['index']; ?>
</option>
                  <?php endfor; endif; ?>
               </select>
          </div>
          
     </div>
     

<?php endif; ?>

<div style="margin-top: 30px;">
<input name="action" value="enter_billing_details_submit" type="hidden" />
<input name="continue_button" value="Continue" type="image" src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_images_webpath'); ?>
/site/buttons/buttons_26.gif" />
<input name="cancel_button" value="Cancel" type="image" src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_images_webpath'); ?>
/site/buttons/cancel.png" />
</div>


</form>
</div>