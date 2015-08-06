<?php
require_once $_SERVER['DOCUMENT_ROOT']."/configuration.php";

/**
 * Functions Routing
 */
function AdminCrtl() {
    global $match;
    global $db;

    $qTable = $db->select("page", "*");

    return array(
        'params'          => qToDB($match),
        'pageContent'     => A_VIEW.$match['name'].'.php'
    );
}

function MenuCrtl() {
    global $match;
    global $db;
    
    $qMenu = $db->select("menu", array(
        "[>]menutype" => array("menutype_id" => "id"),
        "[>]extension" => array("extension_id" => "id"),
    ), array(
        "menu.id",
        "menu.menutype_id",
        "menu.title",
        "menu.alias",
        "menu.path",
        "menu.method",
        "menu.function",
        "menu.extension_id",
        "menu.link_id",
        "menu.published",
        "menu.params",
        "menutype.name(menutype_name)",
        "extension.title(extension_title)",
    ), array(
        "ORDER" => "menutype_id ASC",
    ));

    return array(
        'qMenu'           => $qMenu,
        'params'          => qToDB($match),
        'pageContent'     => A_VIEW.$match['name'].'.php'
    );
}

function ContentCrtl() {
    global $match;
    global $db;

    $qContent = $db->select("content", "*");

    return array(
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => A_VIEW.$match['name'].'.php'
    );
}

function ModuleCrtl() {
    global $match;
    global $db;

    $qContent = $db->select("module", array(
        "[>]extension" => array("extension_id" => "id")
    ), array(
        "module.id",
        "module.extension_id",
        "module.title",
        "module.description",
        "module.published",
        "module.ordering",
        "module.position",
        "module.visible",
        "module.params",
        "extension.title(extension_title)"
    ));

    return array(
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => A_VIEW.$match['name'].'.php'
    );
}

function ExtensionCrtl() {
    global $match;
    global $db;

    $qContent = $db->select("extension", "*");

    return array(
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => A_VIEW.$match['name'].'.php'
    );
}

function CommentsCrtl() {
    global $match;
    global $db;

    $qContent = $db->select("comment", array(
        "[>]content" => array("content_id" => "id")
    ), array(
        "comment.id",
        "comment.active",
        "comment.title",
        "comment.name",
        "comment.email",
        "comment.comment",
        "content.h1(h1)",
    ), array(
        "type" => "comment",
        "ORDER"=>"id DESC"
    ));

    return array(
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => A_VIEW.$match['name'].'.php'
    );
}

function SubscribersCrtl() {
    global $match;
    global $db;

    $qContent = $db->select("comment", array(
        "[>]content" => array("content_id" => "id")
    ), array(
        "comment.id",
        "comment.active",
        "comment.title",
        "comment.name",
        "comment.email",
        "comment.comment",
        "content.h1(h1)",
    ), array(
        "type" => "subscribe",
        "ORDER"=>"id DESC"
    ));

    return array(
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => A_VIEW.$match['name'].'.php'
    );
}

function AskingsCrtl() {
    global $match;
    global $db;

    $qContent = $db->select("comment", array(
        "[>]content" => array("content_id" => "id")
    ), array(
        "comment.id",
        "comment.active",
        "comment.title",
        "comment.name",
        "comment.email",
        "comment.comment",
        "content.h1(h1)",
    ), array(
        "type" => "asking",
        "ORDER"=>"id DESC"
    ));

    return array(
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => A_VIEW.$match['name'].'.php'
    );
}

