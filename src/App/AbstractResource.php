<?php

namespace App;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Slim\Slim;


abstract class AbstractResource
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager = null;


    /**
     * @var \Slim\Slim
     */
    private $slim = null;



    /**
     * Construct
     */
    public function __construct()
    {
        $this->setSlim(Slim::getInstance());
    }





    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if ($this->entityManager === null) {
            $this->entityManager = $this->createEntityManager();
        }

        return $this->entityManager;
    }

    /**
     * @return EntityManager
     */
    public function createEntityManager()
    {
        $path = array('srs/App/Entity');
        $devMode = true;

        $config = Setup::createAnnotationMetadataConfiguration($path, $devMode);

        // define credentials
        $ini = parse_ini_file(__DIR__ . '/../../config/local.ini');
        $connectionOptions = array(
            'driver'   => $ini['driver'],
            'host'     => $ini['host'],
            'dbname'   => $ini['dbname'],
            'user'     => $ini['user'],
            'password' => $ini['password'],
        );

        return EntityManager::create($connectionOptions, $config);
    }


    /**
     * @return \Slim\Slim
     */
    public function getSlim()
    {
        return $this->slim;
    }



    /**
     * @param \Slim\Slim $slim
     */
    public function setSlim($slim)
    {
        $this->slim = $slim;
    }
}