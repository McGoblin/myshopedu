<?php
/**
 * @param $controllerName имя контроллера
 * @param string $actionName имя экшена
 */
function loadPage ($controllerName, $actionName = 'index'){
    include_once PathPrefix.$controllerName.PathPostfix;
    //подключаем функцию
    $function = $actionName . "Action";
    $function();
}