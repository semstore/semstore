{include file="breadcrumb.tpl"}


<h1 class="page_title">General Product Features</h1>




<fieldset class="tools">
<legend>Tools</legend>
<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_global_attribute_management/add_global_product_attribute_group.php"><img src="{$configuration->getParameter('cms_images_webpath')}/add-feature-group-icon.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_global_attribute_management/add_global_product_attribute_group.php"><p>Add Feature Group</p><a/>
</div>
</td>
<td></td>
<td></td>
<td></td>
</tr>
</table>
</fieldset>




<div class="attribute_groups">
<fieldset>
<legend>General Product Feature Groups</legend>


{if $groups}
{foreach item="group" from=$groups}
<div class="attribute_group">
<h2>{$group->getName()}</h2>

{if $group->getAttributes()}
<table class="trhover">
<tr>
<th >Feature Name</th>
<th width="150" align="center" >Options</th>
</tr>
{foreach item="attribute" from=$group->getAttributes()}
<tr>
<td >{$attribute->getName()}</td>
<td width="150" align="center" >
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_global_attribute_management/edit_global_product_attribute.php?attributeid={$attribute->getId()}">Edit</a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_global_attribute_management/remove_global_product_attribute.php?attributeid={$attribute->getId()}">Remove</a></td>
</tr>
{/foreach}
</table>
{else}
<p>There are currently no features in the database for this group.<br /></p>
{/if}
<br />
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_global_attribute_management/add_global_product_attribute.php?groupid={$group->getId()}">Add Feature</a>
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_global_attribute_management/edit_global_product_attribute_group.php?groupid={$group->getId()}">Edit Group</a>
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_global_attribute_management/remove_global_product_attribute_group.php?groupid={$group->getId()}">Remove Group</a>
</div>
{/foreach}
{else}
<p>There are currently no general product features in the database.<br /></p>
{/if}


</fieldset>
</div>

