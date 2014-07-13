<?php
// include essential files
require_once('../common/essential.inc.php');

$product = new productAdmin();

if(isset($_GET['action'])) {
    $act = $_GET['action'];

    switch ($act) {
        // show list of all user
        case 'list' :

            $result = $product->product_list();

            $pageAdmin->page_productList($result);

            break;
        // add new user
        case 'addProduct' :
            if (isset($_POST['action'])) {
                $formAct = $_POST['action'];

                if ($formAct == 'addProduct') {

                    $productInfo['product_name'] = safestrip(isset($_POST['name'])?$_POST['name']:"");
                    $productInfo['brand'] = safestrip(isset($_POST['brand'])?$_POST['brand']:"");
                    $productInfo['size'] = safestrip(isset($_POST['size'])?$_POST['size']:"");
                    $productInfo['price'] = safestrip(isset($_POST['price'])?$_POST['price']:"");
                    $productInfo['mincount'] = safestrip(isset($_POST['quantity'])?$_POST['quantity']:"");
                    $productInfo['color'] = safestrip(isset($_POST['color'])?$_POST['color']:"");
                    $productInfo['type'] = safestrip(isset($_POST['type'])?$_POST['type']:"");
                    $productInfo['product_pic'] = isset($_FILES['pro_pic'])?$_FILES['pro_pic']:"";

                    $product->productInfo = $productInfo;
                    $result = $product->register();

                    if($result == 1) {
                        $_SESSION['pageMessage']['title'] = "پیغام موفق";
                        $_SESSION['pageMessage']['type'] = "success";
                        $_SESSION['pageMessage']['message'] = "محصول جدید با موفقیت ثبت شد";
                        header("location:".RELA_DIR."admin/products.php");
                    } else {
                        $_SESSION['pageMessage']['title'] = "پیغام خطا";
                        $_SESSION['pageMessage']['type'] = "danger";
                        $_SESSION['pageMessage']['message'] = "محصول جدید در سیستم ثبت نشد";
                        header("location:".RELA_DIR."admin/products.php");
                    }

                } else {
                    $result = $product->product_list();

                    $pageAdmin->page_productList($result);
                }

            } else {
                $result['brand'] = $product->get_productBrand();
                $result['type'] = $product->get_productType();
                $pageAdmin->page_productAdd($result);
            }
            break;

        // delete custom user
        case 'delUser' :
            if($_GET['action'] == 'delUser') {
                $uid['user_id'] = $_GET['uid'];
                $users->userInfo = $uid;
                $result = $users->deleteUser();

                if($result == 1) {
                    $_SESSION['pageMessage']['title'] = "پیغام موفق";
                    $_SESSION['pageMessage']['type'] = "success";
                    $_SESSION['pageMessage']['message'] = "کاربر مورد نظر با موفقیت حذف گردید.";
                    header("location:".RELA_DIR."admin/users.php");
                } else {
                    $_SESSION['pageMessage']['title'] = "پیغام خطا";
                    $_SESSION['pageMessage']['type'] = "danger";
                    $_SESSION['pageMessage']['message'] = "کاربر انتخاب شده حذف نگردید";
                    header("location:".RELA_DIR."admin/users.php");
                }

            } else {
                $result = $product->product_list();

                $pageAdmin->page_productList($result);
            }
            break;

        // edit custom user
        case 'editUser' :
            if($_GET['action'] == 'editUser') {
                $uid['user_id'] = $_GET['uid'];

                if(!isset($_POST['action'])) {
                    $users->userInfo = $uid;
                    $result = $users->get_userInfo();

                    $pageAdmin->page_userEdit($result);
                } else {

                    $userInfo['user_id'] = safestrip(isset($_GET['uid'])?$_GET['uid']:"");
                    $userInfo['name'] = safestrip(isset($_POST['name'])?$_POST['name']:"");
                    $userInfo['family'] = safestrip(isset($_POST['family'])?$_POST['family']:"");
                    $userInfo['age'] = safestrip(isset($_POST['age'])?$_POST['age']:"");
                    $userInfo['tel'] = safestrip(isset($_POST['tel'])?$_POST['tel']:"");
                    $users->userInfo = $userInfo;

                    $result = $users->editUser();

                    if($result == 1) {
                        $_SESSION['pageMessage']['title'] = "پیغام موفق";
                        $_SESSION['pageMessage']['type'] = "success";
                        $_SESSION['pageMessage']['message'] = "اطلاعات کاربر مورد نظر با موفقیت بروز شد.";
                        header("location:".RELA_DIR."admin/users.php");
                    } else {
                        $_SESSION['pageMessage']['title'] = "پیغام خطا";
                        $_SESSION['pageMessage']['type'] = "danger";
                        $_SESSION['pageMessage']['message'] = "ویرایش کاربر با مشکل مواجه شده است لطفا بعدا سعی نمایید";
                        header("location:".RELA_DIR."admin/users.php");
                    }

                }

            } else {
                $result = $product->product_list();

                $pageAdmin->page_productList($result);
            }
            break;

        // if no action was found go to user's list
        default :
            $result = $product->product_list();

            $pageAdmin->page_productList($result);
            break;
    }

} else {
    $result = $product->product_list();

    $pageAdmin->page_productList($result);
}