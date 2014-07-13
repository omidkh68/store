<?php
// include essential files
include_once("common/server.inc.php");
include_once("common/init.inc.php");
include_once("model/class.db.php");
include_once("model/class.product.php");
include_once("model/class.pages.php");

$page = new pages();
$product = new product();
$result = $product->product_list_home();
$page->mainPage($result);