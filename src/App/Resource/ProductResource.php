<?php

namespace App\Resource;

use App\AbstractResource;
use App\Entity\Product;

/**
 * Class Resource
 * @package App
 */
class ProductResource extends AbstractResource
{

    /**
     * @param $id
     *
     * @return string
     */
    public function get($id)
    {
        if ($id === null) {
            $products = $this->getEntityManager()->getRepository('App\Entity\Product')->findAll();
            $products = array_map(function($product) {
                                    return $this->convertToArray($product); },
                                    $products);
            //$data = json_encode($products);
        } else {
            $data = $this->convertToArray($this->getEntityManager()->find('App\Entity\Product', $id));
        }

        // @TODO handle correct status when no data is found...

        return json_encode($data);
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
}