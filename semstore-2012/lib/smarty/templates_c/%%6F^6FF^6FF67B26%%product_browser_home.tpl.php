<?php /* Smarty version 2.6.10, created on 2008-01-03 05:05:53
         compiled from _ecomstore/products/product_browser_home.tpl */ ?>
<?php if ($this->_tpl_vars['categories']): ?>
<ul>
<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['category']):
?>
<li><a href="products.php?categoryid=<?php echo $this->_tpl_vars['category']->getId(); ?>
"><?php echo $this->_tpl_vars['category']->getName(); ?>
</a></li>
<?php endforeach; endif; unset($_from); ?>
</ul>
<?php endif; ?>
