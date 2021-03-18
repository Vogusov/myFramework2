<?php
session_start();

require_once __DIR__ . '/vendor/autoload.php';


try {
 \Fw2\Core\Router::init();

} catch (PDOException $e) {

  echo "<br>DB is not available<br>";
  echo $e->getMessage();
//  var_dump($e->getMessage());

} catch (Exception $e) {
  echo $e->getMessage();
}
