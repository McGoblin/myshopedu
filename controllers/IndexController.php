<?php

//Подключение моделей
include_once '../models/CategoriesModel.php'; //Модель для работы с категориями

function testAction () {
    echo "IndexController.php > test";
}

function indexAction ($smarty) {
    $smarty->assign('pageTitle', 'Главная страница');
    loadTemlate($smarty, 'header');
    loadTemlate($smarty, 'index');
    loadTemlate($smarty, 'footer');
}
