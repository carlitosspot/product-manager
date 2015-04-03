<?php
use App\Entity\User;

require '../vendor/autoload.php';


$userResource = new \App\Resource\UserResource();

$app = new \Slim\Slim();

$app->get('/users(/(:id)(/))', function($id = null) use ($userResource) {
    echo $userResource->get($id);
});


$app->run();