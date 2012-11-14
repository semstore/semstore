<table>
<tr class="row">
	<th>Title</th>
	<td>{$reg_title}</td>
</tr>

<tr class="row">
	<th>Firstname</th>
	<td>{$reg_firstname}</td>
</tr>

<tr class="row">
	<th>Surname</th>
	<td>{$reg_surname}</td>
</tr>

<tr class="row">
	<th>Email</th>
	<td>{$reg_email}</td>
</tr>


<tr class="row">
	<th>Company Name</th>
	<td>{$reg_company_name}</td>
</tr>

<tr class="row">
	<th>Building Name</th>
	<td>{$reg_building_name}</td>
</tr>

<tr class="row">
	<th>Building Number</th>
	<td>{$reg_building_number}</td>
</tr>

<tr class="row">
	<th>Street</th>
	<td>{$reg_street}</td>
</tr>

<tr class="row">
	<th>Area</th>
	<td>{$reg_area}</td>
</tr>

<tr class="row">
	<th>City</th>
	<td>{$reg_city}</td>
</tr>

<tr class="row">
	<th>County</th>
	<td>{$reg_county}</td>
</tr>

{if $reg_international}
<tr class="row">
	<th>Country</th>
	<td>{$reg_country}</td>
</tr>
{/if}

<tr class="row">
	<th>Postcode</th>
	<td>{$reg_postcode}</td>
</tr>

</table>

<a href="myaccount.php">Back</a> <a href="myaccount.php?view=edit_details">Edit</a>
