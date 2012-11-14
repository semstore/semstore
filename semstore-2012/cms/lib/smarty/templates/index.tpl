{include file="breadcrumb.tpl"}


<h1 class="page_title">CMS Home</h1>

<fieldset class="tools">
<legend>Tools</legend>

<table class="option_buttons">
<tr>
<!--
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/epublisher/index.php"><img src="{$configuration->getParameter('cms_images_webpath')}/cms-icon.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/epublisher/index.php"><p>Manage<br />SEM CMS&trade;</p></a>
</div>
</td>
-->
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/index.php"><img src="{$configuration->getParameter('cms_images_webpath')}/store-icon.png" alt="" /></a>
        <a href="{$configuration->getParameter('cms_root_webpath')}/ecomstore/index.php"><p>Manage<br />SEM Store&trade;</p></a>
</div>
</td>
<td>
<div class="option_button">
        <a href="{$configuration->getParameter('site_root_webpath')}/" target="_blank"><img src="{$configuration->getParameter('cms_images_webpath')}/live-site-icon.png" alt="" /></a>
        <a href="{$configuration->getParameter('site_root_webpath')}/" target="_blank"><p>View Site</p></a>
</div>
</td>
</tr>
</table>

</fieldset>

