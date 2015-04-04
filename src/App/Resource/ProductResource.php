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
        $name = $this->getSlim()->request()->params('name');
        $description = $this->getSlim()->request()->params('description');

        if (empty($name) || empty($description) || $name === null || $description === null) {
            self::response(self::STATUS_BAD_REQUEST);
            return;
        }

        $product = $this->getProductService()->createProduct($name, $description);
        self::response(self::STATUS_CREATED, array('product', $product));
    }

    

    public function put($id)
    {
        $name = $this->getSlim()->request()->params('name');
        $description = $this->getSlim()->request()->params('description');

        if (empty($name) || empty($description) || $name === null || $description === null) {
            self::response(self::STATUS_BAD_REQUEST);
            return;
        }


        $product = $this->getProductService()->updateProduct($id, $name, $description);
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





    private function convertToArray(Product $product) {
        return array(
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getEmail()
        );
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



}