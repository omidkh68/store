<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 7/7/14 AD
 * Time: 6:10
 */

// include essential files
require_once('../common/essential.inc.php');

$products = new basket();

$result = $products->getAllPurchaseProduct();

$page->page_purchased($result);