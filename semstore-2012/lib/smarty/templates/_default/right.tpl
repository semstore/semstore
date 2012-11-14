<div id="rightside">
<h4>Your Basket</h4>
{if $basket && $basket->getNumberOfItems() > 0}
<p><a href="basket.php">You currently have {$basket->getNumberOfItems()} item(s) in your basket at a cost of &pound;{$basket->formattedTotal()}</a></p>
{else}
<p>Your basket is empty!</p>
{/if}<p>&nbsp;</p>
{include file="_features/searchbox.tpl"}
<p class="specials">_default/right.tpl</p>
</div>
