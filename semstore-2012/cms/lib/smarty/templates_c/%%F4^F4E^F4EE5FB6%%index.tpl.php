<?php /* Smarty version 2.6.10, created on 2009-04-07 04:20:07
         compiled from system/modules/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1 class="page_title">Configuration</h1>

<fieldset class="tools">
<legend>Tools</legend>

<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/system/modules/installmodule.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/epublisher_tn.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/system/modules/installmodule.php"><p>Install Module</p><a/>
</div>
</td>
</tr>
</table>

</fieldset>
