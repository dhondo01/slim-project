<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
spl_autoload_register(function ($classname) {
	require ("../classes/" . $classname . ".php");
});

$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host'] = "localhost";
$config['db']['user'] = "user";
$config['db']['pass'] = "password";
$config['db']['dbname'] = "exampleapp";

$app = new \Slim\App(["settings" => $config]);
$container = $app->getContainer();

$app->get('/hello/{name}', function (Request $request, Response $response) {
	$name = $request->getAttribute('name');
	$myName = ucfirst($name);
	$response->getBody()->write("Hello, $myName!");

	return $response;
	});

$app->run();