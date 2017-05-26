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
function addToCartAction (){
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