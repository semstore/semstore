<div class="input_confirmation">
<p>Please confirm that the following details for the product are correct.  If they are correct then click 'Submit Details'.  If they are incorrect then click 'Edit Details' to return to the previous page and edit the details.</p>

<table>
        <tr>
                <td class="cell1">Product Name</td>
                <td class="cell2">{$name}</td>
        </tr>
        <tr>
                <td class="cell1">Type</td>
                <td class="cell2">{$typename}</td>
        </tr>
        <tr>
                <td class="cell1">Code</td>
                <td class="cell2">{$code}</td>
        </tr>
        <tr>
                <td class="cell1">Price</td>
                <td class="cell2">&pound;{$formattedPrice}</td>
        </tr>
        <tr>
                <td class="cell1">VAT Status</td>
                <td class="cell2">
                {if $vatStatus == $PRODUCT->PRODUCT_IS_VAT_EXEMPT()}
                This product is exempt from VAT
                {elseif $vatStatus == $PRODUCT->PRICE_IS_VAT_EXCLUSIVE()}
                The price is exclusive of VAT
                {elseif $vatStatus == $PRODUCT->PRICE_IS_VAT_INCLUSIVE()}
                The price is inclusive of VAT
                {/if}
                </td>
        </tr>
        <tr>
                <td class="cell1">Description</td>
                <td class="cell2">{$description}</td>
        </tr>
</table>

<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">

<input name="action" value="{$action}" type="hidden" />

<div class="input_controls">
<input name="button" value="Submit Details" type="submit" />
<input name="button" value="Edit Details" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>
