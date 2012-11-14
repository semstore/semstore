<?php /* Smarty version 2.6.10, created on 2008-01-03 05:07:38
         compiled from breadcrumb.tpl */ ?>
<p class="breadcrumb">
        <?php $_from = $this->_tpl_vars['breadcrumb']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['crumb']):
?>
        <a href="<?php echo $this->_tpl_vars['crumb']['url']; ?>
"><?php echo $this->_tpl_vars['crumb']['name']; ?>
</a> &gt;
        <?php endforeach; endif; unset($_from); ?>
</p>
