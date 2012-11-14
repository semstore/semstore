{include file="breadcrumb.tpl"}

<h1 class="page_title">Product Images for <span>{$subproduct->getName()}<span></h1>

<div class="browser_thumbnail">
<h2>Product Browser Thumbnail</h2>
{if $product_browser_thumbnail_subproduct_image ne ''}
<img src="{$product_browser_thumbnail_subproduct_image}" /><br />
{else}
<div class="browser_thumbnail_placeholder"></div>
{/if}
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/subproduct_management/upload_browser_thumbnail_subproduct_image.php?subproductid={$subproduct->getId()}">Upload a new Image</a>
</div>

<div class="product_details_page_image">
<h2>Product Details Page Image</h2>
{if $product_details_page_subproduct_image ne ''}
<img src="{$product_details_page_subproduct_image}" /><br />
{else}
<div class="product_details_page_placeholder"></div>
{/if}
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/subproduct_management/upload_product_details_page_subproduct_image.php?subproductid={$subproduct->getId()}">Upload a new Image</a>
</div>

<div class="basket_image">
<h2>Basket Image</h2>
{if $basket_subproduct_image ne ''}
<img src="{$basket_subproduct_image}" /><br />
{else}
<div class="basket_image_placeholder"></div>
{/if}
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/subproduct_management/upload_basket_subproduct_image.php?subproductid={$subproduct->getId()}">Upload a new Image</a>
</div>

<div class="product_image">
<h2>Fullsize Product Image</h2>
{if $subproduct_image ne ''}
<img src="{$subproduct_image}" /><br />
{else}
<div class="product_image_placeholder"></div>
{/if}
<a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/product_catalogue/subproduct_management/upload_fullsize_subproduct_image.php?subproductid={$subproduct->getId()}">Upload a new Image</a>
</div>

