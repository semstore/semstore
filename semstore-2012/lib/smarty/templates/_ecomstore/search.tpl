<div class="commerce">
<p class="searchtext">Your search for <i>{$search_terms}</i>{if $category} in category {$category->getName()}{/if} produced <b>{$productCount}</b> results.</p>

{if $products}
{foreach item="product" from=$products}
{include file="_ecomstore/products/productlisting.tpl"}
{/foreach}
{/if}

</div>

