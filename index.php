<?php

require_once("vendor/autoload.php");
require_once("config.php");

use \Slim\Slim;

$app = new Slim();
$app->config("debug", true);
$app->get("/", function(){
	$page = new Page();
	$page->setTpl("index");
});

$app->run();

?>