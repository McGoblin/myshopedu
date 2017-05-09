<?php

//Подключение моделей
include_once '../models/CategoriesModel.php'; //Модель для работы с категориями

function testAction () {
    echo "IndexController.php > test";
}

function indexAction ($smarty) {
    $rsCategories = getAllMainCatsWithChildren();

    $smarty->assign('pageTitle', 'Главная страница');// Передаем название страницы
    $smarty->assign('rsCategories', $rsCategories); // Передаем категории сайта

    loadTemlate($smarty, 'header');
    loadTemlate($smarty, 'index');
    loadTemlate($smarty, 'footer');
}
