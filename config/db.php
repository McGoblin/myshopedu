<?php
/**
 * Настройки подключения к базе данных
 */

define(dbLocation, "127.0.0.1");
define(dbName, "myshop");
define(dbUser, "root");
define(dbPass, "27863927");

/**
 * Подключение к базе данных
 * @return mysqli возвращает Линк подключения к базе
 */
function dbConect (){
    $dbLink = mysqli_connect(dbLocation, dbUser, dbPass, dbName); //соединение с базой данных
    mysqli_set_charset($dbLink, 'utf8'); //установка кодировки
    if (!$dbLink){
        die('Ошибка соединения: ' . mysqli_connect_errno());
    }
    return $dbLink;
}

/**
 * Отключение от базы данных
 */
function dbDisconect (){
    mysqli_close(dbConect());
}

