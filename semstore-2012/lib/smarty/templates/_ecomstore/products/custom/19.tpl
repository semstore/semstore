<div class="breadcrumb">
        <a href="/">Home</a> &gt;
        <a href="products.php" title="Products">Products</a> &gt;
        {foreach item="ancestorCategory" from=$ancestorCategories}
        <a href="products.php?categoryid={$ancestorCategory->getId()}" title="{$ancestorCategory->getName()}">{$ancestorCategory->getName()}</a> &gt;
        {/foreach}
        {if $currentCategory}
        {$currentCategory->getName()}
        {/if}
</div>

<div class="product">
<h2>{$product->getName()}</h2>

{if $product->getProductDetailsPageImage() != ''}
<img src="{$configuration->getParameter('webapp_product_images_webpath')}/{$product->getProductDetailsPageImage()}" alt="{$product->getName()}" title="{$product->getName()}" />
{else}
<img class="product_image" src="{$configuration->getParameter('webapp_default_product_image')}" alt="{$product->getName()}" title="{$product->getName()}" />
{/if}

<div class="pricing1">
<p class="priceExVAT">&pound;{$product->formattedPriceExVat()} ex. VAT</p>
<p class="priceIncVAT">&pound;{$product->formattedPriceIncVat()} inc. VAT</p>
<a href="{$siteRootWebpath}/basket.php?action=add&amp;productid={$product->getId()}"><img src="{$siteRootWebpath}/images/site/buttons/buttons_07.gif" alt="Add Item to Basket" title="Add Item to Basket" /></a>
</div>

<p class="description">
<span class="boldtext">Description</span><br />
{$product->getDescription()}
</p>

{if $attributeGroups}
<div class="features">

{foreach item="attributeGroup" from=$attributeGroups}
<div class="feature_group">
<h4>{$attributeGroup->getName()}</h4>
<table>
        {if $attributeGroup->getAttributes()}
        <tr>
                <th class="feature_heading">Feature</th>
                <th class="feature_value_heading">Value</th>
        </tr>
        {foreach item="attribute" from=$attributeGroup->getAttributes()}
        <tr>
                <td class="feature">{$attribute->getName()}</td>
                <td class="feature_value">{$attribute->getValue()}</td>
        </tr>
        {/foreach}
        {/if}
</table>
</div>
{/foreach}

</div>
{/if}

<div class="pricing2">
<p class="priceExVAT">&pound;{$product->formattedPriceExVat()} ex. VAT</p>
<p class="priceIncVAT">&pound;{$product->formattedPriceIncVat()} inc. VAT</p>
<a href="{$siteRootWebpath}/basket.php?action=add&amp;productid={$product->getId()}"><img src="{$siteRootWebpath}/images/site/buttons/buttons_07.gif" alt="Add Item to Basket" title="Add Item to Basket" /></a>
</div>

</div>
