<?php
/**
 * Контроллер для работы с пользователями
 *
 */
include_once "../models/CategoriesModel.php";
include_once "../models/OrderModel.php";
include_once "../models/UserModel.php";

function registerAction(){
    $email = isset($_REQUEST['email'])?$_REQUEST['email']:null;
    $email = trim($email);

    $pwd1 = isset($_REQUEST['pwd1'])?$_REQUEST['pwd1']:null;
    $pwd2 = isset($_REQUEST['pwd2'])?$_REQUEST['pwd2']:null;

    $phone = isset($_REQUEST['phone'])?$_REQUEST['phone']:null;
    $adress = isset($_REQUEST['adress'])?$_REQUEST['adress']:null;

    $name = isset($_REQUEST['name'])?$_REQUEST['name']:null;
    $name = trim($name);

    $resData = null;
    $resData = checkRegisterParams ($email, $pwd1, $pwd2);

    if (!$resData && checkUserEmail($email)){
        $resData['success'] = false;
        $resData['message'] = "пользователь с такой почтой уже зарегистрирован";
    }

    if (!$resData){
        $pwdMD5 = md5($pwd1);

        $userData = registerNewUser($email, $pwdMD5, $name, $phone, $adress);

        if ($userData['success']) {
            $resData['message'] = "Пользователь успешно зарегистрирован";
            $resData['success'] = 1;

            $userData = $userData[0];
            $resData['userName'] = $userData['name'] ? $userData['name'] : $userData['email'];
            $resData['userEmail'] = $email;

            $_SESSION['user'] = $userData;
            $_SESSION['user']['displayName'] = $userData['name'] ? $userData['name'] : $userData['email'];
        }else {
            $resData['message'] = "Ошибка регстрации";
            $resData['success'] = 0;
        }

    }
    echo  json_encode($resData);
}

function logoutAction() {
    if (isset($_SESSION['user'])) {
        unset($_SESSION['user']);
        unset($_SESSION['cart']);
    }
    redirect('/');
}

function loginAction(){
    $email = isset($_REQUEST['email'])?$_REQUEST['email']:null;
    $email = trim($email);

    $pwd = isset($_REQUEST['pwd'])?$_REQUEST['pwd']:null;
    $pwd = trim($pwd);

    $userData = loginUser($email, $pwd);

    if ($userData['success']) {
        $userData = $userData[0];

        $_SESSION['user'] = $userData;
        $_SESSION['user']['displayName'] = $userData['name']?$userData['name']:$userData['email'];

        $resData = $_SESSION['user'];

        $resData['success'] = 1;


    } else {
        $resData['success'] = 0;
        $resData['message'] = 'Неверный e-mail или пароль';
    }
    echo json_encode($resData);
}

function indexAction (){
    if (!isset($_SESSION['user'])){
        redirect('/');
    }

    $rsCategories = getAllMainCatsWithChildren();
    $smarty->assign('pageTitle', "Старинца пользователя");
    $smarye->assign('rsCategories', $rsCategories);

    loadTemlate($smarty, 'header');
    loadTemlate($smarty, 'user');
    loadTemlate($smarty, 'footer');
}