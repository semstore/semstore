<div id="middle">
<div class="breadcrumb"> <a href="{$siteRootWebpath}/index.php">Home</a> | Log in </div>
<h1>Log in</h1>
<p>Pellentesque placerat. Morbi eu nibh et nisi <strong>accumsan</strong> interdum. Mauris  eu felis ut pede sagittis posuere. Aliquam dapibus. Sed tincidunt augue  sit amet nisi. Sed urna. Fusce ut sapien. Cum sociis natoque penatibus  et magnis dis parturient montes, nascetur ridiculus mus. </p> 
<form action="login.php" method="post" enctype="application/x-www-form-urlencoded" class="login">
<input name="action" value="login" type="hidden" />
<p>Login</p>

{if !$loggedIn}

<p><label>Email<br/>
<input name="email" value="" type="text" /></label></p>
<p><label>Password<br/>
<input name="password" value="" type="password" /></label></p>
{if $loginErrorMsg}<p class="errormessage">{$loginErrorMsg}</p>{/if}
<p><input name="button" value="Login" type="submit" /></p>
{else}
<p>You are already logged in!</p>
{/if}
</form><p class="specials">_ecomstore/login.tpl</p>	</div>
