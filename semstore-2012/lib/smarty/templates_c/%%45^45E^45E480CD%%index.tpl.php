<?php /* Smarty version 2.6.10, created on 2008-01-03 05:05:11
         compiled from index.tpl */ ?>
<!-- Content for the Store Home Page -->

<div id="middle">
<div class="breadcrumb"> <a href="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/index.php">Home</a> |</div>
  <h1>This the title written with the help of heading1 </h1>

  <p>Pellentesque placerat. Morbi eu nibh et nisi <strong>accumsan</strong> interdum. Mauris  eu felis ut pede sagittis posuere. Aliquam dapibus. Sed tincidunt augue  sit amet nisi. Sed urna. Fusce ut sapien. Cum sociis natoque penatibus  et magnis dis parturient montes, nascetur ridiculus mus. Maecenas est  arcu, pulvinar sit amet, lacinia non, mattis nec, elit. Donec tellus  felis, elementum ac, consectetuer sed, fringilla quis, felis. Vivamus  at quam. Vestibulum placerat, quam id auctor dictum, lacus eros  adipiscing lorem, eleifend vulputate velit turpis eget nisl. Vestibulum  bibendum, dolor vel iaculis <strong>tincidunt</strong>, lorem enim mattis lacus, ac  interdum sem urna vitae tortor. </p>
  <ul>
    <li>proin commodo</li>
    <li> justo quis dapibus  lobortis</li>
    <li> sem orci blandit nisi</li>
    <li> eget venenatis purus </li>
    <li>dolor in ante</li>
    <li>donec tristique sagittis neque. </li>
  </ul>
  <p>Sed ornare ante nec libero. Suspendisse vitae nunc sollicitudin urna  cursus dictum. Ut sed erat. Cras sed turpis sit amet lacus sollicitudin  interdum. Sed aliquet. Donec aliquam interdum orci. Maecenas pede nisi,  tincidunt ac, tincidunt id, accumsan quis, nisi. Etiam vel felis sit  amet lacus condimentum interdum. Sed tellus. Quisque tortor odio,  luctus in, varius quis, euismod scelerisque, mi. Fusce condimentum  lacinia felis. Vestibulum tincidunt mi sit amet sem. Nulla vel lacus.  Pellentesque at metus. Praesent tincidunt enim id augue. Morbi nonummy  ante id justo. </p>
  <h2>This the title written with the help of heading2</h2>
  <p>Cras eget magna. Nullam malesuada aliquam lectus. Fusce varius pede  nec augue. In hac habitasse platea dictumst. Quisque a mi. Nulla  molestie velit eget lectus. In mollis, sapien et ullamcorper accumsan,  mi tellus lacinia arcu, eu congue ligula urna at nulla. Curabitur ut  velit. Integer tincidunt dapibus tortor. Nulla pulvinar nibh a eros.  Maecenas varius condimentum nisl. Ut auctor. Nunc blandit. Suspendisse  potenti. Nam justo quam, mattis ac, faucibus sed, malesuada et, mauris.  Donec at velit sed risus tristique convallis. Duis facilisis nunc vitae  arcu. Morbi et turpis. Duis ac dui vitae ipsum accumsan consequat.  Vestibulum laoreet turpis quis dolor. </p>
  <p class="specials">index.tpl</p>
<!-- Start Category Browser -->
<!-- Use the SEM Store CMS to manage your categories -->
<h3>Category Browser Heading 3 (from CMS)</h3>

<?php $_from = $this->_tpl_vars['typesArray']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['typeArray']):
?>
<div class="productsummary">
<div class="alignright">
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('site_root_webpath'); ?>
/category/<?php echo $this->_tpl_vars['typeArray']->getId(); ?>
">
<h2><?php echo $this->_tpl_vars['typeArray']->getName(); ?>
</h2>
<br />
<?php if ($this->_tpl_vars['typeArray']->getDescription()): ?>
<p><?php echo $this->_tpl_vars['typeArray']->getDescription(); ?>
</p>
<?php endif; ?>
</a>
</div>
<a href="<?php echo $this->_tpl_vars['configuration']->getParameter('site_root_webpath'); ?>
/category/<?php echo $this->_tpl_vars['typeArray']->getId(); ?>
">
<?php if ($this->_tpl_vars['typeArray']->getImage() != ''): ?>
<img class="cat_browser" src="<?php echo $this->_tpl_vars['configuration']->getParameter('site_root_webpath'); ?>
/images/product_categories/<?php echo $this->_tpl_vars['typeArray']->getImage(); ?>
" alt="click for <?php echo $this->_tpl_vars['typeArray']->getName(); ?>
" />
<?php else: ?>
<div class="category_img_spacer"></div>
<?php endif; ?>
</a>
</div>
<?php endforeach; endif; unset($_from); ?>

<!-- Stop Category Browser -->

</div>