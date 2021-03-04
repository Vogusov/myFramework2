<?php
//namespace Fw2;

require_once __DIR__ . '/vendor/autoload.php';
//require_once __DIR__ . '/lib/App.php';


try {

 \Fw2\Base\App::init();
  echo "initted";

} catch (PDOException $e) {
  echo "DB is not available";
  var_dump($e->getTrace());

} catch (Exception $e) {
  echo $e->getMessage();
}
