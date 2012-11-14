<p class="checkout_progress"><span class="complete">Confirm Basket</span> &gt; <span class="current">Enter Delivery Details</span> &gt; Enter Billing Details &gt; Confirm Order &gt; Payment </p>

<p class="instructions">Please enter your delivery details in the fields provided below.  Once you have completed the form and checked that the details are correct please click "Continue".</p><p class="instructions">To return to your basket to make changes click "Cancel"</p>

<!--<h3>Delivery Details</h3>-->


<div class="delivery_info">

{*}
{if $paymentmethod == 'paypal_websitepaymentspro' }
<div class="row">
       <a href="{$configuration->getParameter('site_root_webpath')}/checkout.php?view=paypalexpresscheckout">
       
       <img src="https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif" style="margin-right:7px;">
       
       
       </a>
</div>
{/if}
{/*}

{*}
</div>

<div class="form">
<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">

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
<div>
<input id="address1" name="address1" value="{$address1}" type="text" />
</div>
</div>


<div class="row">
<label>Address 2</label>
<div>
<input id="address2" name="address2" value="{$address2}" type="text" />
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

<div class="row">
<label>Email Address</label>
<div>
<input id="emailAddress" name="emailAddress" value="{$emailAddress}" type="text" />
{if $emailAddressErrorMessage}
<p class="errormessage">{$emailAddressErrorMessage}</p>
{/if}
</div>
</div>

<div class="row">
<label>Contact Number</label>
<div>
<input id="contactNumber" name="contactNumber" value="{$contactNumber}" type="text" />
{if $contactNumberErrorMessage}
<p class="errormessage">{$contactNumberErrorMessage}</p>
{/if}
</div>
</div>

{if $showDeliverySelector}
<div class="row">
<label>Delivery Date</label>
<div>
<select id="deliveryDate" name="deliveryDate" size="1">
{foreach item="deliveryDate" from=$deliveryDates}
        <option value="{$deliveryDate.selectorValue}"{if $deliveryDate.selectorValue == $selectedDeliveryDate} selected{/if}>{$deliveryDate.selectorText}</option>
{/foreach}
</select>
{if $deliveryDateErrorMessage}
<p class="errormessage">{$deliveryDateErrorMessage}</p>
{/if}
</div>
</div>
{/if}




<div class="row">
<label>Where did you hear about our site?</label>
<div>
<select name="heardofsite">

<option value="google" {if $selectedHeardOfProtec=="google"}selected{/if} >Google</option>
<option value="yahoo" {if $selectedHeardOfProtec=="yahoo"}selected{/if}>Yahoo</option>
<option value="directorylisting" {if $selectedHeardOfProtec=="directorylisting"}selected{/if}>Directory Listing</option>
<option value="mailout" {if $selectedHeardOfProtec=="mailout"}selected{/if}>Mail Out</option>
<option value="Ebay" {if $selectedHeardOfProtec=="Ebay"}selected{/if}>Ebay</option>
<option value="other" {if $selectedHeardOfProtec=="other"}selected{/if}>Other</option>

</select>
</div>
</div>


<input name="action" value="enter_delivery_details_submit" type="hidden" />
<input name="continue_button" value="Continue" type="image" src="{$configuration->getParameter('site_images_webpath')}/site/buttons/buttons_26.gif" />
<input name="cancel_button" value="Cancel" type="image" src="{$configuration->getParameter('site_images_webpath')}/site/buttons/cancel.png" />


</form>
</div>
