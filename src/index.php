<?php
use App\Entity\Product;

require '../vendor/autoload.php';


$productResource = new \App\Resource\ProductResource();

$app = \Slim\Slim::getInstance();

$app->get('/products(/(:id)(/))', function($id = null) use ($productResource) {
    $productResource->get($id);
});



// Post
$app->post('/products', function() use ($productResource){
        	$productResource->post();
});


$app->run();