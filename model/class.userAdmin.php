<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 5/17/14
 * Time: 9:16 PM
 */

class userAdmin
{

    private $_User;
    private $_linkDB;
    private $_result;

    /**
     * create object of user class
     */
    public function __construct() {
        $this->_linkDB = new db();
        $this->_User = array (
            'userID'=>'',
            'userEmail'=>'',
            'password'=>'',
            'userName'=>'',
            'userFamily'=>'',
            'userAge'=>'',
            'userTel'=>''
        );
        return true;

    }

    /**
     * setter switcher
     * @param $field
     * @param $value
     */
    public function __set($field, $value) {
        if($field == "userInfo") {
            $this->_set_userInfo($value);
        }
    }

    /**
     * set user info
     */
    private function _set_userInfo($value) {
        if(isset($value['user_id'])) {
            $this->_User['userID'] = $value['user_id'];
        }
        if(isset($value['email'])) {
            $this->_User['userEmail'] = strtolower($value['email']);
        }
        if(isset($value['password'])) {
            $this->_User['password'] = $value['password'];
        }
        if(isset($value['name'])) {
            $this->_User['userName'] = strtolower($value['name']);
        }
        if(isset($value['family'])) {
            $this->_User['userFamily'] = strtolower($value['family']);
        }
        if(isset($value['age'])) {
            $this->_User['userAge'] = $value['age'];
        }
        if(isset($value['tel'])) {
            $this->_User['userTel'] = $value['tel'];
        }
    }

    /**
     * check user exist or not
     */
    private function checkUserExist() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_customer","customer_id","WHERE email = '". $this->_User['userEmail'] ."'");
            if(is_array($this->_result)) {
                return 0;
            } else {
                return 1;
            }
        } else {
            return 0;
        }
    }

    /**
     * check admin exist
     * @return int
     */
    public function _checkUser() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_customer","customer_id,email","WHERE email = '". $this->_User['userEmail'] ."' AND password = '". sha1($this->_User['password']) ."' AND user_type = 1 LIMIT 1;");
            if($this->_result != 0) {
                return 1;
            } else {
                return 0;
            }
        }
    }

    /**
     * if login successful then active session
     */
    public function login_success() {
        if(isset($_SESSION['userName']) || isset($_SESSION['userType'])) {
            $_SESSION['userName'] = "";
            $_SESSION['userType'] = "";
            unset($_SESSION['userName']);
            unset($_SESSION['userType']);
        }
        if($this->_result != 0) {
            foreach($this->_result[0] as $row) {
                $_SESSION['userName'] = $row->email;
                $_SESSION['userType'] = "admin";
            }
        }
    }

    /**
     * get user id with email
     * @return int
     */
    public function get_userID() {
        $temp = func_get_args();
        $email = "";
        if(is_array($temp) && !empty($temp)) {
            $email = $temp[0];
        } else {
            $email = $this->_User['userEmail'];
        }

        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_customer","customer_id","WHERE email = '". $email ."' LIMIT 1;");
            if($this->_result != 0) {
                foreach($this->_result[0] as $row) {
                    return $row->customer_id;
                }
            }
        } else {
            return 0;
        }
    }

    /**
     * check user exist
     * @return int
     */
    public function _checkUserAdmin() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_customer","customer_id","WHERE email = '". $this->_User['userEmail'] ."' AND password = '". sha1($this->_User['userPassword']) ."' AND user_type = 1");
            return $this->_result[1];
        } else {
            return 0;
        }
    }

    /**
     * if login successful then active session
     */
    public function success_adminLogin() {
        if($this->_result[1]) {
            $_SESSION['userName'] = "active_admin";
        }
    }

    /**
     * if login successful then active session
     * @return string
     */
    public function login_error() {
        return "نام کاربری و یا رمز عبور اشتباه می باشد و یا حساب شما فعال نمی باشد.";
    }

    /**
     * get all user data
     * @return mixed
     */
    public function user_list() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_customer","customer_id,email,name,family,age,phone_number,national_code,status,pic_name","WHERE user_type=0");
            return $this->_result[0];
        } else {
            return 0;
        }
    }

    /**
     * register user
     * @return int
     */
    public function register() {
        if($this->checkUserExist() != 1)
            return -1;

        if($this->_linkDB) {
            $userInfo = "'" .
                $this->_User['userEmail'] . "','" .
                sha1($this->_User['password']) . "','" .
                $this->_User['userName'] . "','" .
                $this->_User['userFamily'] . "'," .
                $this->_User['userAge'] . ",'" .
                $this->_User['userTel']."'";
            $result = $this->_linkDB->insert("tbl_customer","email,password,name,family,age,phone_number",$userInfo);
            return $result;
        } else {
            return 0;
        }
    }

    /**
     * delete seleceted user id
     * @return int
     */
    public function deleteUser() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->delete("tbl_customer","customer_id=".$this->_User['userID'].";");
            return $this->_result;
        } else {
            return 0;
        }
    }

    /**
     * get all information of selected user for edit this information
     * @return int
     */
    public function get_userInfo() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_customer","*","WHERE user_type=0 AND customer_id=".$this->_User['userID'].";");
            return $this->_result[0];
        } else {
            return 0;
        }
    }

    /**
     * edit custom selected user
     * @return bool
     */
    public function editUser() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->update("tbl_customer","name='".$this->_User['userName']."',family='".$this->_User['userFamily']."',age=".$this->_User['userAge'].",phone_number=".$this->_User['userTel']."","WHERE customer_id = ".$this->_User['userID'].";");
            return $this->_result;
        } else {
            return false;
        }
    }

    /**
     * get count of all users
     * @return int
     */
    public function report_getAllUsers() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_customer","COUNT(customer_id) as count","where user_type=0");
            if($this->_result != 0) {
                foreach($this->_result[0] as $row) {
                    return $row->count;
                }
            }
        } else {
            return 0;
        }
    }

    /**
     * get count of all users
     * @return int
     */
    public function report_getAllOnlineUsers() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_customer","COUNT(customer_id) as count","where user_type=0 AND status = 1");
            if($this->_result != 0) {
                foreach($this->_result[0] as $row) {
                    return $row->count;
                }
            }
        } else {
            return 0;
        }
    }

    /**
     * get count of all users that purchased
     * @return int
     */
    public function report_getAllUsersPurchased() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_sale","COUNT(distinct customer_id) as count");
            if($this->_result != 0) {
                foreach($this->_result[0] as $row) {
                    return $row->count;
                }
            }
        } else {
            return 0;
        }
    }

}