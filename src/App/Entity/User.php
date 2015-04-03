<?php

namespace App\Entity;

use App\Entity;
use Doctrine\ORM\Mapping;

/**
 * @Entity
 * @Table(name="users")
 */
class User
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
    protected $email;

    // Define setters/getters for all properties...
    // 



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
    public function getEmail()
    {
        return $this->email;
    }


    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }



    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }



    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = md5($password);
    }

}