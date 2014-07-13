<?php
include_once("../common/server.inc.php");
include_once("../common/func.inc.php");
include_once("../common/init.inc.php");

function __autoload($name)
{
    $modelFileName = ROOT_DIR . 'model/class.' . $name . '.php';

    if (file_exists($modelFileName)) {
        require_once($modelFileName);
    }
}

$page = new pages();

$pageAdmin = new pages_admin();