{include file="breadcrumb.tpl"}


<h1 class="page_title">Details for Order <span>{$order->getId()}<span></h1>

<fieldset class="tools">
<legend>Tools</legend>
</fieldset>

<div class="order-details">
<table cellspacing="0" cellpadding="0">
<tr><th>Order Type</th><td>{$orderType->getName()}</td></tr>
<tr><th>Date Placed</th><td>{$order->formattedDateTimePlaced()}</td></tr>
<tr><th>Total Value (inc. VAT)</th><td>&pound;{$order->formattedTotal()}</td></tr>
</table>
</div>

<div class="order-lines">
<h3>Order Lines</h3>
<table cellspacing="0" cellpadding="0">
<tr>
<th class="productname">Product Name</th>
<th class="cost">Cost (inc. VAT)</th>
<th class="vat">VAT</th>
<th class="qty">Qty</th>
<th class="linetotal">Line Total (inc. VAT)</th>
</tr>
{foreach item="orderline" from=$order->orderLines()}
<tr>
<td class="productname">{$orderline->getProductName()}</td>
<td class="cost">&pound;{$orderline->formattedPriceIncVat()}</td>
<td class="vat">&pound;{$orderline->formattedVat()}</td>
<td class="qty">{$orderline->getQuantity()}</td>
<td class="linetotal">&pound;{$orderline->formattedLineTotalIncVat()}</td>
</tr>
{/foreach}
</table>
</div>

<div class="order-attributes">
<h3>Order Attributes</h3>
{foreach item="orderAttributeGroup" from=$order->getAttributeGroups()}
<div class="order-attribute-group">
<h3>{$orderAttributeGroup->getName()}</h3>
<table cellspacing="0" cellpadding="0">
{foreach item="orderAttribute" from=$orderAttributeGroup->getAttributes()}
<tr>
<th>{$orderAttribute->getName()}</th><td>{$orderAttribute->getValue()}</td>
</tr>
{/foreach}
</table>
</div>

{/foreach}
</div>

</div>
