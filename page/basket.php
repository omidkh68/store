<?php
// include essential files
require_once('../common/essential.inc.php');

$basket = new basket();

if(isset($_POST['action'])) {

    $act = $_POST['action'];
    if($act == "addToBasket") {
        $product['product_id'] = $_POST['proID'];
        $product['quantity'] = $_POST['quantity'];

        $basket->addToBasket = $product;
        $basket->addBasket();

        $basket->getBasket();
        header("location:".RELA_DIR."page/basket.php");
    } else if($act == "confirm") {

        $product['prod'] = $_POST['prod'];
        $basket->addToBasket = $product;
        $basket->confirmBuy();
        header("location:".RELA_DIR."page/basket.php");

    } else {
        $result = $basket->getBasket();
        $page->page_basket($result);
    }

} else if(isset($_GET['action'])) {

    if($_GET['action'] == "delPro") {
        $product['basket_id'] = $_GET['bid'];

        $basket->addToBasket = $product;
        $basket->deleteBasket();

        header("location:".RELA_DIR."page/basket.php");
    } else {
        $result = $basket->getBasket();
        $page->page_basket($result);
    }

} else {
    $result = $basket->getBasket();
    $page->page_basket($result);
}