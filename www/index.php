<?php
    //Подключаем файлы
    include_once '../config/config.php';
    include_once '../library/mainFunction.php';

    //Определяем какой контролер будет работать
    $controllerName = isset($_GET['controller'])?ucfirst($_GET['controller']):'Index';

    //Определяем какой контролер будет работать
    $actionName = isset($_GET['action'])?ucfirst($_GET['action']):'Index';

    loadPage($controllerName, $actionName);
?>