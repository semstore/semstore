{include file="breadcrumb.tpl"}

<h1 class="page_title">Category: {$category->getName()}</h1>

<fieldset class="tools">
<legend>Tools</legend>
<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/edit_product_category.php?categoryid={$category->getId()}"><img src="{$configuration->getParameter('cms_images_webpath')}/edit-category-icon.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/edit_product_category.php?categoryid={$category->getId()}"><p>Edit Category</p></a>
</div>
</td>
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/upload_product_category_image.php?categoryid={$category->getId()}"><img src="{$configuration->getParameter('cms_images_webpath')}/upload-category-image.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/upload_product_category_image.php?categoryid={$category->getId()}"><p>Upload Category Image</p></a>
</div>
</td>
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/add_product_subcategory.php?categoryid={$category->getId()}"><img src="{$configuration->getParameter('cms_images_webpath')}/add-sub-category.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/add_product_subcategory.php?categoryid={$category->getId()}"><p>Add Subcategory</p></a>
</div>
</td>
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/add_product_to_category.php?categoryid={$category->getId()}"><img src="{$configuration->getParameter('cms_images_webpath')}/add-product-icon.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/add_product_to_category.php?categoryid={$category->getId()}"><p>Add Product</p></a>
</div>
</td>
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/manage_products_in_category.php?categoryid={$category->getId()}"><img src="{$configuration->getParameter('cms_images_webpath')}/add-product-icon.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/manage_products_in_category.php?categoryid={$category->getId()}"><p>Manage Products in Category</p></a>
</div>
</td>
</tr>
</table>
</fieldset>







<div class="category_details">
<fieldset>
<legend>Category Details</legend>
<br />
<table cellpadding="5" cellspacing="5">
        <tr>
                <th align="right" valign="top">Name</th>
                <td valign="top">{$category->getName()}</td>
        </tr>
        <tr>
                <th align="right" valign="top">Description</th>
                <td valign="top">{$category->getDescription()}</td>
        </tr>
        <tr>
                <th align="right" valign="top">Image</th>
                <td valign="top">{if $category->getImage() != ''}<img src="{$configuration->getParameter('product_category_images_webpath')}/{$category->getImage()}"/>{else}&lt; No Image Available &gt;
                {/if}</td>
        </tr>
</table>
<br />
</fieldset>
</div>





<div class="product_categories">
<fieldset>
<legend>Subcategories</legend>
{if $subcategories}
<table class="trhover">
<tr>
<th >Category Name</th>
<th width="150" align="center" >Options</th>
</tr>
{foreach item="subcategory" from=$subcategories}
<tr>
<td >{$subcategory->getName()}</td>
<td align="center" >
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/manage_product_category.php?categoryid={$subcategory->getId()}">View</a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/remove_product_subcategory.php?categoryid={$subcategory->getId()}">Remove</a></td>
</tr>
{/foreach}
</table>
{else}
<p>There are currently no subcategories in the database for this category.</p>
{/if}
</fieldset>
</div>





<div class="product_categories">
<fieldset>
<legend>Products</legend>
{if $products}
<table class="trhover">
<tr>
<th >Product Name</th>
<th width="150" align="center" >Options</th>
</tr>
{foreach item="product" from=$products}
<tr>
<td >{$product->getName()}</td>
<td align="center" >
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/catalogue_management/remove_product_from_category.php?productid={$product->getId()}&amp;categoryid={$category->getId()}">Remove</a></td>
</tr>
{/foreach}
</table>
{else}
<p>There are currently no products in the database added to this category.</p>
{/if}
</fieldset>
</div>


