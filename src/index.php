<?php
use App\Entity\Product;

require '../vendor/autoload.php';


$productResource = new \App\Resource\ProductResource();

$app = new \Slim\Slim();

$app->get('/products(/(:id)(/))', function($id = null) use ($productResource) {
    $productResource->get($id);
});


$app->run();