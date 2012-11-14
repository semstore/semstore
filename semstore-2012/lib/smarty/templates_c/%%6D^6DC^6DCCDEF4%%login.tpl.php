<?php /* Smarty version 2.6.10, created on 2008-06-12 03:27:31
         compiled from _ecomstore/login.tpl */ ?>
<div id="middle">
<div class="breadcrumb"> <a href="<?php echo $this->_tpl_vars['siteRootWebpath']; ?>
/index.php">Home</a> | Log in </div>
<h1>Log in</h1>
<p>Pellentesque placerat. Morbi eu nibh et nisi <strong>accumsan</strong> interdum. Mauris  eu felis ut pede sagittis posuere. Aliquam dapibus. Sed tincidunt augue  sit amet nisi. Sed urna. Fusce ut sapien. Cum sociis natoque penatibus  et magnis dis parturient montes, nascetur ridiculus mus. </p> 
<form action="login.php" method="post" enctype="application/x-www-form-urlencoded" class="login">
<input name="action" value="login" type="hidden" />
<p>Login</p>

<?php if (! $this->_tpl_vars['loggedIn']): ?>

<p><label>Email<br/>
<input name="email" value="" type="text" /></label></p>
<p><label>Password<br/>
<input name="password" value="" type="password" /></label></p>
<?php if ($this->_tpl_vars['loginErrorMsg']): ?><p class="errormessage"><?php echo $this->_tpl_vars['loginErrorMsg']; ?>
</p><?php endif; ?>
<p><input name="button" value="Login" type="submit" /></p>
<?php else: ?>
<p>You are already logged in!</p>
<?php endif; ?>
</form><p class="specials">_ecomstore/login.tpl</p>	</div>