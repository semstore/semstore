<?php /* Smarty version 2.6.10, created on 2009-04-07 04:20:58
         compiled from modules/ecomstore/orders-and-payments/orders.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h1 class="page_title">Order Management</h1>



<fieldset class="tools">
<legend>Search</legend>
<form action="" method="get">
<p>
<label>Order Id</label>
<input type="text" name="orderId" value="<?php echo $this->_tpl_vars['searchValue']; ?>
" />
<input type="submit" value="Submit"/>
<input type="reset" value="Reset" />
</p>
</fieldset>

<div class="orders">
<fieldset>
<legend>Orders</legend>

<?php if ($this->_tpl_vars['searchPager']['totalPages'] > 1): ?>
<p class="showingxy">Showing <?php echo $this->_tpl_vars['searchPager']['hitsPerPage']; ?>
 results starting at <?php echo $this->_tpl_vars['searchPager']['criteria']['st']+1; ?>
 of <?php echo $this->_tpl_vars['searchPager']['totalHits']; ?>
</p>
<?php endif; ?>

<?php if ($this->_tpl_vars['orders']): ?>
<table width="100%" class="trhover">
<tr>
<th class="orderid">Order Id</th>
<th class="name">Name</th>
<th class="value">Value</th>
<th class="options">Options</th>
</tr>
<?php $_from = $this->_tpl_vars['orders']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['order']):
?>
<tr>
<td class="orderid"><?php echo $this->_tpl_vars['order']->getId(); ?>
</td>
<td class="name"><?php echo $this->_tpl_vars['order']->getAttributeValue('Billing Firstname'); ?>
 <?php echo $this->_tpl_vars['order']->getAttributeValue('Billing Surname'); ?>
</td>
<td class="value">&pound;<?php echo $this->_tpl_vars['order']->formattedTotal(); ?>
</td>
<td class="options">
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/orders-and-payments/manage-order.php?orderid=<?php echo $this->_tpl_vars['order']->getId(); ?>
">View</a>
        <a href="<?php echo $this->_tpl_vars['configuration']->getParameter('cms_root_webpath'); ?>
/ecomstore/orders-and-payments/remove-order.php?orderid=<?php echo $this->_tpl_vars['order']->getId(); ?>
">Remove</a></td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>

<?php if ($this->_tpl_vars['searchPager']['totalPages'] > 1): ?>
<p class="pager">Page
<?php $_from = $this->_tpl_vars['searchPager']['pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['pageNumber'] => $this->_tpl_vars['pagerPage']):
?>
<?php if ($this->_tpl_vars['pagerPage']['is_current']): ?>
<?php if (! $this->_tpl_vars['pagerPage']['is_last']): ?>
<?php echo $this->_tpl_vars['pageNumber']; ?>
&nbsp;|&nbsp;
<?php else: ?>
<?php echo $this->_tpl_vars['pageNumber']; ?>

<?php endif; ?>
<?php elseif (! $this->_tpl_vars['pagerPage']['is_last']): ?>
<a href="?<?php echo $this->_tpl_vars['pagerPage']['uri']; ?>
"><?php echo $this->_tpl_vars['pageNumber']; ?>
</a>&nbsp;|&nbsp;
<?php else: ?>
<a href="?<?php echo $this->_tpl_vars['pagerPage']['uri']; ?>
"><?php echo $this->_tpl_vars['pageNumber']; ?>
</a>
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
of <?php echo $this->_tpl_vars['searchPager']['totalPages']; ?>
</p>
<?php endif; ?>
<?php else: ?>
<p>There are currently no orders in the database.</p>
<?php endif; ?>
</div>

