<?php

require_once __DIR__ . '/vendor/autoload.php';


try {

 \Fw2\Core\Router::init();

} catch (PDOException $e) {
  echo "DB is not available";
  var_dump($e->getTrace());

} catch (Exception $e) {
  echo $e->getMessage();
}
