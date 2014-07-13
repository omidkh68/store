<?php
// include essential files
require_once('../common/essential.inc.php');

$users = new userAdmin();

if(isset($_GET['action'])) {
    $act = $_GET['action'];

    switch ($act) {
        // show list of all user
        case 'list' :

            $result = $users->user_list();

            $pageAdmin->page_userList($result);

            break;
        // add new user
        case 'addUser' :
            if (isset($_POST['action'])) {
                $formAct = $_POST['action'];

                if ($formAct == 'addUser') {

                    $userInfo['email'] = safestrip(isset($_POST['email'])?$_POST['email']:"");
                    $userInfo['password'] = safestrip(isset($_POST['password'])?$_POST['password']:"");
                    $userInfo['name'] = safestrip(isset($_POST['name'])?$_POST['name']:"");
                    $userInfo['family'] = safestrip(isset($_POST['family'])?$_POST['family']:"");
                    $userInfo['age'] = safestrip(isset($_POST['age'])?$_POST['age']:"");
                    $userInfo['tel'] = safestrip(isset($_POST['tel'])?$_POST['tel']:"");

                    $users->userInfo = $userInfo;
                    $result = $users->register();

                    if($result == 1) {
                        $_SESSION['pageMessage']['title'] = "پیغام موفق";
                        $_SESSION['pageMessage']['type'] = "success";
                        $_SESSION['pageMessage']['message'] = "کاربر جدید با موفقیت در سیستم ثبت شد";
                        header("location:".RELA_DIR."admin/users.php");
                    } else if($result == -1) {
                        $_SESSION['pageMessage']['title'] = "پیغام خطا";
                        $_SESSION['pageMessage']['type'] = "warning";
                        $_SESSION['pageMessage']['message'] = "کاربر مورد نظر در سیستم موجود می باشد لطفا ایمیل دیگری وارد نمایید.";
                        header("location:".RELA_DIR."admin/users.php");
                    } else {
                        $_SESSION['pageMessage']['title'] = "پیغام خطا";
                        $_SESSION['pageMessage']['type'] = "danger";
                        $_SESSION['pageMessage']['message'] = "کاربر جدید در سیستم ثبت نشد";
                        header("location:".RELA_DIR."admin/users.php");
                    }

                } else {
                    $result = $users->user_list();

                    $pageAdmin->page_userList($result);
                }

            } else {
                $pageAdmin->page_userAdd();
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
                $result = $users->user_list();

                $pageAdmin->page_userList($result);
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
                $result = $users->user_list();

                $pageAdmin->page_userList($result);
            }
            break;

        // if no action was found go to user's list
        default :
            $result = $users->user_list();

            $pageAdmin->page_userList($result);
            break;
    }

} else {
    $result = $users->user_list();

    $pageAdmin->page_userList($result);
}