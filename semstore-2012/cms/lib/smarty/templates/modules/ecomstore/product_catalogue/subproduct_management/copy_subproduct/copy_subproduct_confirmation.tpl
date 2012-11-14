<div class="input_confirmation">
<p>Please confirm that the following details for the subproduct are correct.  If they are correct then click 'Submit Details'.  If they are incorrect then click 'Edit Details' to return to the previous page and edit the details.</p>

<table>
        <tr>
                <td class="cell1">Subproduct Name</td>
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
        <tr>
                <td class="cell1">Copy Attributes</td>
                <td class="cell2">{if $copyAttributes == 1}Yes{else}No{/if}</td>
        </tr>
</table>


{if $copyAttributes == 1}

<div class="product_details">
<fieldset>
<legend>Product Wide Feature Points and Features</legend>
{foreach item="globalGroup" from=$subproduct->getProductGlobalAttributeGroups()}
<h2>{$globalGroup->getName()}</h2>
{if $globalGroup->getAttributes()}
<table cellspacing="0">
        <tr>
                <th>Feature Name</th>
                <th>Feature Value</th>
        <tr>
        {foreach item="globalAttribute" from=$globalGroup->getAttributes()}
        <tr>
                <td>{$globalAttribute->getName()}</td>
                <td>{$globalAttribute->getValue()}</td>
        <tr>
        {/foreach}
</table>
{else}
<p>This group does not have any attributes in it.</p>
{/if}
{/foreach}
</fieldset>
</div>



<div class="product_details">
<fieldset>
<legend>Product Type Feature Points and Features</legend>
{foreach item="typeGroup" from=$subproduct->getProductTypeAttributeGroups()}
<h2>{$typeGroup->getName()}</h2>
{if $typeGroup->getAttributes()}
<table cellspacing="0">
        <tr>
                <th>Feature Name</th>
                <th>Feature Value</th>
        <tr>
        {foreach item="typeAttribute" from=$typeGroup->getAttributes()}
        <tr>
                <td>{$typeAttribute->getName()}</td>
                <td>{$typeAttribute->getValue()}</td>
        <tr>
        {/foreach}
</table>
{else}
<p>This group does not have any attributes in it.</p>
{/if}
{/foreach}
</fieldset>
</div>

{/if}




<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">

<input name="action" value="{$action}" type="hidden" />

<div class="input_controls">
<input name="button" value="Submit Details" type="submit" />
<input name="button" value="Edit Details" type="submit" />
<input name="button" value="Cancel" type="submit" />
</div>

</form>
</div>
