<?php /* Smarty version 2.6.10, created on 2008-01-03 05:07:38
         compiled from _default/main.tpl */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en"><head>        <title><?php echo $this->_tpl_vars['title']; ?>
</title>        <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />        <meta http-equiv="Content-Style-Type" content="text/css" />        <?php $_from = $this->_tpl_vars['stylesheets']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['stylesheet']):
?>        <link rel="stylesheet" href="<?php echo $this->_tpl_vars['stylesheet']; ?>
" type="text/css" />        <?php endforeach; endif; unset($_from); ?>        <?php $_from = $this->_tpl_vars['scripts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['script']):
?>        <script type="text/javascript" src="<?php echo $this->_tpl_vars['script']; ?>
"></script>        <?php endforeach; endif; unset($_from); ?></head><body>        <div id="maincontainer">                <!-- Header Content :: Start -->        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['header']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>        <!-- Header Content :: Stop -->                <!-- Toolbar Content :: Start -->        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['toolbar']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>        <!-- Toolbar Content :: Stop -->                <table id="subcontainer" cellspacing="0" cellpadding="0">                <tr>                        <td id="left" valign="top">                        <!-- Left Bar Content :: Start -->                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['left']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>                        <!-- Left Bar Content :: Stop -->                        </td>                                                <td id="centre" valign="top">                        <!-- Main Content :: Start -->                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['centre']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>                        <!-- Main Content :: Stop -->                        </td>                </tr>        </table>        <!-- Footer Content :: Start -->        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['footer']), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>        <!-- Footer Content :: Stop -->                </div>        </body></html>