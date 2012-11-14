<?php /* Smarty version 2.6.10, created on 2009-04-07 04:21:44
         compiled from system/modules/install_module/start.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<h1 class="page_title">Install Module</h1>

<form action="<?php echo $this->_tpl_vars['imFormAction']; ?>
" method="<?php echo $this->_tpl_vars['imFormMethod']; ?>
" enctype="<?php echo $this->_tpl_vars['imFormEncoding']; ?>
">
<input name="action" value="<?php echo $this->_tpl_vars['formAction']; ?>
" type="hidden" />
<input name="module" type="file" />
<button name="button" value="Install" type="submit">Install</button>
</form>