<?php
require_once "init.php";
use Libs\MyClass\Data;

$app->group('/v1',function() use ($app){
	$app->get('/products', function() use ($app) {
		$class = new Data();
	    $app->render(200,array("results"=>$class->get_all()));
	});
	$app->get('/products/:id',function($id) use ($app){
		$class = new Data();
		 $app->render(200,array("results"=>$class->get_by_id($id)));
	});
});
$app->run();