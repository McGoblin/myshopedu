<?php

include_once "../models/ProductsModel.php";
include_once "../models/CategoriesModel.php";

function indexAction ($smarty){
    $itemId = isset($_GET['id'])?$_GET['id']:null;
    if ($itemId == null) exit();

    //Получаем информацию о продукте
    $rsProduct = getProductsById($itemId);
//d($rsProduct);
    //Получаем списко категорий с дочерними обхектами
    $rsCategories = getAllMainCatsWithChildren();

    $smarty->assign('itemInCart', 0);
    if (in_array($itemId, $_SESSION['cart'])){
        $smarty->assign('itemInCart', 1);
    }

    $smarty->assign('pageTitle', $rsProduct[0]['name']);// Передаем название страницы
    $smarty->assign('rsCategories', $rsCategories); // Передаем категории сайта
    $smarty->assign("rsProduct", $rsProduct); //передаем информацию о продукте


    loadTemlate($smarty, 'header');
    loadTemlate($smarty, 'product');
    loadTemlate($smarty, 'footer');
}