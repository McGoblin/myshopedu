<?php
/**
 * @param $smarty
 * @param $controllerName
 * @param string $actionName
 */
function loadPage ($smarty, $controllerName, $actionName = 'index'){
    include_once PathPrefix.$controllerName.PathPostfix;
    //подключаем функцию
    $function = $actionName . "Action";
    $function($smarty);
}

/**
 * @param $smarty
 * @param $templateName
 */
function loadTemlate ($smarty, $templateName){
    $smarty->display($templateName . TemplatePostfix);
}

/**
 * Функция дебага
 * @param null $value
 * @param int $die
 */
function d($value = null, $die = 1){
    echo 'Debug: <br /><pre>';
    print_r($value);
    echo '</pre>';

    if($die) die;
}

/**
 * @param $res полученые данные в результате запроса
 * @return array данных полученых в результате запроса
 */
function createSmartyRsArray ($res){
    $smartyRs = array();
    while ($row = mysqli_fetch_assoc($res)){
        $smartyRs[]=$row;
    }
    return $smartyRs;
}

function stringToSQL($param){
    return htmlspecialchars(mysqli_escape_string(dbConnect(),$param));
}
function redirect ($url){
    if (!$url) $url= '/';
    header("Location: {$url}");
    exit;
}
