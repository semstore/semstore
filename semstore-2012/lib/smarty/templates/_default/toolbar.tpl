<div id="menu"><p class="specials">_default/toolbar.tpl</p>	
<ul>
<li><a href="{$siteRootWebpath}/index.php">Home</a></li>
<li><a href="{$siteRootWebpath}/products.php">Shop</a></li>
<li><a href="{$siteRootWebpath}/about.php">About Us</a></li>
<li><a href="{$siteRootWebpath}/contact.php">Contact Us</a></li>
<li><a href="{$siteRootWebpath}/customerservice.php">Customer Service</a></li>
{if !$loggedIn}
<li><a href="login.php">Log in</a> / <a href="registration.php">Register</a></li>
{else}
<li><a href="logout.php">Log out</a> / <a href="myaccount.php">My Account</a></li>
{/if}
</ul>

</div>