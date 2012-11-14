{if $formErrors}
<div class="form_errors">
<p class="title">Submission Errors</p>
<p>There were errors with the data you have submitted.  
Please correct the errors list below and submit the data again.</p>
<ul>
{foreach item="formError" from=$formErrors}
        <li>{$formError}</li>
{/foreach}
</ul>
</div>
{/if}

<div class="input_form">

<table>
        {foreach item="product" from=$products}
        <tr>
                <td class="cell1">{$product->getName()}</td>
                <td class="cell2"><a href="add_product_to_category.php?categoryid={$category->getId()}&amp;productid={$product->getId()}&amp;action=add_product_to_category">Add</a></td>
        </tr>
        {/foreach}
</table>

<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">
<input name="action" value="{$action}" type="hidden" />
<div class="form_controls">
<input name="button" value="Cancel" type="submit" />
</div>
</form>

</div>
