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
         * @return array|null
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\Product');
        $product = $repository->find($id);
        if ($product === null) {
            return null;
        }
        return array(
             'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription()
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
            	'description' => $product->getDescription()
            );
        }
        return $data;
    }



    /**
     * @param $name
     * @param $description
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
            'description' => $product->getDescription()
        );
    }





    
    /**
     * @param $id
     * @param $name
     * @param $description
     * @return array|null
     */
    public function updateProduct($id, $name, $description)
    {
        /**
         * @var \App\Entity\Product $product
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\Product');
        $product = $repository->find($id);
        if ($product === null) {
            return null;
        }

        $product->setName($name);
        $product->setDescription($description);
        // $product->setUpdated(new \DateTime());
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
        return array(
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
        );
    }



    /**
     * @param $id
     * 
     * */
    public function deleteProduct($id)
    {
        /**
         * @var \App\Entity\Product $product
         */
        $repository = $this->getEntityManager()->getRepository('App\Entity\Product');
        $product = $repository->find($id);
        if ($product === null) {
            return false;
        }

        $this->getEntityManager()->remove($product);
        $this->getEntityManager()->flush();
        return true;
    }
}