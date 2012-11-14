<?php /* Smarty version 2.6.10, created on 2008-01-03 05:08:09
         compiled from modules/ecomstore/product_catalogue/product_global_attribute_management/index.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h1 class="page_title">General Product Features</h1>




<fieldset class="tools">
<legend>Tools</legend>
<table class="option_buttons">
<tr>
<td>
<div class="option_button">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_global_attribute_management/add_global_product_attribute_group.php"><img src="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_images_webpath'); ?>
/add-feature-group-icon.png" alt="" /></a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_global_attribute_management/add_global_product_attribute_group.php"><p>Add Feature Group</p><a/>
</div>
</td>
<td></td>
<td></td>
<td></td>
</tr>
</table>
</fieldset>




<div class="attribute_groups">
<fieldset>
<legend>General Product Feature Groups</legend>


<?php if ($this->_tpl_vars['groups']): ?>
<?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['group']):
?>
<div class="attribute_group">
<h2><?php echo $this->_tpl_vars['group']->getName(); ?>
</h2>

<?php if ($this->_tpl_vars['group']->getAttributes()): ?>
<table class="trhover">
<tr>
<th >Feature Name</th>
<th width="150" align="center" >Options</th>
</tr>
<?php $_from = $this->_tpl_vars['group']->getAttributes(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attribute']):
?>
<tr>
<td ><?php echo $this->_tpl_vars['attribute']->getName(); ?>
</td>
<td width="150" align="center" >
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_global_attribute_management/edit_global_product_attribute.php?attributeid=<?php echo $this->_tpl_vars['attribute']->getId(); ?>
">Edit</a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_global_attribute_management/remove_global_product_attribute.php?attributeid=<?php echo $this->_tpl_vars['attribute']->getId(); ?>
">Remove</a></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
<?php else: ?>
<p>There are currently no features in the database for this group.<br /></p>
<?php endif; ?>
<br />
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_global_attribute_management/add_global_product_attribute.php?groupid=<?php echo $this->_tpl_vars['group']->getId(); ?>
">Add Feature</a>
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_global_attribute_management/edit_global_product_attribute_group.php?groupid=<?php echo $this->_tpl_vars['group']->getId(); ?>
">Edit Group</a>
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/product_catalogue/product_global_attribute_management/remove_global_product_attribute_group.php?groupid=<?php echo $this->_tpl_vars['group']->getId(); ?>
">Remove Group</a>
</div>
<?php endforeach; endif; unset($_from); ?>
<?php else: ?>
<p>There are currently no general product features in the database.<br /></p>
<?php endif; ?>


</fieldset>
</div>
