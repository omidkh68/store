<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 5/16/14
 * Time: 9:14 PM
 */

class product
{

    private $_Product;
    private $_linkDB;
    private $_result;

    /**
     * create object of product class
     */
    public function __construct() {
        $this->_Product = array (
            'proId'=>'',
            'proName'=>'',
            'proPrice'=>'',
            'proBrand'=>'',
            'proColor'=>'',
            'proQuantity'=>'',
            'proType'=>'',
            'proPic'=>''
        );
        $this->_linkDB = new db();
    }

    /**
     * setter switcher
     * @param $field
     * @param $value
     */
    public function __set($field, $value) {
        switch ($field)
        {
            case "productInfo":
                $this->_set_product($value);
                break;


            default:

        }
    }

    /**
     * set id of product for show single product
     */
    private function _set_product() {
        $temp = func_get_args();

        if(isset($temp[0]['product_id']) && is_numeric($temp[0]['product_id'])) {
            $this->_Product['proId'] = strtolower($temp[0]['product_id']);
        }
        if(isset($temp[0]['product_name'])) {
            $this->_Product['proName'] = $temp[0]['product_name'];
        } else {
            $this->_Product['proName'] = "-";
        }
        if(isset($temp[0]['price'])) {
            $this->_Product['proPrice'] = $temp[0]['main_price'];
        } else {
            $this->_Product['proPrice'] = "1";
        }
        if(isset($temp[0]['color'])) {
            $this->_Product['proColor'] = $temp[0]['color'];
        } else {
            $this->_Product['proColor'] = "-";
        }
        if(isset($temp[0]['brand'])) {
            $this->_Product['proBrand'] = $temp[0]['brand'];
        } else {
            $this->_Product['proBrand'] = 1;
        }
        if(isset($temp[0]['mincount']) && is_numeric($temp[0]['mincount']) && $temp[0]['mincount'] >= 1) {
            $this->_Product['proQuantity'] = $temp[0]['mincount'];
        } else {
            $this->_Product['proQuantity'] = 1;
        }
        if(isset($temp[0]['type'])) {
            $this->_Product['proType'] = $temp[0]['type'];
        } else {
            $this->_Product['proType'] = 1;
        }
        if(isset($temp[0]['product_pic'])) {
            $this->_Product['proPic'] = $temp[0]['product_pic'];
        }
    }

    /**
     * get all product data
     * @return mixed
     */
    public function product_list() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_product p","p.product_id as id,p.name,p.size,p.price,p.color,b.brand_name as brand,t.type_name as type,p.status,p.pic_name","join tbl_brand b join tbl_productType t WHERE p.type_id = t.type_id AND p.brand_id = b.brand_id;");
            return $this->_result[0];
        } else {
            return 0;
        }
    }

    /**
     * get all product data for home page
     * @return mixed
     */
    public function product_list_home() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_product p","p.product_id as id,p.name,p.size,p.price,p.color,b.brand_name as brand,t.type_name as type,p.status,p.pic_name","join tbl_brand b join tbl_productType t WHERE p.type_id = t.type_id AND p.brand_id = b.brand_id ORDER BY RAND() LIMIT 3;");
            return $this->_result[0];
        } else {
            return 0;
        }
    }

    /**
     * include single product with details
     */
    public function getProduct_detail() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_product p","p.product_id as id,p.name,p.size,p.price,p.color,b.brand_name as brand,t.type_name as type,p.status,p.pic_name","join tbl_brand b join tbl_productType t WHERE p.type_id = t.type_id AND p.brand_id = b.brand_id AND product_id = ".$this->_Product['proId'].";");
            return $this->_result[0];
        } else {
            return 0;
        }
    }

    /**
     * include single product with details
     */
    public function getProduct_detail_withCat() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_product p","p.product_id as id,p.name,p.size,p.price,p.color,b.brand_name as brand,t.type_name as type,p.status,p.pic_name","join tbl_brand b join tbl_productType t WHERE p.type_id = t.type_id AND p.brand_id = b.brand_id AND t.type_id = ".$this->_Product['proType'].";");
            return $this->_result[0];
        } else {
            return 0;
        }
    }

    /**
     * get all full service for fill register form
     * @return int
     */
    public function getProductTypeName() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_productType t","t.type_id,t.type_name, COUNT( p.view_count ) as count","LEFT JOIN tbl_product p ON p.type_id = t.type_id
GROUP BY t.type_name");
            return $this->_result[0];
        } else {
            return 0;
        }
    }

    /**
     * register products of user
     * @return int
     */
    public function register() {
        $proCount = count($this->_Product['proPic']['name']);//die();
        $tmpFileLoc = "";

        if($this->_Product['proPic']['tmp_name'] != "") {
            $tmpFileLoc = $this->_Product['proPic']['tmp_name'];
        } else {
            $tmpFileLoc = "default.jpeg";
        }

        $pic_create_date = date('Y-m-d_H-i-s');

        $insertQuery = "";
        for ($i=0 ; $i<$proCount ; $i++)
        {
            $insertQuery .= "(";

            // detect type of image for saving image with default file type
            $imageType = '';

            if (exif_imagetype($tmpFileLoc[$i]) == IMAGETYPE_GIF) {
                $imageType  = '.gif';
            } elseIf (exif_imagetype($tmpFileLoc[$i]) == IMAGETYPE_JPEG) {
                $imageType  = '.jpeg';
            } elseIf (exif_imagetype($tmpFileLoc[$i]) == IMAGETYPE_PNG) {
                $imageType  = '.png';
            } elseIf (exif_imagetype($tmpFileLoc[$i]) == IMAGETYPE_BMP) {
                $imageType  = '.bmp';
            }

            if($imageType == '')
                $imageType = 'default.jpeg';

            // set name of saved picture of products
            $proPic_name = '('.$this->_Product["proName"][$i].'['.$pic_create_date.'])'.$imageType;
            $temp_name = $this->_Product['proPic']['tmp_name'][$i];
            $destinationFolder = ROOT_DIR.'template'.DIRECTORY_SEPARATOR.'product_image'.DIRECTORY_SEPARATOR.$proPic_name;

            // move pictures of products
            move_uploaded_file($temp_name,$destinationFolder);

            // check if sale type is half $proMincount = 0
            $proMinCount = 0;
            if($this->_Product["proMincount"] != 0) {
                $proMinCount = $this->_Product["proMincount"][$i];
            }

            $insertQuery .="
                            '{$this->_Product["proName"][$i]}',
                            '{$this->_Product["proPrice"][$i]}',
                            '{$this->_Product["proDiscount"][$i]}',
                            '{$proMinCount}',
                            '{$this->_Product["proPoint"][$i]}',
                            '{$proPic_name}',
                        ";
            $insertQuery .= "'{$this->_Product['proUser']}','{$this->_Product['proType']}'";

            if($i == $proCount-1){
                $insertQuery .= ")";
            } else {
                $insertQuery .= "),";
            }

        }
        $insertQuery .= ";";

        if($this->_linkDB) {
            $result = $this->_linkDB->bulkInsert("tbl_product","product_name, product_price, product_discount, product_mincount, product_point, product_pic, product_user, product_type",$insertQuery);
            return $result;
        } else {
            return 0;
        }
    }

}