<?php
/**
 * Route settings
 * @var AltoRouter
 */

$router = new AltoRouter();
/**
 * Проверки IS_LANG нужно будет собрать в функцию...
 */
if (IS_LANG === true) {
    $router->setBasePath('/'.USER_LANG);
}

$router->mapdb();
$res = new stdClass();
$resDecode = json_decode(json_encode($router->match()), FALSE);
$res = ($resDecode == '')?(new stdClass()):$resDecode;
$res->addToHead = '';

$res->user = new User();
$res->user->config->database->user = SQL_name;
$res->user->config->database->password = SQL_pass;
$res->user->config->database->name = SQL_db;
$res->user->config->database->host = "localhost";
$res->user->start();

require_once P_CORE.'rules.php';

/**
 * Тут можно вставлять кастомные роутеры
 * 	$router->map( 'GET', '/content/', 'ContentCrtl', 'content');
 *	$router->map( 'GET', '/module/', 'ModuleCrtl', 'module');
 */

/**
 * [comStaticPageCtrl description]
 * @return [type] [description]
 */
function comStaticPageCtrl() {
    global $res;
    global $db;

    $res->extensionCurrent->fileName = P_HTML.'static_one.php';

    return;
}

/**
 * [comArticleOnePageCtrl description]
 * @return [type] [description]
 */
function comArticleOnePageCtrl() {
    global $res;
    global $db;

    $res->extensionCurrent->fileName = P_HTML.'article_one.php';

    return;
}

/**
 * [comCategoryOnePageCtrl description]
 * @return [type] [description]
 */
function comCategoryOnePageCtrl() {
    global $res;
    global $db;

    if ($res->extensionCurrent->id == 5){
        $tId[] = $res->categoryCurrent->children_id;
        $tId[] = $res->categoryCurrent->id;
    } else {
        $tId = $res->categoryCurrent->id;
    }

    $qListContent = $db->select("content", '*', [
        "AND" => [
            "lang" => USER_LANG,
            "published" => 1,
            "publish_up[<]" => date('Y-m-d H:i:s'),
            "OR" => [
                "publish_down" => '0000-00-00 00:00:00',
                "publish_down[>]" => date('Y-m-d H:i:s'),
            ],
            "category_id" => $tId,
        ],
        "ORDER" => "publish_up DESC"
    ]);
    $res->extensionCurrent->fileName = P_HTML.$res->extensionCurrent->fileName.'.php';
    $res->articleList = json_decode(json_encode($qListContent), FALSE);
    return;
}

/**
 * [comCategoryListPageCtrl description]
 * @return [type] [description]
 */
function comCategoryListPageCtrl() {
    global $res;
    global $db;
    return;
}

/**
 * [comOnlyFilePageCtrl description]
 * @return [type] [description]
 */
function comOnlyFilePageCtrl() {
    global $res;
    global $db;

    $res->extensionCurrent->fileName = P_VIEW.$res->contentCurrent->fileName;

    return;
}




/**
 * [comCoreUserAccessFalse description]
 * @return [type] [description]
 */
function comCoreUserAccessFalse() {
    global $res; global $db;

    $res->extensionCurrent->fileName = P_HTML.'core_access_false.php';

    return;
}

/**
 * [comCoreUserAccountPanel description]
 * @return [type] [description]
 */
function comCoreUserAccountPanel() {
    global $res; global $db;

    $res->extensionCurrent->fileName = P_HTML.'core_account.php';
    return;
}




/**
 * [comCoreUserLoginView description]
 * @return [type] [description]
 */
function comCoreUserLoginView() {
    global $res; global $db;

    $res->extensionCurrent->fileName = P_HTML.'core_login.php';
    return;
}

/**
 * [comCoreUserRegisterView description]
 * @return [type] [description]
 */
function comCoreUserRegisterView() {
    global $res; global $db;

    $res->extensionCurrent->fileName = P_HTML.'core_register.php';
    return;
}

/**
 * [comCoreUserForgotPassView description]
 * @return [type] [description]
 */
function comCoreUserForgotPassView() {
    global $res; global $db;

    $res->extensionCurrent->fileName = P_HTML.'core_forgot.php';
    return;
}


/**
 * [comCoreUserLogin description]
 * @return [type] [description]
 */
function comCoreUserLogin() {
    global $res; global $db;

    if(count($_POST)){
        /*
         * Covert POST into a Collection object
         * for better value handling
         */
        $input = new Collection($_POST);

        $res->user->login($input->Username, $input->Password, $input->auto);
        $errMsg = '';

        if($res->user->log->hasError()){
            $errMsg = $res->user->log->getErrors();
            $errMsg = $errMsg[0];
        }

        echo json_encode(array(
            'error'    => $res->user->log->getErrors(),
            'confirm'  => 'You are now login as <b>'.$res->user->Username.'</b>',
            'form'     => $res->user->log->getFormErrors(),
        ));
    }

    exit();
}
function comCoreUserRegister() {
    global $res; global $db;

    if (count($_POST)) {
        $input = new Collection($_POST);

        $res->user->register($input);

        echo json_encode(
            array(
                'error'   => $res->user->log->getErrors(),
                'confirm' => 'User Registered Successfully. You may login now!',
                'form'    => $res->user->log->getFormErrors(),
            )
        );
    }

    exit();
}

