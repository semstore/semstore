<?php /* Smarty version 2.6.10, created on 2008-01-03 05:05:11
         compiled from _default/right.tpl */ ?>
<div id="rightside">
<h4>Your Basket</h4>
<?php if ($this->_tpl_vars['basket'] && $this->_tpl_vars['basket']->getNumberOfItems() > 0): ?>
<p><a href="basket.php">You currently have <?php echo $this->_tpl_vars['basket']->getNumberOfItems(); ?>
 item(s) in your basket at a cost of &pound;<?php echo $this->_tpl_vars['basket']->formattedTotal(); ?>
</a></p>
<?php else: ?>
<p>Your basket is empty!</p>
<?php endif; ?><p>&nbsp;</p>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "_features/searchbox.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<p class="specials">_default/right.tpl</p>
</div>