function appMysqlToCSV() {
    global $match;
    global $db;
    
    $qRes = $db->select("content", array(
        "id", "alias", "h1", "h1Small", "h1Description", "introText",
        "metaTitle", "metaKeywords", "metaDescription", "metaOgTitle",
        "metaOgType", "metaOgSiteName", "metaOgDescription", "metaOgSection", "metaOgTag"
    ));

    $arr = array();
    foreach ($qRes as $key => $value) {
        array_push($arr, $value);
    }

    header("Content-Type: text/csv; charset=utf-8");
    header("Content-Disposition: attachment; filename=dumpMeta.csv");

    $f = fopen('php://output', 'w');

    $firstLineKeys = false;
    foreach ($arr as $line){
        if (empty($firstLineKeys)){
            $firstLineKeys = array_keys($line);
            fputcsv($f, $firstLineKeys);
            $firstLineKeys = array_flip($firstLineKeys);
        }
        fputcsv($f, array_merge($firstLineKeys, $line));
    }
    fclose($f);
    exit();
}
function appCSVtoMysql() {
    global $match;
    global $db;

    $qUpd = csv_to_array($_FILES['csvfile']['tmp_name']);
    foreach ($qUpd as $key => $value) {
        $db->update("content", array(
            'alias' => $value['alias'],
            'h1' => $value['h1'],
            'h1Small' => $value['h1Small'],
            'h1Description' => $value['h1Description'],
            'introText' => $value['introText'],
            'metaTitle' => $value['metaTitle'],
            'metaKeywords' => $value['metaKeywords'],
            'metaDescription' => $value['metaDescription'],
            'metaOgTitle' => $value['metaOgTitle'],
            'metaOgType' => $value['metaOgType'],
            'metaOgSiteName' => $value['metaOgSiteName'],
            'metaOgDescription' => $value['metaOgDescription'],
            'metaOgSection' => $value['metaOgSection'],
            'metaOgTag' => $value['metaOgTag']
        ), array(
            'id' => $value['id']
        ));
    }
    return array(
        'params'          => qToDB($match),
        'pageContent'     => A_VIEW.$match['name'].'.php'
    );
}


/**
 * Ajax function Save to DB
 * @return [type] [description]
 */
function saveToDB() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');

    $db->update($_POST['table'], array(
        $_POST['name'] => $_POST['value']
    ), array(
        'id' => $_POST['pk']
    ));
    $response = array(
        'msg' => 'Новое значение поля = '
    );
    
    echo json_encode($response);
    exit();
}
function saveToDBCheck() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');

    $par = explode("|", $_POST['params']);

    $db->update($par[0], array(
        $par[1] => ((strval($_POST['check']) == 'true')?1:0)
    ), array(
        'id' => $par[2]
    ));

    $response = array(
        'msg' => 'Новое значение поля = '
    );
    
    echo json_encode($response);
    exit();
}

/**
 * Ajax function GET from DB
 * @return [type] [description]
 */
function getFromDBSelect($table, $table_cond = '', $table_param = '') {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');
    
    $par = explode("|", $_GET['params']);
    $table_col = $par[1];
    $row_id = $par[2];

    // $result['0'] = "!---!";
    if ($table === 'extension') {
        $res = $db->select($table, array("id", $table_col), array($table_cond => $table_param));
    } else {
        $res = $db->select($table, array("id", $table_col));
    }

    foreach($res as $r) {
        if ($r['id'] == $cat_id) $result['selected'] = $r['id'];
        $result[$r['id']] = $r[$table_col];
    }

    print json_encode($result);
    
    exit();
}
function getFromDBSelectStatic($title = '') {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');

    switch ($title) {
        case 'sex':
            $array = array(
                array('value' => 0, 'text' => 'Жен'),
                array('value' => 1, 'text' => 'Муж'),
            );
            break;
        case 'is-young':
            $array = array(
                array('value' => 0, 'text' => 'Младше 18'),
                array('value' => 1, 'text' => 'Старше 18'),
            );
            break;
        
        case 'print-type':
            $array = array(
                array('value' => 0, 'text' => 'Список 1'),
                array('value' => 1, 'text' => 'Список 2'),
            );
            break;
        
        default:
            break;
    }
    print json_encode($array);
    exit();
}
function getTypeAHead($table, $table_col, $table_cond) {
    global $match;
    global $db;

	if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');

    $res = $db->select($table, array(
            "id(tokens)",
            $table_col.'(value)'
        ), array(
            $table_cond.'[~]' => $_GET['q'],
            "LIMIT" => 10
        ));

    print json_encode($res);
    exit();
}
function getListDB($table, $tmpl = '') {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');
    
    $primaryKey = 'id';

    require_once 'list-'.$tmpl.'.php';

    require( 'ajax/ssp.class.php' );
     
    echo json_encode(
        SSP::simple( $_POST, SQL_array, $table, $primaryKey, $columns, $tmpl )
    );

    exit();
}
function getFromDB($table, $tmpl = '') {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');
    
    $primaryKey = 'id';

    require_once 'route-'.$tmpl.'.php';

    require( 'ajax/ssp.class.php' );
     
    echo json_encode(
        SSP::simple( $_POST, SQL_array, $table, $primaryKey, $columns, $tmpl )
    );
    exit();
}






