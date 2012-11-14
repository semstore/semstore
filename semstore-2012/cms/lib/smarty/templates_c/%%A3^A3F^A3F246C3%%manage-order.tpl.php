<?php /* Smarty version 2.6.10, created on 2009-04-20 00:51:55
         compiled from modules/ecomstore/orders-and-payments/manage-order.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>


<h1 class="page_title">Details for Order <span><?php echo $this->_tpl_vars['order']->getId(); ?>
<span></h1>

<fieldset class="tools">
<legend>Tools</legend>
</fieldset>

<div class="order-details">
<table cellspacing="0" cellpadding="0">
<tr><th>Order Type</th><td><?php echo $this->_tpl_vars['orderType']->getName(); ?>
</td></tr>
<tr><th>Date Placed</th><td><?php echo $this->_tpl_vars['order']->formattedDateTimePlaced(); ?>
</td></tr>
<tr><th>Total Value (inc. VAT)</th><td>&pound;<?php echo $this->_tpl_vars['order']->formattedTotal(); ?>
</td></tr>
</table>
</div>

<div class="order-lines">
<h3>Order Lines</h3>
<table cellspacing="0" cellpadding="0">
<tr>
<th class="productname">Product Name</th>
<th class="cost">Cost (inc. VAT)</th>
<th class="vat">VAT</th>
<th class="qty">Qty</th>
<th class="linetotal">Line Total (inc. VAT)</th>
</tr>
<?php $_from = $this->_tpl_vars['order']->orderLines(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['orderline']):
?>
<tr>
<td class="productname"><?php echo $this->_tpl_vars['orderline']->getProductName(); ?>
</td>
<td class="cost">&pound;<?php echo $this->_tpl_vars['orderline']->formattedPriceIncVat(); ?>
</td>
<td class="vat">&pound;<?php echo $this->_tpl_vars['orderline']->formattedVat(); ?>
</td>
<td class="qty"><?php echo $this->_tpl_vars['orderline']->getQuantity(); ?>
</td>
<td class="linetotal">&pound;<?php echo $this->_tpl_vars['orderline']->formattedLineTotalIncVat(); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>

<div class="order-attributes">
<h3>Order Attributes</h3>
<?php $_from = $this->_tpl_vars['order']->getAttributeGroups(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['orderAttributeGroup']):
?>
<div class="order-attribute-group">
<h3><?php echo $this->_tpl_vars['orderAttributeGroup']->getName(); ?>
</h3>
<table cellspacing="0" cellpadding="0">
<?php $_from = $this->_tpl_vars['orderAttributeGroup']->getAttributes(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['orderAttribute']):
?>
<tr>
<th><?php echo $this->_tpl_vars['orderAttribute']->getName(); ?>
</th><td><?php echo $this->_tpl_vars['orderAttribute']->getValue(); ?>
</td>
</tr>
<?php endforeach; endif; unset($_from); ?>
</table>
</div>

<?php endforeach; endif; unset($_from); ?>
</div>

</div>