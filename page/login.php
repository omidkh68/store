<?php
// include essential files
require_once('../common/essential.inc.php');

if(isset($_SESSION['userName']) && !empty($_SESSION['userName'])) {
    header("location:".RELA_DIR);
}

$page = new pages();
if(isset($_POST['action'])) {
    $act = strtolower($_POST['action']);

    switch ($act) {
        case 'login' :
            $userInfo['username'] = isset($_POST['email'])?$_POST['email']:"";
            $userInfo['password'] = isset($_POST['password'])?$_POST['password']:"";

            $users = new user();
            $users->userInfo = $userInfo;
            $result = $users->_checkUser();
            if($result) {
                $users->login_success();
                header("location:".RELA_DIR);
            } else {
                $page->page_login_error();
            }

            break;
    }

} else {
    $page->page_login();
}