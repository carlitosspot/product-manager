<?php

namespace App;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;

abstract class AbstractResource
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager = null;

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
}