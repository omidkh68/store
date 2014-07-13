<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 5/16/14
 * Time: 3:12 AM
 */

session_start();

define("DB_TYPE","mysql");
define("DB_HOST","localhost");
define("DB_USER","store");
define("DB_PASSWORD","Store123456");
define("DB_DATABASE","store");
define("ROOT_DIR",$_SERVER["DOCUMENT_ROOT"] ."/");

define("RELA_DIR","http://".$_SERVER['HTTP_HOST']."/");

define("SMTP_SERVER","mail.dabacenter.ir");
define("SMTP_USERNAME","khosrojerdi@dabacenter.ir");
define("SMTP_PASSWORD","");
define("SMTP_SENDER","Omid Khosrojerdi");

define("ADMIN_EMAIL","");
