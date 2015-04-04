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
        
        return $this->convertToArray($product);
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
            $data[] = $this->convertToArray($product);
        }
        return $data;
    }



    /**
     * @param $name
     * @param $description
     * @return array
     */
    public function createProduct($name, $description, $price, $inStock)
    {
        $product = new ProductEntity();
        $product->setName($name);
        $product->setDescription($description);
        $product->setPrice($price);
        $product->setInStock($inStock);
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
        
        return $this->convertToArray($product);
    }





    
    /**
     * @param $id
     * @param $name
     * @param $description
     * @return array|null
     */
    public function updateProduct($id, $name, $description, $price, $inStock)
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
        $product->setPrice($price);
        $product->setInStock($inStock);
        $this->getEntityManager()->persist($product);
        $this->getEntityManager()->flush();
        
        return $this->convertToArray($product);
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



    private function convertToArray(ProductEntity $product) {
        return array(
            'id' => $product->getId(),
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice(),
            'in_stock' => $product->getInStock(),
        );
    }
}