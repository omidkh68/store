<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 5/17/14
 * Time: 9:16 PM
 */

class user
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
            'userEmail'=>'',
            'password'=>'',
            'userPicture'=>''
        );
        return true;

    }

    /**
     * setter switcher
     * @param $field
     * @param $value
     */
    public function __set($field, $value)
    {
        if($field == "userInfo") {
            $this->_set_userInfo($value);
        }
    }

    /**
     * set user info
     */
    private function _set_userInfo() {
        $temp = func_get_args();

        //echo "<pre>";print_r($temp[0]);die();

        if(isset($temp[0]['username'])) {
            $this->_User['userEmail'] = safestrip(strtolower($temp[0]['username']));
        }
        if(isset($temp[0]['password'])) {
            $this->_User['password'] = $temp[0]['password'];
        }
        if(isset($temp[0]['picture'])) {
            $this->_User['userPicture'] = $temp[0]['picture'];
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
     * save profile pictures
     * @return int
     */
    private function save_profilePics() {
        $temp = func_get_args();

        $profilePicCount = count($temp[0]['name']);

        for ($i=0 ; $i<$profilePicCount ; $i++)
        {
            // detect type of image for saving image with default file type
            $imageType = '';

            if($temp[0]['tmp_name'][$i] != "") {
                if (exif_imagetype($temp[0]['tmp_name'][$i]) == IMAGETYPE_GIF) {
                    $imageType  = '.gif';
                } elseIf (exif_imagetype($temp[0]['tmp_name'][$i]) == IMAGETYPE_JPEG) {
                    $imageType  = '.jpeg';
                } elseIf (exif_imagetype($temp[0]['tmp_name'][$i]) == IMAGETYPE_PNG) {
                    $imageType  = '.png';
                } elseIf (exif_imagetype($temp[0]['tmp_name'][$i]) == IMAGETYPE_BMP) {
                    $imageType  = '.bmp';
                }
                //echo $imageType;

                $proPic_name = '('.$this->_User['userEmail'].'-'.($i+1).')'.$imageType;
                $temp_name = $temp[0]['tmp_name'][$i];
                $destinationFolder = ROOT_DIR.'template'.DIRECTORY_SEPARATOR.'product_image'.DIRECTORY_SEPARATOR.$proPic_name;

                // move pictures of products
                move_uploaded_file($temp_name,$destinationFolder);
            }
        }
    }

    /**
     * generate random code for activate registration
     * @return string
     */
    private function verification_code() {
        $validChars = array(
            'a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z',
            '0','1','2','3','4','5','6','7','8','9',
            'A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        $validCharsCount = count($validChars);

        $strVerifyCode = '';
        for ($i=0; $i<=25; $i++) {
            $strVerifyCode .= $validChars[rand(0,$validCharsCount - 1)];
        }
        return $strVerifyCode;
    }

    /**
     * send verification code to registered account
     * @param $email
     * @param $code
     * @return bool
     */
    private function send_verificationCode($email,$code) {

        $to  = $email;

// subject
        $subject = 'Activation user profile';

// message
        $message = '
            <html>
                <body>
                    <h3 style="clear:both;display:block;border-bottom:solid 5px #5e91b0;direction:ltr;text-align:left;">Activation</h3>
                    <a href="'.RELA_DIR.'page/confirmAccount.php?verificationCode='.$code.'&user_email='.$email.'" style="direction:ltr;text-align:left;float:left;">Please click to activate.</a>
                </body>
            </html>
';

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'To: <'.$email.'>' . "\r\n";
        $headers .= 'From: worldbartermarket' . "\r\n";

        // Mail it
        mail($to, $subject, $message, $headers);

        return true;
    }

    /**
     * check admin exist
     * @return int
     */
    public function _checkUser() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_customer","customer_id,email","WHERE email = '". $this->_User['userEmail'] ."' AND password = '". sha1($this->_User['password']) ."' AND user_type = 0 LIMIT 1;");
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
                $_SESSION['userType'] = "normal";
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
     * get user point and set into session['userPoint']
     * @return bool|int
     */
    public function get_userPoint() {
        $point = 0;
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_users","point","WHERE username = '". $_SESSION['userName'] ."';");
            if($this->_result != 0) {
                foreach($this->_result[0] as $row) {
                    $point = $row->point;
                }
                return $point;
            } else {
                return 0;
            }
        } else {
            return false;
        }
    }

    /**
     * get user type for show something different for users
     * @return bool|int
     */
    public function get_userType() {
        $userType = 0;
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_users","sale_type","WHERE username = '". $_SESSION['userName'] ."';");
            if($this->_result != 0) {
                foreach($this->_result[0] as $row) {
                    $userType = $row->sale_type;
                }
                return $userType;
            } else {
                return 0;
            }
        } else {
            return false;
        }
    }

    public function get_userAccountNumber() {
        $userNumber = 0;
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_users","id","WHERE username = '". $_SESSION['userName'] ."';");
            if($this->_result != 0) {
                foreach($this->_result[0] as $row) {
                    $userNumber = $row->id;
                }
                return intval($userNumber)+1000000;
            } else {
                return 0;
            }
        } else {
            return false;
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
            return 0;

        /*$pics = "";
        $picCount = count($this->_User['userPicture']['name']);

        $imageType = '';
        $tmpFileLoc = $this->_User['userPicture']['tmp_name'];

        for($i=0;$i<=$picCount-1;$i++)
        {
            if (isset($this->_User['userPicture']) && !empty($this->_User['userPicture']['tmp_name'][$i]))
            {
                if (exif_imagetype($tmpFileLoc[$i]) == IMAGETYPE_GIF) {
                    $imageType  = '.gif';
                } elseIf (exif_imagetype($tmpFileLoc[$i]) == IMAGETYPE_JPEG) {
                    $imageType  = '.jpeg';
                } elseIf (exif_imagetype($tmpFileLoc[$i]) == IMAGETYPE_PNG) {
                    $imageType  = '.png';
                } elseIf (exif_imagetype($tmpFileLoc[$i]) == IMAGETYPE_BMP) {
                    $imageType  = '.bmp';
                }
            }

            $proPic_name = '('.$this->_User['userEmail'].'-'.($i+1).')'.$imageType;

            if($imageType == '')
            {
                $pics = "";
            } else {
                $pics .= $proPic_name.'|||';
            }
        }

        $code = $this->verification_code();*/

        if($this->_linkDB) {
            $userInfo = "'" .
                $this->_User['userEmail'] . "','" .
                sha1($this->_User['password'])."'";
            $this->_result = $this->_linkDB->insert("tbl_customer","email,password",$userInfo);
            /*if($this->_result == 1) {
                $this->save_profilePics($this->_User['userPicture']);
                $this->send_verificationCode($this->_User['userEmail'],$code);
            }*/
            return $this->_result;
        } else {
            return 0;
        }
    }

    /**
     * register normal user with few information
     * @return bool|int
     */
    public function register_normal() {
        $code = $this->verification_code();

        if($this->checkUserExist() != 1)
            return 0;
        if($this->_linkDB) {
            $userInfo = "'" .
                $this->_User['userEmail'] . "','" .
                sha1($this->_User['password']) . "'," .
                "2" . "," .
                "0" . "," .
                $this->_User['mobile'] . "," .
                "0" . ",'" .
                "-" . "','" .
                $this->_User['firstName']." ".$this->_User['lastName'] . "','".
                "-" . "',".
                $this->_User['gender'] . ",'".
                "-" . "','".
                "-" . "','".
                "-" . "','".
                "-" . "',".
                "0";
            $this->_result = $this->_linkDB->insert("tbl_users","username,password,sale_type,tel_number,phone_number,fax,address,store_name,manager_name,gender,profile_pic,town,description,gift,tel_required",$userInfo);
            if($this->_result == 1) {
                $this->send_verificationCode($this->_User['userEmail'],$code);
                return $this->_result;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

}