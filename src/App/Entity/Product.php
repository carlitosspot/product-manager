<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="products")
 */
class Product
{
    /**
     * @var integer
     *
     * @Id
     * @Column(name="id", type="integer")
     * @GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @Column(type="string", length=64)
     */
    protected $name;

    /**
     * @var string
     * @Column(type="string", length=255)
     */
    protected $description;

   /**
     * @var float
     * @Column(type="float")
     */
    protected $price;


   /**
     * @var boolean
     * @Column(name="in_stock", type="boolean")
     */
    protected $inStock;






    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }    



    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }



    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }



    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }


    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }



    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }



    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }



    /**
     * @return boolean
     */
    public function getInStock()
    {
        return $this->inStock;
    }



    /**
     * @param boolean $inStock
     */
    public function setInStock($inStock)
    {
        $this->inStock = $inStock;
    }

}