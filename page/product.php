<?php
// include essential files
require_once('../common/essential.inc.php');

$product = new product();

if(isset($_GET['action'])) {
    $act = $_GET['action'];
    $result = $product->product_list();

    switch ($act) {
        case 'viewProduct' :

            if(isset($_GET['pid'])) {

                $pid['product_id'] = $_GET['pid'];
                $product->productInfo = $pid;
                $pidResult = $product->getProduct_detail();
                $page->page_product($pidResult,'detail');

            } else if(isset($_GET['catid'])) {

                $pcat['type'] = $_GET['catid'];
                $product->productInfo = $pcat;
                $pcatResult['product'] = $product->getProduct_detail_withCat();
                $pcatResult['cat'] = $product->getProductTypeName();
                $page->page_product($pcatResult,'allCat');

            } else {

                $page->page_product($result,'all');

            }

            break;
        case 'addProduct' :

            if(isset($_POST['action'])) {

            } else {
                $page->page_addProduct();
            }

            break;
    }

} else {
    $result['product'] = $product->product_list();
    $result['cat'] = $product->getProductTypeName();
    $page->page_product($result,'all');
}