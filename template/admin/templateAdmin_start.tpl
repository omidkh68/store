<?php
    if(!isset($_SESSION['userName']) || $_SESSION['userName'] != "active_admin") {
        //header("location:".RELA_DIR."admin/login.php");
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>مدیریت فروشگاه امید</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="omid khosrojerdi">

        <link href="<?=RELA_DIR ?>template/images/logo.png" rel="shortcut icon">
        <link href="<?=RELA_DIR ?>template/images/logo.png" rel="bookmark">

        <!-- CSS -->
        <link rel="stylesheet" href="<?=RELA_DIR ?>template/admin/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="<?=RELA_DIR ?>template/admin/css/admin_main.min.css"/>
        <link rel="stylesheet" href="<?=RELA_DIR ?>template/admin/css/style.css"/>

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
        <script src="http://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7/html5shiv.min.js"></script>
        <![endif]-->

        <!-- javascript
        ================================================== -->
        <script src="<?=RELA_DIR ?>template/admin/js/site-main.js"></script>
        <script src="<?=RELA_DIR ?>template/admin/js/admin-usefull.js"></script>
        <script src="<?=RELA_DIR ?>template/admin/js/admin-form.js"></script>
        <script src="<?=RELA_DIR ?>template/admin/js/admin-editor.js"></script>
        <!--[if lte IE 8]>
        <script src="<?=RELA_DIR ?>template/admin/js/admin.excanvas.js"></script>
        <![endif]-->
        <script src="<?=RELA_DIR ?>template/admin/js/admin-graph.js"></script>
        <script src="<?=RELA_DIR ?>template/admin/js/admin-table.js"></script>
        <script src="<?=RELA_DIR ?>template/admin/js/admin-maps.js"></script>
        <script src="<?=RELA_DIR ?>template/admin/js/admin-util.js"></script>
        <!-- admin script -->
        <script src="<?=RELA_DIR ?>template/admin/js/script.js"></script>


        <!-- required stilearn template js -->
        <script src="<?=RELA_DIR ?>template/admin/js/site.main.js"></script>
        <!-- This scripts will be reload after pjax or if popstate event is active (use with class .re-execute) -->
        <script src="<?=RELA_DIR ?>template/admin/js/site.initializer.js"></script>
    </head>

    <body>
