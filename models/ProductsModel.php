<?php
/**
 * Это модель для работы с таблицой продукты (products)
 */

/**
 * @param null $limit Лимит товаров на странице
 * @return array товаров для вывода странице
 */
function getLasProducts ($limit = null){
    $sql = "
    SELECT *
    FROM `products`
    ORDER BY `id` DESC";
    if ($limit){
        $sql .= " LIMIT {$limit}";
    }
    $res = mysqli_query(dbConnect(),$sql);
    return createSmartyRsArray($res);
}

/**
 * @param $catID категории, для которой будем выбирать продукты
 * @return array массив продуктов для категории
 */
function getProductsByCat ($catID){

    $sql = "SELECT *
            FROM `products`
            WHERE `category_id` = '{$catID}'";

    $res = mysqli_query(dbConnect(),$sql);
    return createSmartyRsArray($res);
}

/**
 * Функция выбириает информацию о продкуте по ID
 * @param $itemId индификатор продкута
 * @return array Информация о продукте
 */
function getProductsById($itemId){
    $itemId=intval($itemId);
    $sql = "
    SELECT * FROM `products`
    WHERE `id` = '{$itemId}'";

    $res = mysqli_query(dbConnect(),$sql);
    return createSmartyRsArray($res);
}