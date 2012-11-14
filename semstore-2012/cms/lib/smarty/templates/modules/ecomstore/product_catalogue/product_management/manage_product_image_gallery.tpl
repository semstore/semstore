{include file="breadcrumb.tpl"}

<h1 class="page_title">Product Image Gallery for <span>{$product->getName()}<span></h1>

<div class="thumbnails">

{foreach item="galleryItem" from=$galleryItems}
<div class="gallery_thumbnail">
<img src="{$Configuration->getParameter('site_root_webpath')}/images/products/{$galleryItem->getThumbnail()}" /><br />
<p>
<a href="remove_product_gallery_image.php?gallery={$galleryItem->getGalleryId()}">Delete Image</a>
</p>
</div>
{/foreach}



<a href="upload_product_gallery_image.php?productid={$product->getId()}">Upload a new Image</a>

</div>