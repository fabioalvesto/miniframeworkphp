<?php
class Main {
  private $config = array(
    "dirApp" => "",
    "fileRoutes" => "",
    "routeDefault" => "",
    "routeCurrent" => "",
    "database" => "",
  );

  public function __construct($config) {
    $this->config = (object) $config;
    $this->getRoutes();
  }

  public function getRoutes() {
    $config = $this->config;

    foreach ($config as $key => $value) {
      ${$key} = $value;
    }

    if (empty($fileRoutes) || !file_exists($fileRoutes)) {
      $this->debug()->error("Por favor, informe um arquivo de rota padrão para o Main.");
    }
    
    if (empty($dirApp) || !is_dir($dirApp)) {
      $this->debug()->error("Informe um diretório padrão para o projeto.");
    }

    $routesSetted = include $fileRoutes;

    //check if exists route setted
    if (isset($routesSetted[$routeCurrent])) {
      $route = "{$dirApp}/{$routesSetted[$routeCurrent]}";
    } else 
    
    //check if exists route current
    if (isset($routeCurrent) && !empty($routeCurrent)) {
      $route = "{$dirApp}/{$routeCurrent}.php";
    } else 
    
    //check if exists route default
    if (!isset($routeDefault) && empty($routeCurrent)) { 
      $route = "{$dirApp}/index.php";
    } else 
    
    //check if exists index
    if (isset($routeDefault) && empty($routeCurrent)) {      
      $route = "{$dirApp}/{$routeDefault}.php";
    }

    if (file_exists($route)) {
      include __DIR__.'/Helpers.php';
      return include $route;
    } else {
      die("404");
    }
  }

  public function debug() {
    require_once __DIR__. '/Debug.php';
    return new Debug();
  }

  public function getPathDir($other) {
    return "{$this->config->dirApp}{$other}";
  }

 
  private function getDataBase() {
    if (!isset($this->config->database)) {
      return false;
    }

    if (!file_exists($this->config->database)) {
      $this->debug()->error("O arquivo <b>database: {$this->config->database}</b> não existe.");
    }

    include __DIR__."/DB/DB.php";
    $databaseConfig = include $this->config->database;
    return new DB($databaseConfig);
  }

  public function db() {
    return $this->getDataBase();
  }
}