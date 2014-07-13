<?php
/**
 * Created by PhpStorm.
 * User: omid
 * Date: 5/16/14
 * Time: 9:14 PM
 */

class productAdmin
{

    private $_Product;
    private $_linkDB;
    private $_result;
    private $_brandName;

    /**
     * create object of product class
     */
    public function __construct() {
        $this->_Product = array (
            'proId'=>'',
            'proName'=>'',
            'proPrice'=>'',
            'proBrand'=>'',
            'proSize'=>'',
            'proColor'=>'',
            'proQuantity'=>'',
            'proType'=>'',
            'proPic'=>''
        );
        $this->_linkDB = new db();
        $this->_brandName = "";
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
        if(isset($temp[0]['size'])) {
            $this->_Product['proSize'] = $temp[0]['size'];
        } else {
            $this->_Product['proSize'] = "44";
        }
        if(isset($temp[0]['price'])) {
            $this->_Product['proPrice'] = $temp[0]['price'];
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

        /*echo "<pre>";
        print_r($this->_Product);die();*/
    }

    /**
     * get all user data
     * @return mixed
     */
    public function product_list() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_product p","p.product_id,p.name,p.size,p.price,p.quantity,p.color,p.pic_name,b.brand_name,t.type_name,p.status,p.creation_date","JOIN tbl_productType t JOIN tbl_brand b ON p.type_id = t.type_id AND p.brand_id = b.brand_id");
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
            $this->_result = $this->_linkDB->select("tbl_productType t","t.type_id,t.type_name, COUNT( p.view_count ) as count","LEFT JOIN tbl_product p ON p.type_id = t.type_id GROUP BY t.type_name");
            return $this->_result[0];
        } else {
            return 0;
        }
    }

    /**
     * get all product brand
     * @return int
     */
    public function get_productBrand() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_brand b","b.brand_id,b.brand_name");
            return $this->_result[0];
        } else {
            return 0;
        }
    }

    /**
     * get all product brand
     * @return int
     */
    public function get_productTypeName() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_productType t","t.type_name","WHERE t.type_id = ".$this->_Product['proType'].";");
            if($this->_result != 0) {
                foreach($this->_result[0] as $row) {
                    return $row->type_name;
                }
            }
        } else {
            return 0;
        }
    }

    /**
     * get all product type
     * @return int
     */
    public function get_productType() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_productType t","t.type_id,t.type_name");
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

        $proPic_name = "";
        $proPic_TypeName = $this->get_productTypeName();
        $myPics = "";


        for ($i=0 ; $i<$proCount ; $i++)
        {

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
            $myPics .= "///".$proPic_name;
            $temp_name = $this->_Product['proPic']['tmp_name'][$i];
            $destinationFolder = ROOT_DIR.'template'.DIRECTORY_SEPARATOR.'product_image'.DIRECTORY_SEPARATOR.$proPic_TypeName.DIRECTORY_SEPARATOR.$proPic_name;

            // move pictures of products
            move_uploaded_file($temp_name,$destinationFolder);

        }
        $insertQuery ="
            '{$this->_Product["proName"]}',
            '{$this->_Product["proBrand"]}',
            '{$this->_Product["proSize"]}',
            '{$this->_Product["proPrice"]}',
            '{$this->_Product["proQuantity"]}',
            '{$this->_Product["proColor"]}',
            '{$this->_Product["proType"]}',
            '{$myPics}'
        ";

        if($this->_linkDB) {
            $result = $this->_linkDB->insert("tbl_product","name, brand_id, size, price, quantity, color, type_id, pic_name",$insertQuery);
            return $result;
        } else {
            return 0;
        }
    }

    /**
     * get count of all products
     * @return int
     */
    public function report_getAllProducts() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_product","COUNT(product_id) as count");
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
     * get count of product quantity in inventory
     * @return int
     */
    public function report_getAllProductsQuantity() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_product","sum(quantity) as sum");
            if($this->_result != 0) {
                foreach($this->_result[0] as $row) {
                    return $row->sum;
                }
            }
        } else {
            return 0;
        }
    }

    /**
     * get count of purchased products
     * @return int
     */
    public function report_getAllProductsPurchased() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_sale","COUNT(distinct product_id) as count");
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
     * get count of all brands
     * @return int
     */
    public function report_getAllProductsBrands() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_brand","COUNT(brand_id) as count");
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
     * get max count of purchased brand
     * @return int
     */
    public function report_getmaxBrandsPurchased() {
        if($this->_linkDB) {
            $this->_result = $this->_linkDB->select("tbl_product","max(brand_id) as max","WHERE product_id in (select product_id from tbl_sale) group by brand_id");
            if($this->_result != 0) {
                foreach($this->_result[0] as $row) {
                    return $row->max;
                }
            }
        } else {
            return 0;
        }
    }

}