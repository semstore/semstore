<?php

$template->assign_by_ref('product', $product);

//$attributeGroups =& $product->getProductGlobalAttributeGroups();
$attributeGroups =& $product->getAttributeGroups();
$template->assign_by_ref('attributeGroups', $attributeGroups);

?>
