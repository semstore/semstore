{if $catroot}
<ul id="categorylist">
{foreach item="category" from=$catroot->getSubcategories()}
        <li class="navigation_list_item">
                {if $category->getId() == $selectedCategoryId}
                <a href="{$siteRootWebpath}/products.php?categoryid={$category->getId()}" title="{$category->getName()}"><b>{$category->getName()}</b></a>
                <ul class="subnavigation_list">
                        {foreach item="type" from=$category->getProductTypes()}
                        <li class="navigation_list_item">
                                {if $type->getId() == $selectedTypeId}
                                <a href="{$siteRootWebpath}/products.php?typeid={$type->getId()}" title="{$type->getName()}"><b>{$type->getName()}</b></a>
                                <ul class="subnavigation_list">
                                        {foreach item="subtype" from=$type->getSubtypes()}
                                        <li class="navigation_list_item">
                                                {if $subtype->getId() == $selectedSubtypeId}
                                                <a href="{$siteRootWebpath}/products.php?subtypeid={$subtype->getId()}" title="{$subtype->getName()}"><b>{$subtype->getName()}</b></a>
                                                {else}
                                                <a href="{$siteRootWebpath}/products.php?subtypeid={$subtype->getId()}" title="{$subtype->getName()}">{$subtype->getName()}</a>
                                                {/if}
                                        </li>
                                        {/foreach}
                                </ul>
                                {else}
                                <a href="{$siteRootWebpath}/products.php?typeid={$type->getId()}" title="{$type->getName()}">{$type->getName()}</a>
                                {/if}
                        </li>
                        {/foreach}
                </ul>
                {else}
                <a href="{$siteRootWebpath}/products.php?categoryid={$category->getId()}" title="{$category->getName()}">{$category->getName()}</a>
                {/if}
        </li>
{/foreach}
<ul>
{/if}
