<?php
use App\Entity\Product;

require '../vendor/autoload.php';


$app = new \Slim\Slim();

$productResource = new \App\Resource\ProductResource();


// Get
$app->get('/products(/(:id)(/))', function($id = null) use ($productResource) {
    $productResource->get($id);
});


// Post
$app->post('/products', function() use ($productResource){
   	$productResource->post();
});


// Put
$app->put('/products/:id(/)', function($id = null) use ($productResource) {
    $productResource->put($id);
});


// Put
$app->delete('/products/:id(/)', function($id = null) use ($productResource) {
    $productResource->delete($id);
});


$app->run();