<?php
/**
 *контроллер страницы категорий (category/1/)
 */

//подключаем модели

include_once "../models/CategoriesModel.php";
include_once "../models/ProductsModel.php";

function indexAction($smarty){
    $catId = isset($_GET['id'])? $_GET['id'] : null;
    if ($catId == null) exit;

    $rsChildCats = null;
    $rsProducts = null;
    $rsCategory = getCatById($catId);
    d($rsCategory,0);
    if ($rsCategory['parent_id'] == 0){
        $rsChildCats = getChildrenForCat($catId);
    }
    if ($rsCategory['parent_id'] !== 0){
        $rsProducts = getProductsByCat($catId);

    }

    $rsCategories = getAllMainCatsWithChildren();

    $smarty->assign('pageTitle', 'Товары категории '.$rsCategory[0]['name']);// Передаем название страницы
    $smarty->assign('rsCategories', $rsCategories); // Передаем категории сайта
    $smarty->assign("rsCategory", $rsCategory);
    $smarty->assign("rsChildCats", $rsChildCats);
    $smarty->assign("rsProducts", $rsProducts);

    loadTemlate($smarty, 'header');
    loadTemlate($smarty, 'category');
    loadTemlate($smarty, 'footer');

}