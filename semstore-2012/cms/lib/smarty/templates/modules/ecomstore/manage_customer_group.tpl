{include file="breadcrumb.tpl"}


<h1 class="page_title">Manage Product Type: {$type->getName()}</h1>

<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/customer_groups/add_customer_group_attribute_group.php?groupid={$group->getId()}"><img src="{$configuration->getParameter('cms_images_webpath')}/product_catagories_tn.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/customer_groups/add_customer_group_attribute_group.php?gorupid={$group->getId()}"><p>Add Feature Group</p><a/>
</div>
</td>
<td></td>
<td></td>
<td></td>
</tr>
</table>




<div class="attribute_groups">
<fieldset>
<legend>Customer Group Feature Groups</legend>


{if $groups}
{foreach item="group" from=$groups}
<div class="attribute_group">
<h2>{$group->getName()}</h2>

{if $group->getAttributes()}
<table class="attributes">
<tr>
<th class="attribute_column_heading">Feature Name</th>
<th class="options_column_heading">Options</th>
</tr>
{foreach item="attribute" from=$group->getAttributes()}
<tr>
<td class="attribute_column">{$attribute->getName()}</td>
<td class="options_column">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/customer_groups/add_customer_group_attribute_group/edit_customer_group_attribute.php?attributeid={$attribute->getId()}">Edit</a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/customer_groups/add_customer_group_attribute_group/remove_customer_group_attribute.php?attributeid={$attribute->getId()}">Remove</a></td>
</tr>
{/foreach}
</table>
{else}
<p>There are currently no features in the database for this group.</p>
{/if}
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/customer_groups/add_customer_group_attribute_group/add_customer_group_attribute_group.php?groupid={$group->getId()}">Add Feature</a>
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/customer_groups/add_customer_group_attribute_group/edit_customer_group_attribute_group.php?groupid={$group->getId()}">Edit Group</a>
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/customer_groups/add_customer_group_attribute_group/remove_customer_group_attribute_group.php?groupid={$group->getId()}">Remove Group</a>
</div>
{/foreach}
{else}
<p>There are currently no product type feature groups in the database for this customer group.</p>
{/if}

</fieldset>
</div>
