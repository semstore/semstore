{include file="breadcrumb.tpl"}

<h1 class="page_title">Product Images for <span>{$product->getName()}<span></h1>

<div class="browser_thumbnail">
<h2>Product Browser Thumbnail</h2>
{if $product_browser_thumbnail_image ne ''}
<img src="{$product_browser_thumbnail_image}" /><br />
{else}
<div class="browser_thumbnail_placeholder"></div>
{/if}
<a href="upload_browser_thumbnail_image.php?productid={$product->getId()}">Upload a new Image</a>
</div>

<div class="product_details_page_image">
<h2>Product Details Page Image</h2>
{if $product_details_page_image ne ''}
<img src="{$product_details_page_image}" /><br />
{else}
<div class="product_details_page_placeholder"></div>
{/if}
<a href="upload_product_details_page_image.php?productid={$product->getId()}">Upload a new Image</a>
</div>

<div class="basket_image">
<h2>Basket Image</h2>
{if $basket_image ne ''}
<img src="{$basket_image}" /><br />
{else}
<div class="basket_image_placeholder"></div>
{/if}
<a href="upload_basket_image.php?productid={$product->getId()}">Upload a new Image</a>
</div>

<div class="product_image">
<h2>Fullsize Product Image</h2>
{if $product_image ne ''}
<img src="{$product_image}" /><br />
{else}
<div class="product_image_placeholder"></div>
{/if}
<a href="upload_fullsize_product_image.php?productid={$product->getId()}">Upload a new Image</a>
</div>

