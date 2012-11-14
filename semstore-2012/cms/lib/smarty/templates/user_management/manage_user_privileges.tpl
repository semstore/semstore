{include file="breadcrumb.tpl"}


<h1 class="page_title">Privileges for user <span>{$user->getFirstname()} {$user->getSurname()}<span></h1>


{if $capabilityGroups}
<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">
<input name="action" value="{$action}" type="hidden">
<input name="uid" value="{$user->getId()}" type="hidden">
{foreach item="capabilityGroupArray" from=$capabilityGroups}
{assign var="capabilityGroup" value=$capabilityGroupArray.obj}
<div class="product_details">
<fieldset>
<legend>{$capabilityGroup->getLabel()}</legend>
<table cellspacing="0">
        {foreach item="capabilityArray" from=$capabilityGroupArray.capabilities}
        {assign var="capability" value=$capabilityArray.obj}
        <tr>
                <th>{$capability->getLabel()}</th>
                <td><input name="PRIV_{$capability->getName()}" value="1" type="checkbox" {if $capabilityArray.checked}checked {/if}/></td>
        </tr>
        {/foreach}
</table>
</fieldset>
</div>
{/foreach}

<input name="button" value="Apply Changes" type="submit">
</form>
{/if}

