<?php
/**
 * Контроллер для управлеия корзиной покупателя
 *
 */

include_once "../models/ProductsModel.php";
include_once "../models/CategoriesModel.php";

/**
 *
 * @param  integer $itemID - индификатор товара для добавления в корзину
 * $rsData - данные для передачи в js скрипт
 * @return json массив
 */
function addtocartAction (){
    $itemID = isset($_GET['id'])?$_GET['id']:null;
    if ($itemID==null) exit();

    $rsData = array();

    //Если в сессии в данных корзины нет товара, то добавляем его иначе нет
    if (isset($_SESSION['cart'])&& array_search($itemID, $_SESSION['cart']) === false){
        $_SESSION['cart'][]= $itemID;
        $rsData['cntItems'] = count($_SESSION['cart']);
        $rsData['success'] = 1;}
        else {
            $rsData['success'] = 0;
        }
        // передача данных в джейсон для обработки в джавескрипте
    echo json_encode($rsData);
}

function remfromcartAction() {
    if (isset($_GET['id'])) {
        $itemId = $_GET['id'];
    } else {
        $itemId = NULL;
    }
    if (!$itemId) { return false; }

    $resData = [];
    $key = array_search($itemId, $_SESSION['cart']);
    if ($key !== false) {
            unset($_SESSION['cart'][$key]);

        $resData['cntItems'] = count($_SESSION['cart']);
        $resData['success'] = 1;
    } else {
        $resData['success'] = 0;
    }
    echo json_encode($resData);
}

/**
 * Формирование страницы корзины
 * @param $smarty
 */
function indexAction($smarty) {

    $itemsIds = isset($_SESSION['cart'])?$_SESSION['cart']:array();
    $rsCategories = getAllMainCatsWithChildren();
    $rsProducts = getProductsFromArray($itemsIds);
    d($rsProducts);
    $smarty->assign('pageTitle', 'Корзина');
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);

    loadTemplate($smarty, 'header');
    loadTemplate($smarty, 'cart');
    loadTemplate($smarty, 'footer');
}
