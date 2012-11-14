{include file="breadcrumb.tpl"}

<h1 class="page_title">Install Module</h1>

<form action="{$imFormAction}" method="{$imFormMethod}" enctype="{$imFormEncoding}">
<input name="action" value="{$formAction}" type="hidden" />
<input name="module" type="file" />
<button name="button" value="Install" type="submit">Install</button>
</form>