/**
 * [comCoreUserForgotPass description]
 * @return [type] [description]
 */
function comCoreUserForgotPass() {
    global $res; global $db;

    if(count($_POST)){
        /*
         * Covert POST into a Collection object
         * for better handling
         */
        $input = new Collection($_POST);

        $reset = $res->user->resetPassword($input->Email);

        $errorMessage = '';
        $confirmMessage = '';

        if($reset){
            // Hash succesfully generated
            // You would send an email to $reset['Email'] with the URL+HASH $reset['hash'] to enter the new Password
            // In this demo we will just redirect the user directly
            $url = 'account/update/password?c=' . $reset->Confirmation;
            $confirmMessage = "Use the link below to change your password <a href='{$url}'>Change Password</a>";

        }else{
            $errorMessage = $res->user->log->getErrors();
            $errorMessage = $errorMessage[0];
        }

        echo json_encode(array(
            'error'    => $res->user->log->getErrors(),
            'confirm'  => $confirmMessage,
            'form'     => $res->user->log->getFormErrors(),
        ));
    }

    exit();
}

/**
 * [comCoreUserLogout description]
 * @return [type] [description]
 */
function comCoreUserLogout() {
    global $res; global $db;
    $res->user->logout();
    redirect("/");
    exit();
}

/**
 * [comSitemapXMLPageCtrl description]
 * @return [type] [description]
 */
function comSitemapXMLPageCtrl() {
    global $res;
    global $db;

    header ("content-type: text/xml");

    $qListContent = $db->select("menu", [
        "[>]content" => ["link_id" => "id"]
    ], [
        "menu.id",
        "menu.path",
        "menu.alias",
        "menu.link_id",
        "menu.published",
        "content.id(content_id)",
        "content.h1(content_h1)",
        "content.h1Small(content_h1Small)",
        "content.alias(content_alias)",
        "content.publish_up(content_publish_up)"
    ], [
        "AND" => [
            "menu.published" => 1,
            "menu.lang" => USER_LANG
        ],
        "ORDER" => "content.publish_up DESC"
    ]);
    // echo $db->last_query();

    $res->qListContent = json_decode(json_encode($qListContent), FALSE);

    $siteMap = '<?xml version="1.0" encoding="UTF-8"?>
    <urlset
          xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
          xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9

    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'."\r\n";
    $siteMap .= '
    <url>
        <loc>'.S_URLh.'</loc>
        <lastmod>'.date("Y-m-d\TH:i:s+02:00").'</lastmod>
        <changefreq>weekly</changefreq>
        <priority>1.00</priority>
    </url>'."\r\n";

    foreach(json_decode(json_encode($res->qListContent), true) as $r) {
        $siteMap .= '<url>'."\r\n";
        if ($res->menuItems->mainmenu->items->$r['id']->extension_id == 19) {
            $siteMap .= '<loc>'.$r["path"].'</loc>'."\r\n";
        } else {
            $siteMap .= '<loc>'.S_URLs.$r["path"].'</loc>'."\r\n";
        }
        $siteMap .= '<changefreq>weekly</changefreq>'."\r\n";
        $siteMap .= '<priority>0.50</priority>'."\r\n";
        $siteMap .= '</url>'."\r\n";
    }
    $siteMap .= '</urlset>';
    echo $siteMap;

    exit();
}

/**
 * [comSitemapPageCtrl description]
 * @return [type] [description]
 */
function comSitemapPageCtrl() {
    global $res;
    global $db;

    $qListContent = $db->select("menu", [
        "[>]content" => ["link_id" => "id"]
    ], [
        "menu.id",
        "menu.path",
        "menu.alias",
        "menu.link_id",
        "menu.published",
        "content.id(content_id)",
        "content.h1(content_h1)",
        "content.h1Small(content_h1Small)",
        "content.alias(content_alias)",
        "content.publish_up(content_publish_up)"
    ], [
        "AND" => [
            "menu.published" => 1,
            "menu.extension_id" => 2
        ],
        "ORDER" => "content.publish_up DESC"
    ]);

    $res->qListContent = json_decode(json_encode($qListContent), FALSE);
    return;
}


/**
 * Обработка вызванного роутера
 */
if($res && is_callable($res->target)) {
    rulesGo($res->routerCurrent->target);
    Analyze();
    $res->header = 200;
    $resFunc = call_user_func_array($res->target, json_decode(json_encode($res->params), true));
    $resFunc = json_decode(json_encode($resFunc), FALSE);
} else {
    if ($res->header == 301) {
        header('HTTP/1.1 301 Moved Permanently');
        header('Location: '.S_URLh.USER_LANG.$_SERVER['REQUEST_URI']);
        exit();
    }
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
}