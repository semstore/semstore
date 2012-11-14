<?php /* Smarty version 2.6.10, created on 2008-01-03 06:07:51
         compiled from _ecomstore/products/productlisting.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count_characters', '_ecomstore/products/productlisting.tpl', 15, false),array('modifier', 'truncate', '_ecomstore/products/productlisting.tpl', 16, false),)), $this); ?>

<div class="middle">

<a href="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/productinfo.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
" title="<?php echo $this->_tpl_vars['product']->getName(); ?>
">
<?php if ($this->_tpl_vars['product']->getThumbnail() != ''): ?>
<img src="<?php echo $this->_tpl_vars['configuration']->getParameter('webapp_product_images_webpath'); ?>
/<?php echo $this->_tpl_vars['product']->getThumbnail(); ?>
" alt="<?php echo $this->_tpl_vars['product']->getName(); ?>
" title="<?php echo $this->_tpl_vars['product']->getName(); ?>
" />
<?php else: ?>
<img src="<?php echo $this->_tpl_vars['configuration']->getParameter('webapp_default_product_thumbnail_image'); ?>
" alt="<?php echo $this->_tpl_vars['product']->getName(); ?>
" title="<?php echo $this->_tpl_vars['product']->getName(); ?>
" />
<?php endif; ?>
</a>

<h2><a href="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/productinfo.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
" title="<?php echo $this->_tpl_vars['product']->getName(); ?>
"><?php echo $this->_tpl_vars['product']->getName(); ?>
</a></h2>
<p class="priceExVat">&pound;<?php echo $this->_tpl_vars['product']->formattedPriceExVat(); ?>
 ex. VAT</p><p class="priceIncVat">&pound;<?php echo $this->_tpl_vars['product']->formattedPriceIncVat(); ?>
 inc. VAT</p>
<p class="proddescription">
<?php if (((is_array($_tmp=$this->_tpl_vars['product']->getDescription())) ? $this->_run_mod_handler('count_characters', true, $_tmp, true) : smarty_modifier_count_characters($_tmp, true)) > 200): ?>
<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->getDescription())) ? $this->_run_mod_handler('truncate', true, $_tmp, 200) : smarty_modifier_truncate($_tmp, 200)); ?>
 <a href="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/productinfo.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
">Show More</a>
<?php else: ?>
<?php echo $this->_tpl_vars['product']->getDescription(); ?>

<?php endif; ?>
<p>
</div>

<div class="listingcontrols">
<a href="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/basket.php?action=add&amp;productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
"><img src="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/images/site/buttons/buttons_07.gif" alt="Add Item to Basket" title="Add Item to Basket" /></a>
<a href="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/productinfo.php?productid=<?php echo $this->_tpl_vars['product']->getId(); ?>
"><img src="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/images/site/buttons/buttons_03.gif" alt="<?php echo $this->_tpl_vars['product']->getName(); ?>
" title="<?php echo $this->_tpl_vars['product']->getName(); ?>
" /></a>
</div>
