<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 5/16/14
 * Time: 4:21 AM
 */

class pages
{

    private static $_pageStart = "template/template_start.tpl";
    private static $_pageHeader = "template/template_header.tpl";
    private static $_pageFooter = "template/template_footer.tpl";
    private static $_pageEnd = "template/template_end.tpl";
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
     * @param int $header
     * @param int $footer
     */
    private function htmlStream($header=1,$footer=1) {
        // check user logged in or not
        /*if($header) {
            $this->checkLogin();
        }*/

        // include head have links and scripts and meta tags
        include_once(ROOT_DIR . self::$_pageStart);

        // check if true include page header have banner
        if($header) {
            // include header of website have logo and menus
            include_once(ROOT_DIR . self::$_pageHeader);
        }

        // information to send into users view
        if($this->_pageContent != "") {
            $temp = $this->_pageContent;
            //echo "<pre>";
            //print_r($temp);
        }

        if($this->_pageMessage['message'] != "") {
            $message = $this->_pageMessage;
        }

        // include my own page template
        include_once(ROOT_DIR . $this->_myPage);

        // include footer of website have address and links and copyright
        if($footer) {
            include_once(ROOT_DIR . self::$_pageFooter);
        }

        // include end of html document have end of body and html
        include_once(ROOT_DIR . self::$_pageEnd);

        die();
    }

    /**
     * check user logged in or not to redirect in login page
     */
    private function checkLogin() {
        if(!isset($_SESSION['userName']) || empty($_SESSION['userName'])) {
            header("location:".RELA_DIR."page/login.php");
        }
    }

    /**
     * include home page of website
     */
    public function mainPage() {
        $temp = func_get_args();

        $this->_myPage = "template/page_home.tpl";

        $this->_pageContent['products'] = $temp[0];

        // call show page
        $this->htmlStream();
    }

    /**
     * include register full form
     */
    public function page_register() {

        header("location:".RELA_DIR."template/page_register.php");

        die();
    }

    /**
     * include register form
     */
    public function page_login() {

        header("location:".RELA_DIR."template/page_login.php");

        die();
    }

    /**
     * include register form
     */
    public function page_login_error() {

        unset($_SESSION['pageMessage']);

        $this->_myPage = "template/page_login.php";

        $message = '
نام کاربری و یا گذرواژه وارد شده اشتباه می باشد
<br>
در صورت فراموش کردن رمز عبور لطفا با مدیریت فروشگاه تماس حاصل فرمایید.            ';

        $_SESSION['pageMessage']['type'] = 'danger';
        $_SESSION['pageMessage']['message'] = $message;

        header("location:".RELA_DIR.$this->_myPage);
    }

    /**
     * include rules page
     */
    public function page_rules() {
        $this->_myPage = "template/page_rules.tpl";

        // call show page
        $this->htmlStream();
    }

    /**
     * include about page
     */
    public function page_about() {
        $this->_myPage = "template/page_about.tpl";

        // call show page
        $this->htmlStream();
    }

    /**
     * include search page
     */
    public function page_search() {
        $this->_myPage = "template/page_search.tpl";

        // call show page
        $this->htmlStream();
    }

    /**
     * include all product page
     */
    public function page_product() {

        $temp = func_get_args();

        if($temp[1] == 'all') {

            $this->_pageContent['products'] = $temp[0]['product'];
            $this->_pageContent['cat'] = $temp[0]['cat'];
            $this->_myPage = "template/page_allProduct.tpl";

        } else if($temp[1] == 'allCat') {
            //echo "<pre>";print_r($temp[0]);die();
            $this->_pageContent['products'] = $temp[0]['product'];
            $this->_pageContent['cat'] = $temp[0]['cat'];
            $this->_myPage = "template/page_allProduct.tpl";

        } else if($temp[1] == 'detail') {

            $this->_pageContent['products'] = $temp[0];
            $this->_pageContent['cat'] = $temp[0];
            $this->_myPage = "template/page_product.tpl";

        }

        // call show page
        $this->htmlStream();
    }

    /**
     * show result of registeration
     * @param int $resultType
     */
    public function page_registerResult($resultType = 1) {
        $this->_myPage = "template/page_register.php";

        unset($_SESSION['pageMessage']);

        $_SESSION['pageMessage'] = "";

        if($resultType) {
            $message = '
                ثبت نام شما با موفقیت انجام شد.
                <br>
                لطفا از طریق دکمه ورود به سیستم نام کاربری و گذرواژه خود را وارد نمایید تا در صورت صحیح بودن وارد سیستم شوید با تشکر.
            ';

            $_SESSION['pageMessage']['type'] = 'success';
            $_SESSION['pageMessage']['title'] = 'پیغام موفق';
        } else {
            $message = '
ایمیل وارد شده در سیستم موجود می باشد،
<br>
در صورت فراموش کردن رمز عبور لطفا با مدیریت فروشگاه تماس حاصل فرمایید.            ';

            $_SESSION['pageMessage']['type'] = 'danger';
            $_SESSION['pageMessage']['title'] = 'پیغام خطا';
        }

        $_SESSION['pageMessage']['message'] = $message;

        header("location:".RELA_DIR.$this->_myPage);
    }

    /**
     * show result of registration forms
     */
    public function page_registerResult_show() {
        $this->_myPage = "template/page_registerResult.tpl";

        // call show page
        $this->htmlStream(0,0);

    }

    /**
     * include add product page
     */
    public function page_addProduct() {
        $this->_myPage = "template/page_addProduct.tpl";

        // call show page
        $this->htmlStream();
    }

    /**
     * include basket page
     */
    public function page_basket($resource) {
        $this->_pageContent['basket'] = $resource;

        $this->_myPage = "template/page_basket.tpl";

        // call show page
        $this->htmlStream();
    }

    public function page_purchased($resource) {
        $this->_pageContent['products'] = $resource;

        $this->_myPage = "template/page_profile.tpl";

        // call show page
        $this->htmlStream();
    }

}