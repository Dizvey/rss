<?php

//require_once('./vendor/autoload.php');
spl_autoload_register(function ($className) {
    $className = str_replace('\\', '/', $className);
    $path = './';
    if (file_exists($path . $className . '.php'))
        require_once $path . $className . '.php';
});


$test = new Test();

$test->run();