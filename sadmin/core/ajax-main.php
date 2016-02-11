<?php
/**
 * Ajax function Save to DB
 * @return [type] [description]
 */
function saveToDB() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');

    $db->update($_POST['table'], [
        $_POST['name'] => $_POST['value']
    ], [
        'id' => $_POST['pk']
    ]);
    $response = [
        'msg' => 'Новое значение поля = '.$_POST['value']
    ];

    echo json_encode($response);
    exit();
}
function saveToDBCheck() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');

    $par = explode("|", $_POST['params']);

    $db->update($par[0], [
        $par[1] => ((strval($_POST['check']) == 'true')?1:0)
    ], [
        'id' => $par[2]
    ]);

    $response = array(
        'msg' => 'Новое значение поля = '.$_POST['check']
    );

    echo json_encode($response);
    exit();
}

/**
 * Ajax function GET from DB
 * @return [type] [description]
 */
function getFromDBSelect($table, $table_name = null, $table_cond = null, $table_param = null) {
    global $match;
    global $db;

    // if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');

    if ($table_cond === null || $table_param === null) {
        $res = $db->select($table, [
            "id", $table_name
        ]);
    } else {
        $res = $db->select($table, [
            "id", $table_name
        ], [
            $table_cond => $table_param
        ]);
    }

    foreach($res as $r) {
        $i++;
        $array[$i]['value'] = $r['id'];
        $array[$i]['text'] = $r[$table_col];
    }
    /*
    $array = [
        ['value' => 0, 'text' => 'Список 1'],
        ['value' => 1, 'text' => 'Список 2'],
    ];
    */
    print json_encode($array);

    exit();
}
function getFromDBSelectStatic($title = '') {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');

    switch ($title) {
        case 'lang':
            $array = [
                ['value' => 'ru', 'text' => 'ru'],
                ['value' => 'en', 'text' => 'en'],
            ];
            break;
        case 'sex':
            $array = [
                ['value' => 0, 'text' => 'Жен'],
                ['value' => 1, 'text' => 'Муж'],
            ];
            break;
        case 'menu-method':
            $array = [
                ['value' => 'GET', 'text' => 'GET'],
                ['value' => 'POST', 'text' => 'POST'],
                ['value' => 'GET|POST', 'text' => 'GET|POST'],
                ['value' => 'POST|PUT', 'text' => 'POST|PUT'],
            ];
            break;
        case 'extension-type':
            $array = [
                ['value' => 'component', 'text' => 'component'],
                ['value' => 'module', 'text' => 'module'],
                ['value' => 'snippet', 'text' => 'snippet'],
            ];
            break;
        case 'menu-function':
            $array = [
                ['value' => 'articlesPageCtrl', 'text' => 'articlesPageCtrl'],
                ['value' => 'askingCtrl', 'text' => 'askingCtrl'],
                ['value' => 'askingDoCtrl', 'text' => 'askingDoCtrl'],
                ['value' => 'commentCtrl', 'text' => 'commentCtrl'],
                ['value' => 'commonPageCtrl', 'text' => 'commonPageCtrl'],
                ['value' => 'mainPageCtrl', 'text' => 'mainPageCtrl'],
                ['value' => 'mainPageMoreCtrl', 'text' => 'mainPageMoreCtrl'],
                ['value' => 'sitemapCtrl', 'text' => 'sitemapCtrl'],
                ['value' => 'sitemapXMLCtrl', 'text' => 'sitemapXMLCtrl'],
                ['value' => 'subscribeCtrl', 'text' => 'subscribeCtrl'],
                ['value' => 'unsubscribeCtrl', 'text' => 'unsubscribeCtrl'],
            ];
            break;

        case 'print-type':
            $array = [
                ['value' => 0, 'text' => 'Список 1'],
                ['value' => 1, 'text' => 'Список 2'],
            ];
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

    $res = $db->select($table, [
            "id(tokens)",
            $table_col.'(value)'
        ], [
            $table_cond.'[~]' => $_GET['q'],
            "LIMIT" => 10
        ]);

    print json_encode($res);
    exit();
}
function getListDB($table, $tmpl = '') {
    global $match;
    global $SQL_array;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $primaryKey = 'id';

    require_once A_CORE.'template-list-'.$tmpl.'.php';

    echo json_encode(
        SSP::simple( $_POST, $SQL_array, $table, $primaryKey, $columns, $tmpl )
    );

    exit();
}
function getFromDB($table, $tmpl = '') {
    global $match;
    global $SQL_array;

    // if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $primaryKey = 'id';

    require_once A_CORE.'template-'.$tmpl.'.php';

    echo json_encode(
        SSP::simple( $_POST, $SQL_array, $table, $primaryKey, $columns, $tmpl )
    );
    exit();
}
