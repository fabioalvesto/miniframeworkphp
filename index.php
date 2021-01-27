<?php

error_reporting(E_ALL);
 
/* Habilita a exibição de erros */
ini_set("display_errors", 1);

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__. '/main/Main.php';

$main = new Main(
  array(
    "dirApp" => "app",
    "routeDefault" => "login",
    "routeCurrent" => !empty($_GET['route']) ? $_GET['route'] : "",
    "fileRoutes" => "configs/routes.php",
    "database" => "configs/database.php",
  )
);