/**
 * Route settings
 * @var AltoRouter
 */

$router = new AltoRouter();
$router->setBasePath('/sadmin');

// $router->map('GET|POST','/', 'home#index', 'home');
// Example: GET|POST|PATCH|PUT|DELETE
// 
$router->map( 'GET', '/', 'AdminCrtl', 'sadmin');
$router->map( 'GET', '/content/', 'ContentCrtl', 'content');
$router->map( 'GET', '/module/', 'ModuleCrtl', 'module');
$router->map( 'GET', '/extension/', 'ExtensionCrtl', 'extension');
$router->map( 'GET', '/comments/', 'CommentsCrtl', 'comments');
$router->map( 'GET', '/subscribers/', 'SubscribersCrtl', 'subscribers');
$router->map( 'GET', '/askings/', 'AskingsCrtl', 'askings');

$router->map( 'GET', '/menu/', 'MenuCrtl', 'menu');

$router->map('POST', '/content/csv-to-mysql/', 'appCSVtoMysql', 'content-csv-to-mysql');
$router->map( 'GET', '/content/mysql-to-csv/', 'appMysqlToCSV', 'content-mysql-to-csv');

$router->map('GET',     '/print/', 'PrintsCrtl', 'prints');
$router->map('GET',     '/print/[i:id]/', 'PrintCrtl', 'print');

$router->map('POST',  '/printrem/[i:id]/', 'PrintRemoveCrtl', 'print-remove');


$router->map('POST|PUT','/save/', 'saveToDB', 'save-to-db');
$router->map('POST|PUT','/save/check/', 'saveToDBCheck', 'save-to-db-check');
$router->map('POST|PUT','/save/list/[*:col]/', 'saveListItem', 'save-list-item');

$router->map('POST',    '/get/data/[*:table]/[*:tmpl]/', 'getFromDB', 'get-from-db');
$router->map('POST',    '/get/list/[*:table]/[*:tmpl]/', 'getListDB', 'get-list-db');
$router->map('GET|POST','/get/group/static/[*:title]/', 'getFromDBSelectStatic', 'get-from-db-select-static');
$router->map('POST',    '/get/group/[*:table]/[*:table_cond]/[*:table_param]/', 'getFromDBSelect', 'get-from-db-select');
$router->map('GET|POST','/get/typeahead/[*:table]/[*:table_col]/[*:table_cond]/', 'getTypeAHead', 'get-typea-head');

$router->map('GET|POST',    '/get/prints/[*:id]', 'getPrintsCrtl', 'get-prints');

$match = $router->match();

if($match && is_callable($match['target'])) {
    $res = call_user_func_array($match['target'], $match['params']);
    $res = json_decode(json_encode($res), FALSE);
} else {
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    require_once A_TMP."x-head.php";
    require_once A_TMP."x-header.php";
    require P_SITE.'404.php';
    require_once A_TMP."x-footer.php";
    require_once A_TMP."x-ender.php";
    exit();
}


require_once A_TMP."x-head.php";
require_once A_TMP."x-header.php";
?>
    <div class="container-fluid">
        <div id="pageContent" data-file="/sadmin/template/view/<?php echo $match['name'].'.php'?>">
            <?php include $res->pageContent;?>
        </div>
    </div>
<?php
require_once A_TMP."x-footer.php";
require_once A_TMP."x-ender.php";
?>