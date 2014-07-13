<?php
// include essential files
require_once('../common/essential.inc.php');

$product = new product();
$page = new pages();

if(isset($_GET['action'])) {
    $act = $_GET['action'];

    switch ($act) {
        case '' :

            break;
    }

} else {
    $page->page_search();
}