{if $categories}
<ul>
{foreach item="category" from=$categories}
<li><a href="products.php?categoryid={$category->getId()}">{$category->getName()}</a></li>
{/foreach}
</ul>
{/if}

