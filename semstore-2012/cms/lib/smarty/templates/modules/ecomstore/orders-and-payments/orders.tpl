{include file="breadcrumb.tpl"}


<h1 class="page_title">Order Management</h1>



<fieldset class="tools">
<legend>Search</legend>
{*}
<p>
<b>Show</b>
<a href="javascript://" onclick="return false;">All</a>
&nbsp;|&nbsp;<a href="javascript://" onclick="return false;">Unpaid</a>
&nbsp;|&nbsp;<a href="javascript://" onclick="return false;">Awaiting Dispatch</a>
</p>
{/*}
<form action="" method="get">
<p>
<label>Order Id</label>
<input type="text" name="orderId" value="{$searchValue}" />
<input type="submit" value="Submit"/>
<input type="reset" value="Reset" />
</p>
</fieldset>

<div class="orders">
<fieldset>
<legend>Orders</legend>

{if $searchPager.totalPages > 1}
<p class="showingxy">Showing {$searchPager.hitsPerPage} results starting at {$searchPager.criteria.st+1} of {$searchPager.totalHits}</p>
{/if}

{if $orders}
<table width="100%" class="trhover">
<tr>
<th class="orderid">Order Id</th>
<th class="name">Name</th>
<th class="value">Value</th>
<th class="options">Options</th>
</tr>
{foreach item="order" from=$orders}
<tr>
<td class="orderid">{$order->getId()}</td>
<td class="name">{$order->getAttributeValue('Billing Firstname')} {$order->getAttributeValue('Billing Surname')}</td>
<td class="value">&pound;{$order->formattedTotal()}</td>
<td class="options">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/orders-and-payments/manage-order.php?orderid={$order->getId()}">View</a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/orders-and-payments/remove-order.php?orderid={$order->getId()}">Remove</a></td>
</tr>
{/foreach}
</table>

{if $searchPager.totalPages > 1}
<p class="pager">Page
{foreach key="pageNumber" item="pagerPage" from=$searchPager.pages}
{if $pagerPage.is_current}
{if !$pagerPage.is_last}
{$pageNumber}&nbsp;|&nbsp;
{else}
{$pageNumber}
{/if}
{elseif !$pagerPage.is_last}
<a href="?{$pagerPage.uri}">{$pageNumber}</a>&nbsp;|&nbsp;
{else}
<a href="?{$pagerPage.uri}">{$pageNumber}</a>
{/if}
{/foreach}
of {$searchPager.totalPages}</p>
{/if}
{else}
<p>There are currently no orders in the database.</p>
{/if}
</div>


