<?php

require 'vendor/autoload.php';

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;


$path = array('src/App/Entity');
$devMode = true;

$config = Setup::createAnnotationMetadataConfiguration($path, $devMode);


$ini = parse_ini_file('config/local.ini');
$connectionOptions = array(
    'driver'   => $ini['driver'],
    'host'     => $ini['host'],
    'dbname'   => $ini['dbname'],
    'user'     => $ini['user'],
    'password' => $ini['password'],
);


$em = \Doctrine\ORM\EntityManager::create($connectionOptions, $config);

$helpers = new Symfony\Component\Console\Helper\HelperSet(array(
    'db' => new \Doctrine\DBAL\Tools\Console\Helper\ConnectionHelper($em->getConnection()),
    'em' => new \Doctrine\ORM\Tools\Console\Helper\EntityManagerHelper($em)
));