<?php

require './system/router.php';

$uri = explode('/', filter_var(rtrim(isset($_GET['url'])?  $_GET['url'] : null, '/'), FILTER_SANITIZE_URL));

$router =  new Router($uri);
$router->map();

$w = explode('_', $router->getController());
foreach ($w as $key => $value) {
   $w[$key] = ucfirst($value);
}

$classController     = implode('', $w) . 'Controller';
$classModel          = implode('', $w) . 'Model';
$controllerClassFile = './app/controllers/' . $classController. '.php';
$modelClassFile      = './app/models/'      . $classModel. '.php';

$id = $router->getId();
$method = strtolower($_SERVER['REQUEST_METHOD']);

if (file_exists($controllerClassFile)) {
  require $controllerClassFile;
	require $modelClassFile;
	require './system/database.php';

	$db = new Database('mysql:host=localhost;dbname=joey', 'root', 'root');
	$model = new $classModel($db);

	if($method === 'get' && !isset($id)) {
		$method = 'index';
	}

  $controller = new $classController($model);
  $controller->{$method}($id);

} else {
  echo 'api endpoint not supported';
}
