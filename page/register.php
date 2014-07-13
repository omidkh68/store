<?php
// include essential files
require_once('../common/essential.inc.php');

$page = new pages();

if(isset($_POST['action'])) {
    $pageAct = strtolower($_POST['action']);

    switch ($pageAct) {
        case 'register' :

            $userInfo = array();

            $userInfo['username'] = safestrip(strtolower(isset($_POST['username'])?$_POST['username']:""));
            $userInfo['password'] = safestrip(isset($_POST['password'])?$_POST['password']:"");
            $userInfo['password2'] = safestrip(isset($_POST['repassword'])?$_POST['repassword']:"");

            if($userInfo['password'] == $userInfo['password2']) {

                // register information of user
                $users = new user();
                $users->userInfo = $userInfo;
                $userResult = $users->register();

                // if user exist continue
                if($userResult == 1) {
                    $page->page_registerResult(1);

                } else {
                    $page->page_registerResult(0);
                }

            } else {
                die("passwords not match");
            }

            break;

        default :
            // load page
            $page->page_register();
            break;
    }

} else {
    // load page
    $page->page_register();
}