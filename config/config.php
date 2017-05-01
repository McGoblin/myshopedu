<?php
    //Константы для обращения к контроллерам
    define('PathPrefix', '../controllers/');
    define('PathPostfix', 'Controller.php');

    //Используем шаблон
    $template = 'default';

    //Путик к файлам шаблонов (*.tpl)
    define('TemplatePrefix', "../views/{$template}/");
    define('TemplatePostfix', ".tpl");

    //Путик к файлам шаблонов  в веб пространстве
    define('TemplateWebPath', "/templates/{$template}/");

    //инициалзируем шаблонизатор Smarty
    ///
    require ('../library/Smarty/libs/Smarty.class.php');

    $smarty = new Smarty();

    $smarty->setTemplateDir(TemplatePrefix);
    $smarty->setCompileDir('../tmp/smarty/templates_c');
    $smarty->setCacheDir('../tmp/smarty/cache');
    $smarty->setConfigDir('../library/Smarty/configs');

    $smarty->assign('templateWebPath', TemplateWebPath);