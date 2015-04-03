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

    // POST, PUT, DELETE methods...
    // 
    // 
    
    /**
     * Create product
     */
    public function post()
    {
        $name = trim($this->getSlim()->request()->params('name'));
        $description = trim($this->getSlim()->request()->params('description'));
        if (empty($name) || empty($description) || $name === null || $description === null) {
            self::response(self::STATUS_BAD_REQUEST);
            return;
        }
        $user = $this->getUserService()->createUser($email, $password);
        self::response(self::STATUS_CREATED, array('user', $user));
    }
    

    public function put($id)
    {
        $app = \Slim\Slim::getInstance();

        $name = $app->request()->params('name');
        $email = $app->request()->params('email');

        // handle if $id is missing or $name or $email are valid etc.
        // return valid status code or throw an exception
        // depends on the concrete implementation

        /** @var User $user */
        $user = $this->getEntityManager()->find('App\Entity\User', $id);
        // also check if $user has been found else handle correctly

        $user->setEmail($email);
        $user->setName($name);

        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();

        return json_encode($this->convertToArray($user));
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