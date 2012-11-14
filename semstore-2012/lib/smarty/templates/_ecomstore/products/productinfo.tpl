<div id="middle">
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

<div class="pricing1">
<p class="priceExVAT">&pound;{$product->formattedPriceExVat()} ex. VAT</p>
<p class="priceIncVAT">&pound;{$product->formattedPriceIncVat()} inc. VAT</p>
<a href="{$siteRootWebpath}/basket.php?action=add&amp;productid={$product->getId()}"><img src="{$siteRootWebpath}/images/site/buttons/buttons_07.gif" alt="Add Item to Basket" title="Add Item to Basket" /></a>
</div>

{if $product->getProductDetailsPageImage() != ''}
<a href="{$configuration->getParameter('webapp_product_images_webpath')}/{$product->getFullsizeImage()}" target="_blank"><img class="product_image" src="{$configuration->getParameter('webapp_product_images_webpath')}/{$product->getProductDetailsPageImage()}" alt="{$product->getName()}" title="{$product->getName()}" /></a>
{else}
<img class="product_image" src="{$configuration->getParameter('webapp_default_product_image')}" alt="{$product->getName()}" title="{$product->getName()}" />
{/if}

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




<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
   <input type="hidden" name="cmd" value="_xclick">
   <input type="hidden" name="business" value="allsem_1213274970_biz@semsolutions.co.uk">
   <input type="hidden" name="item_name" value="{$product->getName()}">
   <input type="hidden" name="item_number" value="{$product->getId()}">
   <input type="hidden" name="amount" value="{$product->formattedPriceIncVat()}">
   <input type="hidden" name="no_shipping" value="2">
   <input type="hidden" name="no_note" value="1">
   <input type="hidden" name="currency_code" value="GBP">
   <input type="hidden" name="bn" value="SemSolutions_ShoppingCart_ST_UK">
   <input type="image" src="https://www.paypal.com/en_US/i/btn/x-click-but23.gif" 
   name="submit" alt="Make payments with payPal - it's fast, free and secure!">
   <img alt="" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>






<a href="{$siteRootWebpath}/basket.php?action=add&amp;productid={$product->getId()}"><img src="{$siteRootWebpath}/images/site/buttons/buttons_07.gif" alt="Add Item to Basket" title="Add Item to Basket" /></a>
</div>

</div>


{if $subproducts}
<div class="subproducts">
<ul>
{foreach item="subproduct" from=$subproducts}
<li><a href="{$configuration->getParameter('site_root_webpath')}/products.php?subproductid={$subproduct->getId()}">{$subproduct->getName()}</a></li>
{/foreach}
</ul>
</div>
{/if}
</div>
