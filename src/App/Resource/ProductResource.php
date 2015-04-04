<?php

namespace App\Resource;

use App\AbstractResource;
use App\Service\Product as ProductService;

/**
 * Class Resource
 * @package App
 */
class ProductResource extends AbstractResource
{


    private $productService = null;
    


    /**
     * Get Product service
     */
    public function init()
    {
        $this->setProductService(new ProductService($this->getEntityManager()));
    }




    /**
     * @param $id
     *
     * @return string
     */
    public function get($id)
    {

        if ($id === null) {
            $data = $this->getProductService()->getProducts();
        } else {
            $data = $this->getProductService()->getProduct($id);
        }

        if ($data === null) {
            self::response(self::STATUS_NOT_FOUND);
            return;
        }

        $response = array('product' => $data);
        self::response(self::STATUS_OK, $response);
    }

    

    /**
     * Create Product
     */
    public function post()
    {
        // closure to convert string into a
        // PHP boolean
        $getBoolean = function($value){
            // value shoud be string TRUE/FALSE/true/false
            $value = mb_strtolower(trim($value));
            if($value == 'true')
                return true;
            if($value == 'false')
                return false;
            else
                throw new \Exception('unknow value: '.$value);
        };

       try {
            $name = $this->requireParmeter($this->getSlim()->request()->params('name'), 'name');
            $description = $this->requireParmeter($this->getSlim()->request()->params('description'), 'description');
            $price = $this->requireParmeter($this->getSlim()->request()->params('price'), 'price');
            $inStock = $getBoolean($this->getSlim()->request()->params('in_stock'));           
       } catch ( \Exception $e) {
            self::response(self::STATUS_BAD_REQUEST);
            return;
       }

        $product = $this->getProductService()->createProduct($name, $description, $price, $inStock);
        self::response(self::STATUS_CREATED, array('product', $product));
    }

    

    public function put($id)
    {
        // closure to convert string into a
        // PHP boolean
        $getBoolean = function($value){
            // value shoud be string TRUE/FALSE/true/false
            $value = mb_strtolower(trim($value));
            if($value == 'true')
                return true;
            if($value == 'false')
                return false;
            else
                throw new \Exception('unknow value: '.$value);
        };

       try {
            $name = $this->requireParmeter($this->getSlim()->request()->params('name'), 'name');
            $description = $this->requireParmeter($this->getSlim()->request()->params('description'), 'description');
            $price = $this->requireParmeter($this->getSlim()->request()->params('price'), 'price');
            $inStock = $getBoolean($this->getSlim()->request()->params('in_stock'));           
       } catch ( \Exception $e) {
            self::response(self::STATUS_BAD_REQUEST);
            return;
       }


       $product = $this->getProductService()->updateProduct($id, $name, $description, $price, $inStock);
        if ($product === null) {
            self::response(self::STATUS_NOT_IMPLEMENTED);
            return;
        }
        self::response(self::STATUS_NO_CONTENT);
    }



     /**
     * @param $id
     */
    public function delete($id)
    {
        $status = $this->getProductService()->deleteProduct($id);
        if ($status === false) {
            self::response(self::STATUS_NOT_FOUND);
            return;
        }
        self::response(self::STATUS_OK);
    }



    /**
     * @return \App\Service\Product
     */
    public function getProductService()
    {
        return $this->productService;
    }




    /**
     * @param \App\Service\Product $productService
     */
    public function setProductService($productService)
    {
        $this->productService = $productService;
    }



    private function requireParmeter($param, $name)
    {
        if (empty($param) || $param === null) {
            throw new \Exception("Invalid value given for parameter ".$name);
        }else{
            return $param;
        }
            
    }



}