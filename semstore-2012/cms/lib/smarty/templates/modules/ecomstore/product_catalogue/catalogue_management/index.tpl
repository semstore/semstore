{include file="breadcrumb.tpl"}

<h1 class="page_title">Category Management</h1>

<fieldset class="tools">
<legend>Tools</legend>
<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/add_top_level_product_category.php"><img src="{$configuration->getParameter('cms_images_webpath')}/add-category-icon.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/add_top_level_product_category.php"><p>Add Top Level Category</p></a>
</div>
</td>
<td></td>
<td></td>
<td></td>
</tr>
</table>
</fieldset>


<div class="product_categories">
<fieldset>
<legend>Top Level Categories</legend>
{if $roots}
<table class="trhover">
<tr>
<th >Category Name</th>
<th width="150" align="center">Options</th>
</tr>
{foreach item="root" from=$roots}
<tr>
<td >{$root->getName()}</td>
<td align="center">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/manage_product_category.php?categoryid={$root->getId()}">View</a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/remove_top_level_product_category.php?categoryid={$root->getId()}">Remove</a>
</td>
</tr>
{/foreach}
</table>
{else}
<p>There are currently no top level categories in the database.</p>
{/if}
</fieldset>
</div>

