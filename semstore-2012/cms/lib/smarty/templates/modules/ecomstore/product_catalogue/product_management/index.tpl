{include file="breadcrumb.tpl"}


<h1 class="page_title">Product Management</h1>



<fieldset class="tools">
<legend>Tools</legend>
<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/add_product.php"><img src="{$configuration->getParameter('cms_images_webpath')}/add-product-icon.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/add_product.php"><p>Add Product</p><a/>
</div>
</td>
<td></td>
<td></td>
<td></td>
</tr>
</table>
</fieldset>


<fieldset class="tools">
<legend>Search</legend>
<form action="" method="GET">
<p> Product Name <input type="text" name="productName" value="{$searchValue}" /> <input type="submit" value="Submit"/> <input type="reset" value="Reset" /></p>
</fieldset>

<div class="products">
<fieldset>
<legend>Products</legend>

{if $searchPager.totalPages > 1}
<p>Showing {$searchPager.hitsPerPage} results starting at {$searchPager.criteria.st+1} of {$searchPager.totalHits}</p>
{/if}

{if $products}
<table width="100%" class="trhover">
<tr>
<th align="center" >Product Name</th>
<th align="center" >Code</th>
<th align="center" >Price</th>
<th width="150" align="center" >Options</th>
</tr>
{foreach item="product" from=$products}
<tr>
<td >{$product->getName()}</td>
<td align="center" >{$product->getCode()}</td>
<td align="center" >&pound;{$product->formattedPrice()}</td>
<td width="150" align="center" >
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/manage_product.php?productid={$product->getId()}">View</a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/product_management/remove_product.php?productid={$product->getId()}">Remove</a></td>
</tr>
{/foreach}
</table>

{if $searchPager.totalPages > 1}
<p>Page
{foreach key="pageNumber" item="pagerPage" from=$searchPager.pages}
{if $pagerPage.is_current}
{if !$pagerPage.is_last}
{$pageNumber}&nbsp;|&nbsp;
{else}
{$pageNumber}
{/if}
{elseif !$pagerPage.is_last}
<a href="?{$pagerPage.uri}">{$pageNumber}</a>&nbsp;|&nbsp;
{else}
<a href="?{$pagerPage.uri}">{$pageNumber}</a>
{/if}
{/foreach}
of {$searchPager.totalPages}</p>
{/if}
{else}
<p>There are currently no products in the database.</p>
{/if}
</div>


