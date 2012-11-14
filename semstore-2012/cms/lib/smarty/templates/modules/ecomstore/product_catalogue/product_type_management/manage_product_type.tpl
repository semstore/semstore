{include file="breadcrumb.tpl"}


<h1 class="page_title">Manage Product Type: {$type->getName()}</h1>

<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_type_management/add_product_type_product_attribute_group.php?typeid={$type->getId()}"><img src="{$configuration->getParameter('cms_images_webpath')}/add-feature-group-icon.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_type_management/add_product_type_product_attribute_group.php?typeid={$type->getId()}"><p>Add Feature Group</p><a/>
</div>
</td>
<td></td>
<td></td>
<td></td>
</tr>
</table>




<div class="attribute_groups">
<fieldset>
<legend>Product Type Feature Groups</legend>


{if $groups}
{foreach item="group" from=$groups}
<div class="attribute_group">
<h2>{$group->getName()}</h2>

{if $group->getAttributes()}
<table width="100%" class="trhover">
<tr>
<th ><strong>Feature Name</strong></th>
<th width="150" align="center" ><strong>Options</strong></th>
</tr>
{foreach item="attribute" from=$group->getAttributes()}
<tr>
<td >{$attribute->getName()}</td>
<td width="150" align="center" >
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_type_management/edit_product_type_attribute.php?attributeid={$attribute->getId()}">Edit</a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_type_management/remove_product_type_attribute.php?attributeid={$attribute->getId()}">Remove</a></td>
</tr>
{/foreach}
</table>
{else}
<p>There are currently no features in the database for this group.</p>
{/if}
<br />
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_type_management/add_product_type_product_attribute.php?groupid={$group->getId()}">Add Feature</a>
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_type_management/edit_product_type_attribute_group.php?groupid={$group->getId()}">Edit Group</a>
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_type_management/remove_product_type_attribute_group.php?groupid={$group->getId()}">Remove Group</a>
</div>
{/foreach}
{else}
<p>There are currently no product type feature groups in the database for this product type.</p>
{/if}

</fieldset>
</div>
