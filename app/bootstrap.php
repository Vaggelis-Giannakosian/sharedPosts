<?php
//Load

require_once  'config/config.php';


//Auto load Core Libraries
spl_autoload_register(function($className){
    require_once 'libraries/'.$className.'.php';
});