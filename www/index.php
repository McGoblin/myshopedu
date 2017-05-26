<?php
    //Подключаем файлы
    include_once '../config/config.php'; //Настройки
    include_once "../config/db.php"; //подключение к базе данных
    include_once '../library/mainFunction.php'; //файл основных функций

    //Определяем какой контролер будет работать
    $controllerName = isset($_GET['controller'])?ucfirst($_GET['controller']):'Index';

    //Определяем какой контролер будет работать
    $actionName = isset($_GET['action'])?ucfirst($_GET['action']):'Index';

    loadPage($smarty, $controllerName, $actionName);

    dbDisconnect();