<p class="breadcrumb">
        {foreach item="crumb" from=$breadcrumb}
        <a href="{$crumb.url}">{$crumb.name}</a> &gt;
        {/foreach}
</p>

