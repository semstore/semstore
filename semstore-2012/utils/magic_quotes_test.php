<html>

<head>
<title></title>
</head>

<body>


<form action="<?php print $_SERVER['PHP_SELF']; ?>" method="post">
<label>Input: </label><input name="str" value="" type="text" />
<br />
<input name="button" value="Submit" type="submit" />
</form>

<?php
if ( strtolower($_SERVER['REQUEST_METHOD']) == 'post' )
{
?>
Contents of $_REQUEST['str']:<pre><?php print $_REQUEST['str']; ?></pre>
Contents of stripslashes($_REQUEST['str']):<pre><?php print stripslashes($_REQUEST['str']); ?></pre>
Result of using VW getParam on ($_REQUEST['str']):<pre><?php print stripslashes($_REQUEST['str']); ?></pre>
Result of using RequestParameter::getParameter on ($_REQUEST['str']):<pre><?php print stripslashes($_REQUEST['str']); ?></pre>
<?php
}



function vw_getParam ( $param )
{
        if ( !is_null($_REQUEST[$param]) && isset($_REQUEST[$param]) )
        {
                $value = trim($_REQUEST[$param]);
                if ( get_magic_quotes_gpc() == 1 )
                {
                        return stripslashes($value);
                }
                
                return $value;
        }
        else
        {
                return NULL;
        }
}


function rp_getParameter ( $param )
{
        if ( !is_null($_REQUEST[$param]) && isset($_REQUEST[$param]) )
        {
                return stripslashes(trim($_REQUEST[$param]));
        }
        else
        {
                return NULL;
        }
}


?>

</body>
</html>

