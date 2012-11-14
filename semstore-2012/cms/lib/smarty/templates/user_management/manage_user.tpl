{include file="breadcrumb.tpl"}


<h1 class="page_title">Profile for user <span>{$user->getFirstname()} {$user->getSurname()}<span></h1>


<fieldset class="tools">
<legend>Tools</legend>
<a href="manage_user_privileges.php?uid={$user->getId()}">Manage User Privileges</a>
<a href="remove_user.php?uid={$user->getId()}">Remove User</a>
</fieldset>


<div class="product_details">
<fieldset>
<legend>User Details</legend>
<table cellspacing="0">
        <tr>
                <th>Firstame</th>
                <td>{$user->getFirstname()}</td>
        </tr>
        <tr>
                <th>Surname</th>
                <td>{$user->getSurname()}</td>
        </tr>
        <tr>
                <th>Email Address</th>
                <td>{$user->getEmail()}</td>
        </tr>
        <tr>
                <th>Username</th>
                <td>{$user->getUsername()}</td>
        </tr>
</table>
</fieldset>

<a href="edit_user.php?uid={$user->getId()}">Edit</a>
</div>

