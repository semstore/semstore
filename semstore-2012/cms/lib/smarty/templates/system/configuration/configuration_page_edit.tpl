{include file="breadcrumb.tpl"}


<h1 class="page_title">{$configGroup->getName()}</h1>

{if $parameters}
<div class="form">
<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">
{foreach item="parameter" from=$parameters}
<div class="row">
<label>{$parameter->getName()}</label>
<div class="field">
<input id="{$parameter->getId()}" class="parameter" name="{$parameter->getId()}" value="{$parameter->getValue()}" type="text" />
</div>
</div>
{/foreach}
<input name="action" value="{$action}" type="hidden" />
<input name="id" value="{$configGroup->getId()}" type="hidden" />
<input name="button" value="Update" type="submit" />
<input name="button" value="Cancel" type="submit" />
</form>
</div>
{else}
<p></p>
{/if}


