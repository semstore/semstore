{include file="breadcrumb.tpl"}


<h1 class="page_title">User Management</h1>

<fieldset class="tools">
<legend>Tools</legend>
<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/user_management/add_user.php"><img src="{$configuration->getParameter('cms_images_webpath')}/product_catagories_tn.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/user_management/add_user.php"><p>Add User</p><a/>
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
<legend>Users</legend>
{if $users}
<table>
<tr>
<th class="type_column_heading">User Name</th>
<th class="options_column_heading">Options</th>
</tr>
{foreach item="user" from=$users}
<tr>
<td class="type_column">{$user->getSurname()}, {$user->getFirstname()}</td>
<td class="options_column">
        <a href="{$configuration->getParameter('cms_root_webpath')}/user_management/manage_user.php?uid={$user->getId()}">View</a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/user_management/remove_user.php?uid={$user->getId()}">Remove</a>
</td>
</tr>
{/foreach}
</table>
{else}
<p>There are currently no users in the database.</p>
{/if}
</div>


