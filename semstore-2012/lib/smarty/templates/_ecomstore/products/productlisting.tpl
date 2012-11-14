
<div class="middle">

<a href="{$siteRootWebpath}/productinfo.php?productid={$product->getId()}" title="{$product->getName()}">
{if $product->getThumbnail() != ''}
<img src="{$configuration->getParameter('webapp_product_images_webpath')}/{$product->getThumbnail()}" alt="{$product->getName()}" title="{$product->getName()}" />
{else}
<img src="{$configuration->getParameter('webapp_default_product_thumbnail_image')}" alt="{$product->getName()}" title="{$product->getName()}" />
{/if}
</a>

<h2><a href="{$siteRootWebpath}/productinfo.php?productid={$product->getId()}" title="{$product->getName()}">{$product->getName()}</a></h2>
<p class="priceExVat">&pound;{$product->formattedPriceExVat()} ex. VAT</p><p class="priceIncVat">&pound;{$product->formattedPriceIncVat()} inc. VAT</p>
<p class="proddescription">
{if $product->getDescription()|count_characters:true gt 200}
{$product->getDescription()|truncate:200} <a href="{$siteRootWebpath}/productinfo.php?productid={$product->getId()}">Show More</a>
{else}
{$product->getDescription()}
{/if}
<p>
</div>

<div class="listingcontrols">
<a href="{$siteRootWebpath}/basket.php?action=add&amp;productid={$product->getId()}"><img src="{$siteRootWebpath}/images/site/buttons/buttons_07.gif" alt="Add Item to Basket" title="Add Item to Basket" /></a>
<a href="{$siteRootWebpath}/productinfo.php?productid={$product->getId()}"><img src="{$siteRootWebpath}/images/site/buttons/buttons_03.gif" alt="{$product->getName()}" title="{$product->getName()}" /></a>
</div>

