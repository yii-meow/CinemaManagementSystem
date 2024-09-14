<?php
//Dont change it plz
session_start();

require_once __DIR__ . '/../vendor/autoload.php';
require "../app/core/init.php";

DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

$app = new \App\core\App();
$app->loadController();
