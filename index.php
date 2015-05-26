<?php
require_once "init.php";
use slim\slim;
use Libs\MyClass\Data;
use Libs\MyClass\Authen;
use Libs\MyClass\Session;

$authen = function($route){
	$app = Slim::getInstance();
	Session::initialize();
	$auth = new Authen();

	if (!$auth->isLogin()) {
		$app->redirect("/denied");
	}
};
$app->get("/denied",function() use ($app){
	$app->render(400,array("msg"=>"Permission denied","error"=>true));
});
$app->get("/login",function() use ($app){
	$username = $app->request->params('u');
	$password = $app->request->params('p');
	$class = new Authen();
	if($class->Login($username,$password)){
		$app->render(200,array("msg"=>"Login successful","sid"=>$class->token));
	}else{
		$app->render(200,array("error"=>true,"msg"=>$class->error));
	}
});
$app->get("/logout",function() use ($app) {
	Session::initialize();
	Session::closeSession();
	$app->render(200,array("msg"=>"Logout successful"));
});


$app->group('/v1',$authen,function() use ($app){
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