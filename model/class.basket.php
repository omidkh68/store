<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 7/4/14 AD
 * Time: 19:29
 */

class basket
{

    private $_productID;
    private $_productIdArr;
    private $_userID;
    private $_quantity;
    private $_quantityArr;
    private $_price;
    private $_linkDB;
    private $_basketID;

    public function __construct() {
        $this->_productID = 0;
        $this->_userID = $this->getUserId();
        $this->_quantity = 0;
        $this->_price = 0;
        $this->_basketID = 0;
        $this->_linkDB = new db();
        $this->_productIdArr = array();
        $this->_quantityArr = array();
        return true;
    }

    /**
     * setter switcher
     * @param $field
     * @param $value
     */
    public function __set($field, $value) {
        switch ($field)
        {
            case "addToBasket":
                $this->_set_basket($value);
                break;

        }
    }

    /**
     * check if product is in the basket with current user
     * @return bool|int
     */
    private function checkExistInBasket() {
        $exist = 0;
        if($this->_linkDB) {
            $result = $this->_linkDB->select("tbl_basket","COUNT(pro_id) as count","where pro_id = ".$this->_productID." AND user_id = ".$this->_userID." AND status<>-1;");
            foreach($result[0] as $row) {
                $exist = $row->count;
            }
            if($exist != 0) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return false;
        }
    }

    /**
     * get price of get product
     * @return bool|int
     */
    private function getProductPrice() {
        if($this->_linkDB) {

            $result = $this->_linkDB->select("tbl_product p","price","WHERE product_id = ".$this->_productID.";");
            foreach($result[0] as $row) {
                $this->_price = $row->price;
            }

        }
    }

    /**
     * get userid of current user
     * @return int
     */
    private function getUserId() {
        $userSession = (isset($_SESSION['userName'])?$_SESSION['userName']:"");
        $user = new user();
        return $user->get_userID($userSession);
    }

    /**
     * set user info
     */
    private function _set_basket() {
        $temp = func_get_args();

        /*echo "<pre>";
        print_r($temp[0]['prod']);die();*/

        if(isset($temp[0]['prod'])) {

            foreach($temp[0]['prod'] as $key=>$value) {
                //echo "[Key] : ".$key." -> ";
                //echo "[Value] : ".$value."<br>";
                $this->_productIdArr[] = $key;
                $this->_quantityArr[$key] = $value;
            }
        }
        //echo "<pre>";print_r($this->_quantityArr);die();

        if(isset($temp[0]['product_id']) && is_numeric($temp[0]['product_id'])) {
            $this->_productID = $temp[0]['product_id'];
        }
        if(isset($temp[0]['quantity']) && is_numeric($temp[0]['quantity'])) {
            if($temp[0]['quantity'] > 20) {
                $this->_quantity = 20;
            } else {
                $this->_quantity = $temp[0]['quantity'];
            }
            if($temp[0]['quantity'] < 1) {
                $this->_quantity = 1;
            } else {
                $this->_quantity = $temp[0]['quantity'];
            }
        }
        if(isset($temp[0]['basket_id']) && is_numeric($temp[0]['basket_id'])) {
            $this->_basketID = $temp[0]['basket_id'];
        }
    }

    /**
     * add product to basket
     * @return int
     */
    public function addBasket() {
        if($this->_linkDB) {

            $this->getProductPrice();

            $this->_userID = $this->getUserId();

            if(!$this->checkExistInBasket()) {
                $this->_linkDB->insert("tbl_basket","pro_id,user_id,quantity,price",$this->_productID.",".$this->_userID.",".$this->_quantity.",".$this->_price);
            } else {
                $_SESSION["basketExist"] = 1;
            }
            return 1;

        } else {
            return 0;
        }
    }

    /**
     * get product of in the basket with current user
     * @return bool
     */
    public function getBasket() {
        if($this->_linkDB) {
            $result = $this->_linkDB->select("tbl_basket b","b.pro_id,b.id,b.user_id,b.quantity,b.price,p.name,p.pic_name,br.brand_name AS brand,c.name as customer_name,c.email as customer_email,t.type_name as type","JOIN tbl_product p JOIN tbl_productType t JOIN tbl_brand br JOIN tbl_customer c WHERE b.pro_id = p.product_id AND p.brand_id = br.brand_id AND b.user_id = c.customer_id AND p.type_id = t.type_id AND b.user_id = ".$this->_userID." AND b.status<>-1;");
            return $result[0];
        } else {
            return false;
        }
    }

    /**
     * delete custom product from basket of current user
     * @return bool
     */
    public function deleteBasket() {
        if($this->_linkDB) {
            $this->_linkDB->delete("tbl_basket","id = ".$this->_basketID.";");
            $_SESSION["basketDelete"] = 1;
            return true;
        } else {
            return false;
        }
    }

    /**
     * get price with custom product id
     * @param $proID
     * @return bool|int
     */
    private function getProductFullPrice($proID) {
        if($this->_linkDB) {

            $result = $this->_linkDB->select("tbl_product p","price","WHERE product_id = ".$proID.";");
            foreach($result[0] as $row) {
                $this->_price = $row->price;
            }
            return $this->_price;

        } else {
            return false;
        }
    }

    /**
     * confirm purchase function
     * @return bool
     */
    public function confirmBuy() {
        $this->_userID = $this->getUserId();
        $price = 0;
        $quantity = 0;
        $totalCash = 0;
        $finalCash = 0;

        foreach($this->_productIdArr as $key=>$proID) {
            $price = $this->getProductFullPrice($proID);
            $quantity = $this->_quantityArr[$proID];
            $totalCash = ($this->getProductFullPrice($proID)*$this->_quantityArr[$proID]);
            $finalCash += $totalCash;
            /*echo '[user] : '.$this->_userID
                .'->[pro] : '.$proID
                .'->[price] : '.$price
                .'->[quantity] : '.$quantity
                .'->[Total Cash] : '.$totalCash."<br>";

            echo "final Cash = ".$finalCash;*/

            if($this->_linkDB) {
                $this->_linkDB->insert("tbl_sale","product_id,customer_id,price,quantity,total_cash",$proID.",".$this->_userID.",".$price.",".$quantity.",".$totalCash);
                $this->_linkDB->update("tbl_basket","status=-1","WHERE user_id = ".$this->_userID.";");
                $_SESSION['successTransaction'] = "1";
                return true;
            } else {
                return false;
            }
        }
        return false;
    }

    /**
     * get all purchased product for current user
     * @return bool
     */
    public function getAllPurchaseProduct() {
        if($this->_linkDB) {
            $this->_userID = $this->getUserId();

            $result = $this->_linkDB->select("tbl_sale s","s.price,s.quantity,s.total_cash,s.status,s.payment_status,s.order_date,s.delivery_date,s.product_id as pro_id,p.name,p.pic_name,c.name as customer_name,c.email as customer_email,b.brand_name as brand,t.type_name as type","JOIN tbl_product p JOIN tbl_customer c JOIN tbl_brand b JOIN tbl_productType t WHERE p.type_id = t.type_id AND s.product_id = p.product_id AND s.customer_id = c.customer_id AND p.brand_id = b.brand_id AND s.customer_id = ".$this->_userID.";");
            return $result[0];
        } else {
            return false;
        }
    }

}