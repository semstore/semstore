{include file="breadcrumb.tpl"}

<div class="configuration">
<h1 class="page_title">{$configGroup->getName()}</h1>

{if $parameters}
<table>
{foreach item="parameter" from=$parameters}
<tr>
<th>{$parameter->getName()}</th>
<td>{$parameter->getValue()}</td>
</tr>
{/foreach}
</table>
{else}
<p></p>
{/if}


<a href="{$configuration->getParameter('cms_root_webpath')}/system/configuration/configure.php?id={$configGroup->getId()}&amp;view=edit">Edit </a>
</div>
