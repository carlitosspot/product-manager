<?php

namespace App\Service;
use App\AbstractService;
use App\Entity\Product as ProductEntity;

class Product extends AbstractService
{
    

    /**
     * @param $id
     * @return object
     */
    public function getProduct($id)
    {
        /**
         * @var \App\Entity\Product $product
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\Product');
        $product = $repository->find($id);
        if ($product === null) {
            return null;
        }
        return array(
             'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getEmail()
        );
    }




    /**
     * @return array|null
     */
    public function getProducts()
    {
        $repository = $this->getEntityManager()->getRepository('App\Entity\Product');
        $products = $repository->findAll();
        if (empty($products)) {
            return null;
        }


        /**
         * @var \App\Entity\Product $product
         */
        $data = array();
        foreach ($products as $product)
        {
            $data[] = array(
                'id' => $product->getId(),
            	'name' => $product->getName(),
            	'description' => $product->getEmail()
            );
        }
        return $data;
    }



    /**
     * @param $email
     * @param $password
     * @return array
     */
    public function createProduct($name, $description)
    {
        $product = new ProductEntity();
        $product->setName($name);
        $product->setDescription($description);
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
        return array(
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getEmail()
        );
    }





    
    /**
     * @param $id
     * @param $email
     * @param $password
     * @return array|null
     */
    public function updateUser($id, $email, $password)
    {
        /**
         * @var \App\Entity\User $user
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\User');
        $user = $repository->find($id);
        if ($user === null) {
            return null;
        }
        $user->setEmail($email);
        $user->setPassword($password);
        $user->setUpdated(new \DateTime());
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
        return array(
            'id' => $user->getId(),
            'created' => $user->getCreated(),
            'updated' => $user->getUpdated(),
            'email' => $user->getEmail()
        );
    }
    public function deleteUser($id)
    {
        /**
         * @var \App\Entity\User $user
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\User');
        $user = $repository->find($id);
        if ($user === null) {
            return false;
        }
        $this->getEntityManager()->remove($user);
        $this->getEntityManager()->flush();
        return true;
    }
}