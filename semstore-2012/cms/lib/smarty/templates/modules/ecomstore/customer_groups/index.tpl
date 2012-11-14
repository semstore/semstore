{include file="breadcrumb.tpl"}


<h1 class="page_title">Customer Group Management</h1>

<fieldset class="tools">
<legend>Tools</legend>
<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/customer_groups/add_customer_group.php"><img src="{$configuration->getParameter('cms_images_webpath')}/add-group-icon.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/customer_groups/add_customer_group.php"><p>Add Customer Group</p></a>
</div>
</td>
<td></td>
<td></td>
<td></td>
</tr>
</table>
</fieldset>



<div class="products">
<fieldset>
<legend>Customer Groups</legend>
{if $groups}
<table class="trhover">
<tr>
<th >Group Name</th>
<th width="150" align="center" >Options</th>
</tr>
{foreach item="group" from=$groups}
<tr>
<td >{$group->getName()}</td>
<td align="center" >
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/customer_groups/manage_customer_group.php?groupid={$group->getId()}">View</a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/customer_groups/remove_customer_group.php?groupid={$group->getId()}">Remove</a>
</td>
</tr>
{/foreach}
</table>
{else}
<p>There are currently no customer groups in the database.</p>
{/if}
</div>


