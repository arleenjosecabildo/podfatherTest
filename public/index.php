<?php
require_once '../app/Libraries/Autoload.php';
use app\Controllers\IndexController;

$indexController = new IndexController();
$indexController->run();