<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 5/16/14
 * Time: 4:21 AM
 */

class pages_admin {

    private static $_pageStart = "template/admin/templateAdmin_start.tpl";
    private static $_pageHeader = "template/admin/templateAdmin_header.tpl";
    private static $_pageRightMenu = "template/admin/templateAdmin_rightmenu.tpl";
    private static $_pageEnd = "template/admin/templateAdmin_end.tpl";
    private $_pageMessage;
    private $_myPage;
    private $_pageContent;
    private $_pageType;

    /**
     *  constructor of this class
     */
    public function __construct() {
        $this->_myPage = "";
        $this->_pageContent = array();
        $this->_pageType = 0;
        $this->_pageMessage = array(
            'type'=>'',
            'title'=>'',
            'message'=>''
        );
    }

    /**
     * html stream view of end user
     */
    private function htmlStream()
    {
        // check user logged in or not
        /*if($header) {
            $this->checkLogin();
        }*/

        // include head have links and scripts and meta tags
        include_once(ROOT_DIR . self::$_pageStart);

        // include header of website have logo and menus
        include_once(ROOT_DIR . self::$_pageHeader);

        // information to send into users view
        if($this->_pageContent != "") {
            $temp = $this->_pageContent;
            /*echo "<pre>";
            print_r($temp);die();*/
        }

        if($this->_pageMessage['message'] != "") {
            $message = $this->_pageMessage;
        }

        // include right menu
        include_once(ROOT_DIR . self::$_pageRightMenu);

        // include my own page template
        include_once(ROOT_DIR . "template/admin/" . $this->_myPage);

        // include end of html document have end of body and html
        include_once(ROOT_DIR . self::$_pageEnd);

        die();
    }



    /**
     * check user logged in or not to redirect in login page
     */
    public function checkLogin() {
        if(!isset($_SESSION['userName']) || empty($_SESSION['userName'])) {
            header("location:".RELA_DIR."page/login.php");
        }
    }

    /**
     * include admin dashboard
     */
    public function page_dashboard($resource)
    {
        $this->_pageContent['reports'] = $resource;

        $this->_myPage = "dashboard.tpl";

        // call show page
        $this->htmlStream();
    }

    /**
     *  include login
     */
    public function page_login()
    {
        $this->_myPage = "page_login.tpl";

        // include my own page template
        include_once(ROOT_DIR . "template/admin/" . $this->_myPage);

        die();
    }

    /**
     * include login error page
     */
    public function page_loginError($error)
    {
        $this->_pageFields = $error;

        $this->_myPage = "page_login.tpl";

        // include my own page template
        include_once(ROOT_DIR . "template/admin/" . $this->_myPage);

        die();
    }

    /**
     * include user list
     */
    public function page_userList($resource)
    {
        $this->_pageContent['userList'] = $resource;

        $this->_myPage = "page_userList.tpl";

        // call show page
        $this->htmlStream();
    }

    /**
     * include add new user form
     */
    public function page_userAdd()
    {
        $this->_myPage = "page_userForm.tpl";

        // call show page
        $this->htmlStream();
    }

    /**
     * include user form for edit this
     */
    public function page_userEdit($resource)
    {

        $this->_pageContent['userInfo'] = $resource;

        $this->_myPage = "page_userForm.tpl";

        // call show page
        $this->htmlStream();
    }

    /**
     * include user list
     */
    public function page_productList($resource)
    {
        $this->_pageContent['productList'] = $resource;

        $this->_myPage = "page_productList.tpl";

        // call show page
        $this->htmlStream();
    }

    /**
     * include add new user form
     */
    public function page_productAdd($resource)
    {
        $this->_pageContent['productBrand'] = $resource['brand'];
        $this->_pageContent['productType'] = $resource['type'];

        $this->_myPage = "page_productForm.tpl";

        // call show page
        $this->htmlStream();
    }

    /**
     * include user form for edit this
     */
    public function page_productEdit($resource)
    {

        $this->_pageContent['productInfo'] = $resource;

        $this->_myPage = "page_productForm.tpl";

        // call show page
        $this->htmlStream();
    }

}