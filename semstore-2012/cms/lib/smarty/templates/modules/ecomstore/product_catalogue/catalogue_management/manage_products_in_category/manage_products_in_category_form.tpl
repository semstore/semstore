{literal}
<script language="JavaScript">

var categoryProducts = new Array();

function updateProductsInCategoryList ()
{
        var listRef = document.getElementById('productsInCategoryList');
        var html = '';
        
        html += '<tr>';
        html += '<th class="productName">Product Name</th><th>Code</th><th>Price</th><th>Options</th>';
        html += '</tr>';
        for ( var i = 0; i < categoryProducts.length; i++ )
        {
                var categoryProduct = categoryProducts[i];
                html += '<tr>';
                html += '<td class="productName">' + categoryProduct[1]+'</td>';
                html += '<td>' + categoryProduct[2]+'</td>';
                html += '<td>&pound;' + categoryProduct[3]+'</td>';
                html += '<td><button type="button" onclick="removeProduct('+i+')">Remove</button></td>';
                html += '</tr>';
        }
        
        listRef.innerHTML = html;
}


function updateProductsInCategoryHiddens ()
{
        var ref = document.getElementById('productsInCategoryHiddens');
        var html = '';
        
        for ( var i = 0; i < categoryProducts.length; i++ )
        {
                var categoryProduct = categoryProducts[i];
                html += '<input name="productsInCategory[]" value="' +
                        categoryProduct[0] + '" type="hidden" />';
        }
        
        ref.innerHTML = html;
}


function addProduct ( productId, productName, productCode, productPrice )
{
        categoryProducts.push(
                new Array(productId, productName, productCode, productPrice));
        updateProductsInCategoryList();
        updateProductsInCategoryHiddens();
}


function removeProduct ( idx )
{
        categoryProducts.splice(idx, 1);
        updateProductsInCategoryList();
        updateProductsInCategoryHiddens();
}

</script>
{/literal}


<script language="JavaScript">
{foreach item="productInCategory" from=$productsInCategory}
categoryProducts.push(
        new Array('{$productInCategory->getId()}',
                '{$productInCategory->getName()}',
                '{$productInCategory->getCode()}',
                '{$productInCategory->formattedPrice()}')
        );
{/foreach}
</script>

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



<div class="padded">
<fieldset>
<legend>Products In Category</legend>
<table id="productsInCategoryList"></table>

<form action="{$formAction}" method="{$formMethod}" enctype="{$formEncoding}">
<input name="action" value="{$action}" type="hidden" />
<span id="productsInCategoryHiddens"></span>
<button name="update" type="submit">Update</button>
</form>
</fieldset>
</div>



<div>
{*}
<!--
<fieldset class="tools">
<legend>Search</legend>
<form>
<p> Product Name <input type="text" name="productName" value="{$searchValue}" /> <input type="submit" value="Submit"/> <input type="reset" value="Reset" /></p>
</fieldset>
-->
{/*}

<div class="products">
<fieldset>
<legend>Products</legend>

{if $searchPager.totalPages > 1}
<p>Showing {$searchPager.hitsPerPage} results starting at {$searchPager.criteria.st+1} of {$searchPager.totalHits}</p>
{/if}

{if $products}
<table width="100%" class="trhover">
<tr>
<th align="center">Product Name</th>
<th align="center">Code</th>
<th align="center">Price</th>
<th width="150" align="center">Options</th>
</tr>
{foreach item="product" from=$products}
<tr>
<td>{$product->getName()}</td>
<td align="center">{$product->getCode()}</td>
<td align="center">&pound;{$product->formattedPrice()}</td>
<td width="150" align="center" >
        <button type="button" onclick="addProduct('{$product->getId()}', '{$product->getName()}', '{$product->getCode()}', '{$product->formattedPrice()}')">Add</button>
</tr>
{/foreach}
</table>

{*}
<!--
{if $searchPager.totalPages > 1}
<p>Page
{foreach key="pageNumber" item="pagerPage" from=$searchPager.pages}
{if $pagerPage.is_current}
{if !$pagerPage.is_last}
{$pageNumber}&nbsp;|&nbsp;
{else}
{$pageNumber}
{/if}
{elseif !$pagerPage.is_last}
<a href="?{$pagerPage.uri}">{$pageNumber}</a>&nbsp;|&nbsp;
{else}
<a href="?{$pagerPage.uri}">{$pageNumber}</a>
{/if}
{/foreach}
of {$searchPager.totalPages}</p>
{/if}
-->
{/*}
{else}
<p>There are currently no products in the database.</p>
{/if}
</div>
</div>



{literal}
<script language="JavaScript">
updateProductsInCategoryList();
updateProductsInCategoryHiddens();
</script>
{/literal}
