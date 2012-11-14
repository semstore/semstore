{include file="breadcrumb.tpl"}


<h1 class="page_title">Product Type Management</h1>

<fieldset class="tools">
<legend>Tools</legend>
<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_type_management/add_product_type.php"><img src="{$configuration->getParameter('cms_images_webpath')}/add-product-type-icon.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_type_management/add_product_type.php"><p>Add Product Type</p><a/>
</div>
</td>
<td></td>
<td></td>
<td></td>
</tr>
</table>
</fieldset>




<div class="product_types">
<fieldset>
<legend>Product Types</legend>


{if $types}
<table width="100%" class="trhover">
<tr>
<th ><strong>Type Name</strong></th>
<th width="150" align="center" ><strong>Options</strong></th>
</tr>
{foreach item="type" from=$types}
<tr>
<td >{$type->getName()}</td>
<td align="center" >
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_type_management/manage_product_type.php?typeid={$type->getId()}">View</a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_type_management/remove_product_type.php?typeid={$type->getId()}">Remove</a></td>
</tr>
{/foreach}
</table>
{else}
<p>There are currently no product attributes in the database.</p>
{/if}
</div>

</fieldset>
</div>
