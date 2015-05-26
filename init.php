<?php
/* init.php */
/* Load the composer autoloader into your application. */
$classloader = require_once "vendor/autoload.php";
$classloader->addPsr4('Libs\\MyClass\\', __DIR__."/libs/classes");
use Slim\Slim;
use \JsonApiView;
use \JsonApiMiddleware;
use Libs\MyClass\Session;

define("BASE_DIR", __DIR__."/");

/* check old session existing */
if (isset($_REQUEST['sid']) && strlen($_REQUEST['sid']) > 0) {
	Session::initialize($_REQUEST['sid']);
}else{
	Session::initialize();
}


/* Create Slim instance */
$app = new Slim();

/* Add json view */
$app->view(new JsonApiView());
$app->add(new JsonApiMiddleware());

