<?php

function testAction () {
    echo "IndexController.php > test";
}

function indexAction ($smarty) {
    $smarty->assign('pageTitle', 'Главная страница');
    loadTemlate($smarty, 'index');
}
