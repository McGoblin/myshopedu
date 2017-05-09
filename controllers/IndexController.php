<?php

//Подключение моделей
include_once '../models/CategoriesModel.php'; //Модель для работы с категориями
include_once '../models/ProductsModel.php'; //Модель для работы с продуктами

function testAction () {
    echo "IndexController.php > test";
}

function indexAction ($smarty) {
    $rsCategories = getAllMainCatsWithChildren();
    $rsProducts = getLasProducts(16);

    $smarty->assign('pageTitle', 'Главная страница');// Передаем название страницы
    $smarty->assign('rsCategories', $rsCategories); // Передаем категории сайта
    $smarty->assign('rsProducts', $rsProducts); // Передаем продукты сайта

    loadTemlate($smarty, 'header');
    loadTemlate($smarty, 'index');
    loadTemlate($smarty, 'footer');
}
