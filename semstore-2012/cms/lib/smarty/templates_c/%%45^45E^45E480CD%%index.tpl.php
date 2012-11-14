<?php /* Smarty version 2.6.10, created on 2008-01-03 05:07:38
         compiled from index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h1 class="page_title">CMS Home</h1>

<fieldset class="tools">
<legend>Tools</legend>

<table class="option_buttons">
<tr>
<!--
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/epublisher/index.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/cms-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/epublisher/index.php"><p>Manage<br />SEM CMS&trade;</p></a>
</div>
</td>
-->
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/index.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/store-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/index.php"><p>Manage<br />SEM Store&trade;</p></a>
</div>
</td>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('site_root_webpath'); ?>
/" target="_blank"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/live-site-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('site_root_webpath'); ?>
/" target="_blank"><p>View Site</p></a>
</div>
</td>
</tr>
</table>

</fieldset>
