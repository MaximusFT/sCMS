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

/**
 * Тут можно вставлять кастомные роутеры
 * 	$router->map( 'GET', '/content/', 'ContentCrtl', 'content');
 *	$router->map( 'GET', '/module/', 'ModuleCrtl', 'module');
 */

function comStaticPageCtrl() {
    global $res;
    global $db;

    $res->extensionCurrent->fileName = P_HTML.'static_one.php';

    return;
}
function comArticleOnePageCtrl() {
    global $res;
    global $db;

    $res->extensionCurrent->fileName = P_HTML.'article_one.php';

    return;
}
function comCategoryOnePageCtrl() {
    global $res;
    global $db;

    $qListContent = $db->select("content", '*', [
        "AND" => [
            "content.lang" => USER_LANG,
            "content.published" => 1,
            "content.category_id" => $res->categoryCurrent->id,
        ],
        "ORDER" => "content.publish_up DESC",
        "LIMIT" => 10
    ]);

    $res->extensionCurrent->fileName = P_HTML.$res->extensionCurrent->fileName.'.php';
    $res->articleList = json_decode(json_encode($qListContent), FALSE);
    return;
}
function comCategoryListPageCtrl() {
    global $res;
    global $db;

    return;
}
function comOnlyFilePageCtrl() {
    global $res;
    global $db;

    $res->extensionCurrent->fileName = P_VIEW.$res->menuItemCurrent->params->fileName;

    return;
}
function comPostRequestPageCtrl() {
    global $res;
    global $db;

    return;
}
function comSitemapXLMPageCtrl() {
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
            "menu.id[!]" => array(2,3,9,19),
            "menu.published" => 1,
            "menu.extension_id" => array(1, 2)
        ],
        "ORDER" => "content.publish_up DESC"
    ]);
    // echo $db->last_query();

    $res->qListContent = json_decode(json_encode($qListContent), FALSE);

    return;
}

function mainPageMoreCtrl() {
    global $res;
    global $db;

    $qListContent = $db->select("menu", [
        "[>]content" => ["link_id" => "id"]
    ], [
        "menu.id",
        "menu.path",
        "menu.alias",
        "menu.title",
        "menu.link_id",
        "menu.published",
        "content.id(content_id)",
        "content.h1(content_h1)",
        "content.h1Small(content_h1Small)",
        "content.h1Description(content_h1Description)",
        "content.alias(content_alias)",
        "content.publish_up(content_publish_up)"
    ], [
        "AND" => [
            "menu.published" => 1,
            "menu.extension_id" => 2
        ],
        "ORDER" => "content.publish_up DESC",
        "LIMIT" => array(3, 100)
    ]);

    // echo $db->last_query();
    // var_dump($db->error());

    $res->qListContent = json_decode(json_encode($qListContent), FALSE);

    return;
}

function subscribeCtrl() {
    global $res;
    global $db;

    $email = $_POST['sEmail'];
    $param = $_POST['sParams'];

    $qqq = explode('|', $param);

    $qComment = $db->insert("comment", [
        "url" => $qqq[0],
        "content_id" => $qqq[1],
        "email" => $email,
        "type" => 'subscribe',
    ]);

    exit();
}

function unsubscribeCtrl() {
    global $res;

    $res->addToHead .= '<meta name="robots" content="noindex, follow" />';

    return;
}

function askingCtrl() {
    return;
}
function askingDoCtrl() {
    global $res;
    global $db;

    $name = $_POST['aName'];
    $email = $_POST['aEmail'];
    $question = $_POST['aQuestion'];
    @$print = $_POST['aPrint'];
    $param = $_POST['aParams'];

    $qComment = $db->insert("comment", [
        "url" => $qqq[0],
        "content_id" => $qqq[1],
        "name" => $name,
        "title" => $print,
        "email" => $email,
        "type" => 'asking',
        "comment" => $question
    ]);

    echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Успех!</strong> Ваш вопрос был нами получин, как только специалист подготовит ответ на вопрос, мы сообщим вам на ваш электронный почтовый адрес</div>';
    exit();
}

function sitemapCtrl() {
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

function sitemapXMLCtrl() {
}

function commentCtrl() {
    global $res;
    global $db;

    $name = $_POST['qName'];
    $email = $_POST['qEmail'];
    $title = $_POST['qTitle'];
    $question = $_POST['qQuestion'];
    @$print = $_POST['qPrint'];
    $param = $_POST['qParams'];
    $subject = S_URLName." - Comment: ".$email."";

    $qqq = explode('|', $param);

    $qComment = $db->insert("comment", [
        "url" => $qqq[0],
        "content_id" => $qqq[1],
        "name" => $name,
        "title" => $title,
        "email" => $email,
        "type" => 'comment',
        "comment" => $question
    ]);

    echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Спасибо!</strong> Ваш комментарий был нами получин, как только модератор проверит его, он будет опубликован</div>';
    exit();
}

function commonPageCtrl() {
    global $res;
    global $db;

    $qCom = $db->select("comment", [
        "title",
        "name",
        "comment",
        "timecreate"
    ], [
        "AND" => [
            "content_id" => $res->contentCurrent->id,
            "type" => 'comment',
            "active" => 1
        ]
    ]);

    $qCount = $db->count("comment", [
        "AND" => [
            "content_id" => $res->contentCurrent->id,
            "type" => 'comment',
            "active" => 1
        ]
    ]);

    $res->qComm = json_decode(json_encode($qCom), FALSE);
    $res->qCommCount = json_decode(json_encode($qCount), FALSE);

    return;
}

/**
 * Обработка вызванного роутера
 */
if($res && is_callable($res->target)) {
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