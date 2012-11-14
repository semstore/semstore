<?php /* Smarty version 2.6.10, created on 2008-01-03 05:05:53
         compiled from _ecomstore/products/products.tpl */ ?>
<div id="middle">
<div class="breadcrumb">
        <a href="/">Home</a> &gt;
        <?php if ($this->_tpl_vars['currentCategory']): ?>
        <a href="products.php" title="Products">Products</a> &gt;
        <?php $_from = $this->_tpl_vars['ancestorCategories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ancestorCategory']):
?>
        <a href="products.php?categoryid=<?php echo $this->_tpl_vars['ancestorCategory']->getId(); ?>
" title="<?php echo $this->_tpl_vars['ancestorCategory']->getName(); ?>
"><?php echo $this->_tpl_vars['ancestorCategory']->getName(); ?>
</a> &gt;
        <?php endforeach; endif; unset($_from); ?>
        <?php if ($this->_tpl_vars['currentCategory']): ?>
        <?php echo $this->_tpl_vars['currentCategory']->getName(); ?>

        <?php endif; ?>
        <?php else: ?>
        Products
        <?php endif; ?>
</div>

<div class="page_title">
<?php if ($this->_tpl_vars['currentCategory']): ?>
<h3><?php echo $this->_tpl_vars['currentCategory']->getName(); ?>
</h3>
<?php else: ?>
<!--<h3>Latest Products</h3>-->
<?php endif; ?>
        
<?php if ($this->_tpl_vars['currentCategory']): ?>
<p>There are <?php echo $this->_tpl_vars['currentCategory']->getProductCount(); ?>
 product(s) in this category</p>
<?php else: ?>
<!--<p>There are 888 product(s) in this category</p>-->
<?php endif; ?>
</div>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['subtemplate'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

</div>