<?php
class Debug {
  public function error($msg) {
    throw new Exception("<b>Error:</b> {$msg}");
  }
}