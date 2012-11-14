{include file="breadcrumb.tpl"}


<h1 class="page_title">Profile for subproduct <span>{$subproduct->getName()}<span></h1>


<fieldset class="tools">
<legend>Tools</legend>
<br />
{if $subproduct->onSale()}
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/subproduct_management/remove_subproduct_from_sale.php?subproductid={$subproduct->getId()}">Remove Subproduct from Sale</a>
{else}
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/subproduct_management/place_subproduct_on_sale.php?subproductid={$subproduct->getId()}">Place Subproduct on Sale</a>
{/if}
<br /><br />
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/subproduct_management/manage_subproduct_images.php?subproductid={$subproduct->getId()}">Manage Subproduct Images</a>
<br /><br />
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/subproduct_management/copy_subproduct.php?subproductid={$subproduct->getId()}">Copy Subproduct</a>
</fieldset>


<div class="product_details">
<fieldset>
<legend>Product Details</legend>
<table cellspacing="0">
        <tr>
                <th>Product Name</th>
                <td>{$subproduct->getName()}</td>
        </tr>
        <tr>
                <th>Product Type</th>
                <td>{if $type}{$type->getName()}{else}None{/if}</td>
        </tr>
        <tr>
                <th>Product Code</th>
                <td>{$subproduct->getCode()}</td>
        </tr>
        <tr>
                <th>Product Price</th>
                <td>&pound;{$subproduct->formattedPrice()}</td>
        </tr>
        <tr>
                <th>VAT Status</th>
                <td>
                {if $subproduct->getVatStatus() == $subproduct->PRODUCT_IS_VAT_EXEMPT()}
                This product is exempt from VAT
                {elseif $subproduct->getVatStatus() == $subproduct->PRICE_IS_VAT_EXCLUSIVE()}
                The price is exclusive of VAT
                {elseif $subproduct->getVatStatus() == $subproduct->PRICE_IS_VAT_INCLUSIVE()}
                The price is inclusive of VAT
                {else}
                There is a problem in the database with this products VAT status flag
                {/if}
                </td>
        </tr>
        <tr>
                <th>Description</th>
                <td>{$subproduct->getDescription()}</td>
        </tr>
</table>
</fieldset>

<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/subproduct_management/edit_subproduct.php?subproductid={$subproduct->getId()}">Edit</a>
</div>




<div class="product_details">
<fieldset>
<legend>Product Wide Feature Points and Features</legend>
{foreach item="globalGroup" from=$globalGroups}
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
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/subproduct_management/edit_global_subproduct_attributes.php?subproductid={$subproduct->getId()}">Edit</a>
</div>




<div class="product_details">
<fieldset>
<legend>Product Type Feature Points and Features</legend>
{foreach item="typeGroup" from=$typeGroups}
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
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/subproduct_management/edit_subproduct_type_attributes.php?subproductid={$subproduct->getId()}">Edit</a>
</div>


