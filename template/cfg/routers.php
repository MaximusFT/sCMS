<?php
/**
 * Route settings
 * @var AltoRouter
 */

$router = new AltoRouter();
$router->mapdb();
$res = json_decode(json_encode($router->match()), FALSE);
$res->addToHead = '';
$res->fileName = P_VIEW.$res->qCont->fileName.'.php';

/**
 * Тут можно вставлять кастомные роутеры
 * 	$router->map( 'GET', '/content/', 'ContentCrtl', 'content');
 *	$router->map( 'GET', '/module/', 'ModuleCrtl', 'module');
 */

function mainPageCtrl() {
    global $res;
    global $db;

    $qListContent = $db->select("menu", array(
        "[>]content" => array("link_id" => "id")
    ), array(
        "menu.id",
        "menu.path",
        "menu.title",
        "menu.alias",
        "menu.link_id",
        "menu.published",
        "content.published(content_published)",
        "content.id(content_id)",
        "content.h1(content_h1)",
        "content.h1Small(content_h1Small)",
        "content.h1Description(content_h1Description)",
        "content.alias(content_alias)",
        "content.publish_up(content_publish_up)"
    ), array(
        "AND" => array(
            "menu.published" => 1,
            "content.published" => 1,
            "menu.extension_id" => 2
        ),
        "ORDER" => "content.publish_up DESC",
        "LIMIT" => 3
    ));

    // echo $db->last_query();
    // var_dump($db->error());

    $res->qListContent = json_decode(json_encode($qListContent), FALSE);
    
    return;
}

function mainPageMoreCtrl() {
    global $res;
    global $db;

    $qListContent = $db->select("menu", array(
        "[>]content" => array("link_id" => "id")
    ), array(
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
    ), array(
        "AND" => array(
            "menu.published" => 1,
            "menu.extension_id" => 2
        ),
        "ORDER" => "content.publish_up DESC",
        "LIMIT" => array(10, 100)
    ));

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
    
    $qComment = $db->insert("comment", array(
        "url" => $qqq[0],
        "content_id" => $qqq[1],
        "email" => $email,
        "type" => 'subscribe',
    ));
    
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

    $qComment = $db->insert("comment", array(
        "url" => $qqq[0],
        "content_id" => $qqq[1],
        "name" => $name,
        "title" => $print,
        "email" => $email,
        "type" => 'asking',
        "comment" => $question
    ));
    
    echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Успех!</strong> Ваш вопрос был нами получин, как только специалист подготовит ответ на вопрос, мы сообщим вам на ваш электронный почтовый адрес</div>';
    exit();
}

function sitemapCtrl() {
    global $res;
    global $db;

    $qListContent = $db->select("menu", array(
        "[>]content" => array("link_id" => "id")
    ), array(
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
    ), array(
        "AND" => array(
            "menu.published" => 1,
            "menu.extension_id" => 2
        ),
        "ORDER" => "content.publish_up DESC"
    ));
    
    $res->qListContent = json_decode(json_encode($qListContent), FALSE);
    return;
}

function sitemapXMLCtrl() {
    global $res;
    global $db;

    header ("content-type: text/xml");

    $qListContent = $db->select("menu", array(
        "[>]content" => array("link_id" => "id")
    ), array(
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
    ), array(
        "AND" => array(
            "menu.id[!]" => array(2,3,9,19),
            "menu.published" => 1,
            "menu.extension_id" => array(1, 2)
        ),
        "ORDER" => "content.publish_up DESC"
    ));
    // echo $db->last_query();
    
    $res->qListContent = json_decode(json_encode($qListContent), FALSE);

    return;
}

function articlesPageCtrl() {
    global $res;
    global $db;

    $qListContent = $db->select("menu", array(
        "[>]content" => array("link_id" => "id")
    ), array(
        "menu.id",
        "menu.path",
        "menu.alias",
        "menu.link_id",
        "menu.published",
        "content.id(content_id)",
        "content.catid(catid)",
        "content.h1(content_h1)",
        "content.h1Small(content_h1Small)",
        "content.alias(content_alias)",
        "content.publish_up(content_publish_up)"
    ), array(
        "AND" => array(
            "menu.published" => 1,
            "menu.extension_id" => 2
        ),
        "ORDER" => "content.publish_up DESC"
    ));
    
    $res->qListContent = json_decode(json_encode($qListContent), FALSE);
    return;
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

    $qComment = $db->insert("comment", array(
        "url" => $qqq[0],
        "content_id" => $qqq[1],
        "name" => $name,
        "title" => $title,
        "email" => $email,
        "type" => 'comment',
        "comment" => $question
    ));
    
    echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Спасибо!</strong> Ваш комментарий был нами получин, как только модератор проверит его, он будет опубликован</div>';
    exit();
}

function commonPageCtrl() {
    global $res;
    global $db;

    $qCom = $db->select("comment", array(
        "title",
        "name",
        "comment",
        "timecreate"
    ), array(
        "AND" => array(
            "content_id" => $res->qCont->id,
            "type" => 'comment',
            "active" => 1
        )
    ));
    
    $qCount = $db->count("comment", array(
        "AND" => array(
            "content_id" => $res->qCont->id,
            "type" => 'comment',
            "active" => 1
        )
    ));
    
    $res->qComm = json_decode(json_encode($qCom), FALSE);
    $res->qCommCount = json_decode(json_encode($qCount), FALSE);

    return;
}

/**
 * Обработка вызванного роутера
 */
if($res && is_callable($res->target)) {
    Analyze();
    $resFunc = call_user_func_array($res->target, $res->params);
    $resFunc = json_decode(json_encode($resFunc), FALSE);
} else {
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    require_once P_TMP."_head.php";
    require_once P_SITE.'404.php';
    require_once P_TMP."_ender.php";
    exit();
}