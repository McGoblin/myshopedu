<?php

    $controllerName = isset($_GET['controller'])?ucfirst($_GET['controller']):'Index';
    echo "подключаем $controllerName";
?>