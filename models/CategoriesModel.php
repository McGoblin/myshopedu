<?php
/**
 * Модель формирования списка категорий и работы с таблицей категорий (categories)
 */

/**
 * Получение категорий сайта с привязками дочерних категорий
 * @return array категорий сайта
 */
function getAllMainCatsWithChildren () {
    $sql = 'SELECT *
            FROM `categories`
            WHERE `parent_id` = 0';

    $res = mysqli_query(dbConnect(), $sql);

    $smartyres = array();
    while ($row = mysqli_fetch_assoc($res)){
        $rsChildren = getChildrenForCat($row['id']);
        if ($rsChildren){
            $row['children'] = $rsChildren;
        }
        $smartyres[] = $row;
    };
    return $smartyres;
}

/**
 * Функция получает дочерние категории
 * @param $id категории родителя
 * @return array дочерних категорий
 */
function getChildrenForCat($id){
    $sql = "SELECT * FROM `categories` WHERE `parent_id` = '{$id}'";
    $res = mysqli_query(dbConnect(), $sql);
    return createSmartyRsArray($res);
}

/**
 * Получение категории по ID
 * @param $catID индификатор категории
 * @return array результат выборки
 */
function getCatById ($catID){
    $catID = intval($catID);
    $sql = "
    SELECT * 
    FROM `categories`
    WHERE `id` = '$catID'";
    $res = mysqli_query(dbConnect(), $sql);
    return createSmartyRsArray($res);
}