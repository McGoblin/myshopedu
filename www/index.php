<?php
    //Определяем какой контролер будет работать
    $controllerName = isset($_GET['controller'])?ucfirst($_GET['controller']):'Index';
    echo "подключаем контролер $controllerName <br>";

    //Определяем какой контролер будет работать
    $actionName = isset($_GET['action'])?ucfirst($_GET['action']):'Index';
    echo "подключаем экшн $actionName <br>";
?>