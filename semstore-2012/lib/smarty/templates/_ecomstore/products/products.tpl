<div id="middle">
<div class="breadcrumb">
        <a href="/">Home</a> &gt;
        {if $currentCategory}
        <a href="products.php" title="Products">Products</a> &gt;
        {foreach item="ancestorCategory" from=$ancestorCategories}
        <a href="products.php?categoryid={$ancestorCategory->getId()}" title="{$ancestorCategory->getName()}">{$ancestorCategory->getName()}</a> &gt;
        {/foreach}
        {if $currentCategory}
        {$currentCategory->getName()}
        {/if}
        {else}
        Products
        {/if}
</div>

<div class="page_title">
{if $currentCategory}
<h3>{$currentCategory->getName()}</h3>
{else}
<!--<h3>Latest Products</h3>-->
{/if}
        
{if $currentCategory}
<p>There are {$currentCategory->getProductCount()} product(s) in this category</p>
{else}
<!--<p>There are 888 product(s) in this category</p>-->
{/if}
</div>

{include file=$subtemplate}

</div>