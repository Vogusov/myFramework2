<?php
//namespace Fw2;

require_once '../vendor/autoload.php';



try{
//  echo "HOHOHO";
  \Fw2\Lib\App::init();
    echo "initted";
}
catch (PDOException $e){
    echo "DB is not available";
    var_dump($e->getTrace());
}
catch (Exception $e){
//  echo "qqq";
    echo $e->getMessage();
}
