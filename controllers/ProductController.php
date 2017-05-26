<?php

include_once "../models/ProductsModel.php";
include_once "../models/CategoriesModel.php";

function indexAction ($smarty){
    $itemId = isset($_GET['id'])?$_GET['id']:null;
    if ($itemId == null) exit();

    //Получаем информацию о продукте
    $rsProduct = getProductsById($itemId);

    //Получаем списко категорий с дочерними обхектами
    $rsCategories = getAllMainCatsWithChildren();

    $smarty->assign('pageTitle', 'Товары категории '.$rsCategory[0]['name']);// Передаем название страницы
    $smarty->assign('rsCategories', $rsCategories); // Передаем категории сайта
    $smarty->assign("rsProduct", $rsProduct); //передаем информацию о продукте


    loadTemlate($smarty, 'header');
    loadTemlate($smarty, 'product');
    loadTemlate($smarty, 'footer');
}