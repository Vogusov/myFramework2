<?php
require_once 'autoload.php';

try{
    App::init();
//    echo "initted";
}
catch (PDOException $e){
    echo "DB is not available";
    var_dump($e->getTrace());
}
catch (Exception $e){
    echo $e->getMessage();
}
