<?php
// include essential files
require_once('../common/essential.inc.php');

if(isset($_SESSION['userName']) && isset($_SESSION['userType']) && $_SESSION['userType'] == "admin") {
    header("location:".RELA_DIR."admin/");
} else {
    if(isset($_POST['action'])) {
        $act = $_POST['action'];
        switch ($act) {
            case 'login' :
                $userInfo['email'] = isset($_POST['email'])?$_POST['email']:"";
                $userInfo['password'] = isset($_POST['password'])?$_POST['password']:"";

                $user = new userAdmin();
                $user->userInfo = $userInfo;
                $result = $user->_checkUser();
                if($result) {
                    $user->login_success();
                    header("location:".RELA_DIR."admin/");
                } else {
                    $pageAdmin->page_loginError($user->login_error());
                }

                break;

        }
    } else if(isset($_SESSION['userName']) && $_SESSION['userName'] == "active_admin") {
        header("location:".RELA_DIR."admin/");
    }
    $pageAdmin->page_login();
}