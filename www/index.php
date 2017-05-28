<?php
session_start();

if(!isset($_SESSION['cart'])){
    $_SESSION['cart'] = array();
}

if(!isset($_SESSION['user'])){
    $_SESSION['user'] = array();
}

//    echo dump($_SESSION);

//Подключаем файлы
include_once '../config/config.php'; //Настройки
include_once "../config/db.php"; //подключение к базе данных
include_once '../library/mainFunction.php'; //файл основных функций

//Определяем какой контролер будет работать
$controllerName = isset($_GET['controller'])?ucfirst($_GET['controller']):'Index';

//Определяем какой контролер будет работать
$actionName = isset($_GET['action'])?ucfirst($_GET['action']):'Index';
$smarty->assign('cartCntItems', count($_SESSION['cart']));
loadPage($smarty, $controllerName, $actionName);

dbDisconnect();