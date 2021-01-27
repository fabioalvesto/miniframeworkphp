<?php
class DB {
  private $mysqli = null;
  
  public function __construct($config) {
    try {
      @$mysqli = new mysqli(
        $config["host"], 
        $config["username"], 
        $config["password"], 
        $config["db"]
      );

      if ($mysqli->connect_error) {
        $this->debug()->error($mysqli->connect_error);        
      }

      $this->mysqli = $mysqli;
    } catch(Exception $e) {
        echo $e->getMessage();
    }
  }

  public function debug() {
    require_once __DIR__. '/../Debug.php';
    return new Debug();
  }

  public function qr($sql) {
    return $this->mysqli->query($sql);
  }

}