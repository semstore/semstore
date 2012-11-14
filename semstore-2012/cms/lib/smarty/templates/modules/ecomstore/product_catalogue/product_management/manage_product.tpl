{include file="breadcrumb.tpl"}


<h1 class="page_title">Profile for product <span>{$product->getName()}<span></h1>


<fieldset class="tools">
<legend>Tools</legend>
<br />
{if $product->onSale()}
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/remove_product_from_sale.php?productid={$product->getId()}">Remove Product from Sale</a>
{else}
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/place_product_on_sale.php?productid={$product->getId()}">Place Product on Sale</a>
{/if}
<br /><br />
<a href="manage_product_image_gallery.php?productid={$product->getId()}">Manage Product Image Gallery</a>
<br /><br />
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/manage_product_images.php?productid={$product->getId()}">Manage Product Images</a>
<br /><br />
{if $product->isSpecialOffer()}
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/remove_product_special_offer.php?productid={$product->getId()}">Remove Product from Special Offers</a>
{else}
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/make_product_special_offer.php?productid={$product->getId()}">Make Product a Special Offer</a>
{/if}
<br /><br />
{if $product->isFeaturedProduct()}
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/remove_from_featured_products.php?productid={$product->getId()}">Remove from Featured Products</a>
{else}
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/add_to_featured_products.php?productid={$product->getId()}">Add to Featured Products</a>
{/if}
<br /><br />
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/subproduct_management/add_subproduct.php?productid={$product->getId()}">Add Subproduct</a>
<br /><br />
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/add_suggested_product.php?productid={$product->getId()}">Add Suggested Product</a>
<br /><br />
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/add_product_file.php?productid={$product->getId()}">Add Product File</a>
<br /><br />
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/copy_product.php?productid={$product->getId()}">Copy Product</a>
</fieldset>


<div class="product_details">
<fieldset>
<legend>Product Details</legend>
<table cellspacing="0">
        <tr>
                <th>Product Name</th>
                <td>{$product->getName()}</td>
        </tr>
        <tr>
                <th>Product Type</th>
                <td>{if $type}{$type->getName()}{else}None{/if}</td>
        </tr>
        <tr>
                <th>Product Code</th>
                <td>{$product->getCode()}</td>
        </tr>
        <tr>
                <th>Product Price</th>
                <td>&pound;{$product->formattedPrice()}</td>
        </tr>
        <tr>
                <th>VAT Status</th>
                <td>
                {if $product->getVatStatus() == $product->PRODUCT_IS_VAT_EXEMPT()}
                This product is exempt from VAT
                {elseif $product->getVatStatus() == $product->PRICE_IS_VAT_EXCLUSIVE()}
                The price is exclusive of VAT
                {elseif $product->getVatStatus() == $product->PRICE_IS_VAT_INCLUSIVE()}
                The price is inclusive of VAT
                {else}
                There is a problem in the database with this products VAT status flag
                {/if}
                </td>
        </tr>
        <tr>
                <th>Description</th>
                <td>{$product->getDescription()}</td>
        </tr>
</table>
</fieldset>

<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/edit_product.php?productid={$product->getId()}">Edit</a>
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
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/edit_global_product_attributes.php?productid={$product->getId()}">Edit</a>
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
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/edit_product_type_attributes.php?productid={$product->getId()}">Edit</a>
</div>



<div class="product_details">
<fieldset>
<legend>Subproducts</legend>
{if $subproducts}
<table>
<tr>
<th class="type_column_heading">Subproduct Name</th>
<th class="options_column_heading">Options</th>
</tr>
{foreach item="subproduct" from=$subproducts}
<tr>
<td class="type_column">{$subproduct->getName()}</td>
<td class="options_column">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/subproduct_management/manage_subproduct.php?subproductid={$subproduct->getId()}">View</a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/subproduct_management/remove_subproduct.php?subproductid={$subproduct->getId()}">Remove</a>
</td>
</tr>
{/foreach}
</table>
{else}
<p>There are currently no products in the database.</p>
{/if}
</div>





<div class="product_details">
<fieldset>
<legend>Suggested Products</legend>
{if $suggestedProductLinks}
<table>
<tr>
<th class="type_column_heading">Suggested Product Name</th>
<th class="options_column_heading">Options</th>
</tr>
{foreach item="suggestedProductLink" from=$suggestedProductLinks}
{assign var="suggestedProduct" value=$suggestedProductLink->suggestedProduct()}
<tr>
<td class="type_column">{$suggestedProduct->getName()}</td>
<td class="options_column">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/remove_suggested_product.php?suggestedproductid={$suggestedProductLink->getId()}">Remove</a>
</td>
</tr>
{/foreach}
</table>
{else}
<p>There are currently no products in the database.</p>
{/if}
</div>






<div class="product_details">
<fieldset>
<legend>Product Files</legend>
{if $productFiles}
<table>
<tr>
<th class="type_column_heading">Human Friendly Identifier</th>
<th class="type_column_heading">Description</th>
<th class="options_column_heading">Options</th>
</tr>
{foreach item="productFile" from=$productFiles}
<tr>
<td class="type_column">{$productFile->getHFID()}</td>
<td class="type_column">{$productFile->getDescription()}</td>
<td class="options_column">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/remove_product_file.php?fileid={$productFile->getId()}">Remove</a>
</td>
</tr>
{/foreach}
</table>
{else}
<p>There are currently no files for this product in the database.</p>
{/if}

</div>
