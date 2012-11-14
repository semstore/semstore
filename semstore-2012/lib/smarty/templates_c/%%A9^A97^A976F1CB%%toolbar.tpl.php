<?php /* Smarty version 2.6.10, created on 2008-01-03 05:05:11
         compiled from _default/toolbar.tpl */ ?>
<div id="menu"><p class="specials">_default/toolbar.tpl</p>	
<ul>
<li><a href="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/index.php">Home</a></li>
<li><a href="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/products.php">Shop</a></li>
<li><a href="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/about.php">About Us</a></li>
<li><a href="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/contact.php">Contact Us</a></li>
<li><a href="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/customerservice.php">Customer Service</a></li>
<?php if (! $this->_tpl_vars['loggedIn']): ?>
<li><a href="login.php">Log in</a> / <a href="registration.php">Register</a></li>
<?php else: ?>
<li><a href="logout.php">Log out</a> / <a href="myaccount.php">My Account</a></li>
<?php endif; ?>
</ul>

</div>