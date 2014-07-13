<?php
// include essential files
require_once('../common/essential.inc.php');

if(isset($_SESSION['userName'])) {
    unset($_SESSION['userName']);
    if(isset($_SESSION['userType'])) {
        unset($_SESSION['userType']);
    }
    header("location:".RELA_DIR);
}
header("location:".RELA_DIR);