<?php /* Smarty version 2.6.10, created on 2009-04-07 04:20:43
         compiled from _login/login.tpl */ ?>
<img src="" style="width: 500px; height: 75px" />

<form action="<?php echo $this->_tpl_vars['formAction']; ?>
" method="post" enctype="application/x-www-form-urlencoded">
<input name="action" value="login" type="hidden" />
<fieldset>
        <div><label>Login</label><input name="login" value="" type="text" class="login" /></div>
        <div><label>Password</label><input name="password" value="" type="password" class="password" /></div>
</fieldset>
<input name="button" value="Login" type="submit" class="submit" />
</form>