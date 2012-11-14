<p class="checkout_progress"><span class="complete">Confirm Basket</span> &gt; <span class="complete">Enter Delivery Details</span> &gt; <span class="current">Enter Billing Details</span> &gt; Confirm Order &gt; Payment </p>

<p class="instructions">Please enter your billing details in the fields provided below.  Once you have completed the form and checked that the details are correct please click "Continue".</p><p class="instructions">To return to your basket to make changes click "Cancel"</p>

<!--<h3>Delivery Details</h3>-->
<script type="text/javascript">
          {literal}
          
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
          
          {/literal}
</script>

<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">

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
<input id="firstname" name="firstname" value="{$firstname}" type="text" />
{if $firstnameErrorMessage}
<p class="errormessage">{$firstnameErrorMessage}</p>
{/if}
</div>
</div>


<div class="row">
<label>Surname</label>
<div>
<input id="surname" name="surname" value="{$surname}" type="text" />
{if $surnameErrorMessage}
<p class="errormessage">{$surnameErrorMessage}</p>
{/if}
</div>
</div>


<div class="row">
<label>Address 1</label>
<div><input id="address1" name="address1" value="{$address1}" type="text" /></div>
</div>


<div class="row">
<label>Address 2</label>
<div><input id="address2" name="address2" value="{$address2}" type="text" /></div>
<div>
{if $address2ErrorMessage}
<p class="errormessage">{$address2ErrorMessage}</p>
{/if}
</div>
</div>


<div class="row">
<label>City</label>
<div>
<input id="city" name="city" value="{$city}" type="text" />
{if $cityErrorMessage}
<p class="errormessage">{$cityErrorMessage}</p>
{/if}
</div>
</div>


<div class="row">
<label>County</label>
<div>
<input id="county" name="county" value="{$county}" type="text" />
{if $countyErrorMessage}
<p class="errormessage">{$countyErrorMessage}</p>
{/if}
</div>
</div>


<div class="row">
<label>Postcode</label>
<div>
<input id="postcode" name="postcode" value="{$postcode}" type="text" />
{if $postcodeErrorMessage}
<p class="errormessage">{$postcodeErrorMessage}</p>
{/if}
</div>
</div>

</div>
</div>



{if $paymentmethod == 'paypal_websitepaymentspro'}
     <h3> Credit card details</h3>
    
     <div class="row">
          <label>Type</label>
          
          <div>
               <select id="creditcardtype" name="creditcardtype" >
                    <option value="Visa" {if $creditcardtype=='Visa'}selected{/if}>Visa</option>
                    <option value="MasterCard" {if $creditcardtype=='MasterCard'}selected{/if}>MasterCard</option>
                    <option value="Discover" {if $creditcardtype=='Discover'}selected{/if}>Discover</option>
                    <option value="Amex" {if $creditcardtype=='Amex'}selected{/if}>American Express</option>
                    <option value="Switch" {if $creditcardtype=='Switch'}selected{/if}>Switch</option>
                    <option value="Solo" {if $creditcardtype=='Solo'}selected{/if}>Solo</option>
               </select>
          </div>
          
     </div>




     <div class="row">
          <label>Card Number</label>
          
          <div>
               <input type="text" id="creditcardnumber" name="creditcardnumber" value="{$creditcardnumber}"  />
          </div>
          
          {if $creditcardnumberErrorMessage}
               <p class="errormessage">{$creditcardnumberErrorMessage}</p>
          {/if}
          
     </div>
     
     
     <div class="row">
          <label>CVV2</label>
          
          <div>
               <input type="text" id="cvv2" name="cvv2"  value="{$cvv2}" />
          </div>
          
          
          {if $cvv2ErrorMessage}
               <p class="errormessage">{$cvv2ErrorMessage}</p>
          {/if}
     </div>
     
     
     
     <div class="row">
          <label>Issue Number</label>
          
          <div>
               <input type="text" id="issuenumber" name="issuenumber" value="{$issuenumber}" />
          </div>
          
          {if $issuenumberErrorMessage}
               <p class="errormessage">{$issuenumberErrorMessage}</p>
          {/if}
     </div>
     
     
     <div class="row">
          <label>Start Date</label>
          
          <div>
               <select id="startdatemonth" name="startdatemonth" >
                  {section name=month start=1 loop=13 step=1}
                         <option value="{$smarty.section.month.index}" {if $smarty.section.month.index == $startdatemonth}selected{/if} >{$smarty.section.month.index}</option>
                  {/section}
               </select>
               
               
               <select id="startdateyear" name="startdateyear" >
                  {section name=year start=$currentyear-5 loop=$currentyear+1 step=1}
                         <option value="{$smarty.section.year.index}" {if $smarty.section.year.index == $startdateyear}selected{/if} >{$smarty.section.year.index}</option>
                  {/section}
               </select>
          </div>
          
     </div>
     
     
     <div class="row">
          <label>Expiry Date</label>
          
          <div>
               <select id="expirydatemonth" name="expirydatemonth" >
                  {section name=month start=1 loop=13 step=1}
                         <option value="{$smarty.section.month.index}" {if $smarty.section.month.index == $expirydatemonth}selected{/if}  >{$smarty.section.month.index}</option>
                  {/section}
               </select>
               
               <select id="expirydateyear" name="expirydateyear" >
                  {section name=year start=$currentyear loop=$currentyear+11 step=1}
                         <option value="{$smarty.section.year.index}" {if $smarty.section.year.index == $expirydateyear}selected{/if}  >{$smarty.section.year.index}</option>
                  {/section}
               </select>
          </div>
          
     </div>
     

{/if}

<div style="margin-top: 30px;">
<input name="action" value="enter_billing_details_submit" type="hidden" />
<input name="continue_button" value="Continue" type="image" src="{$configuration->getParameter('site_images_webpath')}/site/buttons/buttons_26.gif" />
<input name="cancel_button" value="Cancel" type="image" src="{$configuration->getParameter('site_images_webpath')}/site/buttons/cancel.png" />
</div>


</form>
</div>
