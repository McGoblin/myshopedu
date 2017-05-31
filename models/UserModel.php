<?php
/**
 *  Модель для работы с таблицей User
 */
/** Регистрация нового пользователя
 * @param $email
 * @param $pwdMD5
 * @param $name
 * @param $phone
 * @param $adress
 * @return array|bool|mysqli_result
 */
function registerNewUser ($email, $pwdMD5, $name, $phone, $adress){
    $email= stringToSQL($email);
    $name= stringToSQL($name);
    $phone=stringToSQL($phone);
    $adress= stringToSQL($adress);

    $sql = "
    INSERT INTO `user` (`email`, `pwd`, `name`, `phone`, `adress`)
    VALUES ('{$email}', '{$pwdMD5}', '{$name}', '{$phone}', '{$adress}')
    ";


    $res = mysqli_query(dbConnect(),$sql);
    if ($res){
    $sql = "
    SELECT * FROM `user` WHERE (`email`='{$email}' AND `pwd`='{$pwdMD5}')
    LIMIT 1";

    $res = mysqli_query(dbConnect(),$sql);
    $res = createSmartyRsArray($res);
    $res['success'] = isset($res[0])?$res['success']=1:$res['success']=0;
    } else{
        $res['success']=0;
    }
    return $res;
}

/**
 * Проверка данных регитрации пользователя
 * @param $email
 * @param $pwd1
 * @param $pwd2
 * @return array
 */
function checkRegisterParams($email, $pwd1, $pwd2){
    $res = null;

    if (!$email) {
        $res['success'] = false;
        $res['message'] = 'Введите e-mail';
    }
    if (!$pwd1) {
        $res['success'] = false;
        $res['message'] = 'Введите пароль';
    }
    if (!$pwd2) {
        $res['success'] = false;
        $res['message'] = 'Введите подтверждение пароля';
    }
    if ($pwd1 != $pwd2) {
        $res['success'] = false;
        $res['message'] = 'Пароли не совпадают';
    }
    return $res;
}

function checkUserEmail($email){
    $email = mysqli_real_escape_string(dbConnect(), $email);

    $sql = "SELECT `id` FROM `user` WHERE `email` = '{$email}'";
    $res = mysqli_query(dbConnect(),$sql);
    return createSmartyRsArray($res);
}

function loginUser($email, $pwd){

    $hash = md5($pwd);
    $email = stringToSQL($email);
    $sql = "SELECT * FROM `user` WHERE (`email` = '{$email}' AND `pwd` = '{$hash}');";

    $res = mysqli_query(dbConnect(),$sql);
    $res = createSmartyRsArray($res);
    $res['success'] = isset($res[0])?$res['success'] = 1:$res['success'] = 0;

    return $res;
}

function updateUserData ($name, $phone, $adress, $pwd1, $pwd2, $curPwd){
    $name = stringToSQL($name);
    $email = stringToSQL($_SESSION['user']['email']);
    $phone = stringToSQL($phone);
    $adress = stringToSQL($adress);

    $pwd1= trim($pwd1);
    $pwd2= trim($pwd2);

    $newPwd=null;
    if ($pwd1 && ($pwd1==$pwd2)){
        $newPwd = md5($pwd1);
    }

    $sql = "UPDATE `user` SET ";
    if ($newPwd){
        $sql = "`pwd` = '{$newPwd}', ";
    }

    $sql = "
    `name` = '{$newPwd}',
    `phone` = '{$phone}',
    `adress` = '{$adress}'
    WHERE 
    `email` = '{$email}' AND `pwd` = '{$curPwd}'
    LIMIT 1
    ";

    $res = mysqli_query(dbConnect(), $sql);

    return $res;
}