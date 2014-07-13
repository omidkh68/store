<?php
// include essential files
require_once('../common/essential.inc.php');

if(!isset($_SESSION['userName']) || empty($_SESSION['userName'])) {
    header("location:".RELA_DIR."admin/login.php");
} else {
    if(isset($_SESSION['userType']) && !empty($_SESSION['userType']) && $_SESSION['userType'] == "admin") {
        $product = new productAdmin();
        $users = new userAdmin();
        $result = array();

        // get count of all users
        $result['allUsers'] = $users->report_getAllUsers();

        // get count of online users
        $result['allOnlineUser'] = $users->report_getAllOnlineUsers();

        // get count of users that purchased
        $result['allUserPurchased'] = $users->report_getAllUsersPurchased();

        // get count of all products
        $result['allProducts'] = $product->report_getAllProducts();

        // get count of product quantity in inventory
        $result['allProductsQuantity'] = $product->report_getAllProductsQuantity();

        // get count of purchased products
        $result['allProductsPurchased'] = $product->report_getAllProductsPurchased();

        // get count of all brands
        $result['allProductsBrands'] = $product->report_getAllProductsBrands();

        // get max count of purchased brand
        $result['maxBrandsPurchased'] = $product->report_getmaxBrandsPurchased();

        $pageAdmin->page_dashboard($result);
    } else {
        header("location:".RELA_DIR."admin/login.php");
    }
}