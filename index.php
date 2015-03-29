<?php
require "vendor/autoload.php";

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('./views/templates');
$twig = new Twig_Environment($loader, array(
#    'cache' => './tmp/cache',  # turned off for development purposes
));
session_cache_limiter(false);
session_start();
$app = new \Slim\Slim();

$app->get('/', function () use ($app, $twig) {	
  $template = $twig->loadTemplate('Homepage.phtml');
});

$app->run();
