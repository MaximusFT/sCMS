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

    $db->update($_POST['table'], [
        $_POST['name'] => $_POST['value'][0]
    ], [
        'id' => $_POST['pk']
    ]);
    $response = [
        'msg' => 'Новое значение поля = '.$_POST['value'][0]
    ];

    echo json_encode($response);
    exit();
}

/**
 * Ajax function GET from DB
 * @return [type] [description]
 */
function getFromDBSelect($table, $table_name, $table_cond = null, $table_param = null) {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
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
        $array[] = ['value' => $r['id'], 'text' => $r[$table_name]];
    }

    print json_encode($array);
    exit();
}
function getFromDBSelectStatic($title = '') {
    global $langArrayU;
    global $match;
    global $db;

    // if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');

    switch ($title) {
        case 'lang':
            foreach ($langArrayU as $key => $value) {
                $array[$key] = ['value' => $value, 'text' => $value];
            }
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
                ['value' => 'category', 'text' => 'category'],
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

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $primaryKey = 'id';

    require_once A_CORE.'template-'.$tmpl.'.php';

    echo json_encode(
        SSP::simple( $_POST, $SQL_array, $table, $primaryKey, $columns, $tmpl )
    );
    exit();
}

function getTranslit() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

    print translitlow($_POST['params']);
    exit();
}

function getTranslitAlias() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

    $id = $_POST['id'];
    $par = explode("|", $_POST['params']);

    $res = $db->get($par[0], array(
            $par[1], $par[2]
        ), array(
            "id" => $id
        ));

    // echo $db->last_query();
    // var_dump($db->error());

    if ($res[$par[1]] != '') {
        $tran = translitlow($res[$par[1]]);

        $db->update($par[0], array(
            $par[2] => $tran
        ), array(
            'id' => $id
        ));
        // echo $db->last_query();

        print $tran;
    }
    print translitlow($_POST['params']);
    exit();
}





function saveMenuAdd() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $_POST['extension_id'] = (!empty($_POST['extension_id']))?$_POST['extension_id']:'2';
    $_POST['method'] = (!empty($_POST['method']))?$_POST['method']:'GET';
    $_POST['path'] = (!empty($_POST['path']))?$_POST['path']:'/'.$_POST['alias'].'/';

    $last_id = $db->insert("menu", array(
        "title" => $_POST['title'],
        "alias" => $_POST['alias'],
        "path" => $_POST['path'],
        "method" => $_POST['method'],
        "menutype_id" => $_POST['menutype_id'],
        "extension_id" => $_POST['extension_id'],
        "published" => 0,
        "home" => 0
    ));

    $menuArray = $db->get("menutype", "params", [
        "id" => $_POST['menutype_id']
    ]);

    $menuArray = json_decode($menuArray);
    array_push($menuArray, array('id' => intval($last_id)));
    $menuArray = json_encode($menuArray);

    $db->update("menutype", [
        'params' => $menuArray
    ], [
        'id' => $_POST['menutype_id']
    ]);

    $response = array(
        // 'msg' => $menuArray.' ||| '.$last_id
        'msg' => 'Добавлен новый пункт меню'
    );

    // var_dump($db->log());
    // var_dump($db->error());

    echo json_encode($response);
    exit();
}

function saveMenuDel() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $menuArray = $db->get("menutype", "params", [
        "id" => intval($_POST['menutype_id'])
    ]);

    function delId($array, $delId, $parent) {
        $newArr = [];
        foreach ($array as $key => $item) {
            if ($item['id'] === $delId && $item['children']) {
                foreach ($item['children'] as $key => $ite) {
                    $newArr[] = $ite;
                }
            } elseif ($item['id'] === $delId){
            } elseif ($item['children']){
                $newArr[$key] = $item;
                $item = delId($item['children'], $delId, $array[$key]);
                $newArr[$key]['children'] = $item;
                if (count($newArr[$key]['children']) == 0) {
                    unset($newArr[$key]['children']);
                }
            } else {
                $newArr[] = $item;
            }
        }
        return $newArr;
    }

    $menuArrayTemp = json_decode($menuArray, true);
    $temp[0]['id'] = 0;
    $temp[0]['children'] = $menuArrayTemp;

    $newArraytemp = delId($temp, intval($_POST['id']), $temp);
    $newArray = json_encode($newArraytemp[0]['children'], true);

    $db->update("menutype", [
        'params' => $newArray
    ], [
        'id' => $_POST['menutype_id']
    ]);

    $db->delete("menu", [
        "id" => intval($_POST['id'])
    ]);

    $response = array(
        'msg' => 'Пункт меню удален'
    );

    // var_dump($db->log());
    // var_dump($db->error());

    echo json_encode($response);
    exit();
}

function saveMenuRefresh() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $menuArray = $db->select("menu", "*", [
        "menutype_id" => $_POST['id']
    ]);

    $i = 0;
    foreach ($menuArray as $key => $value) {
        $temp[$i]['id'] = $value['id'];
        $i++;
    }
    $newArray = json_encode($temp, true);

    $db->update("menutype", [
        'params' => $newArray
    ], [
        'id' => $_POST['id']
    ]);

    $response = array(
        'msg' => 'Дерево меню сброшено!'
    );

    echo json_encode($response);
    exit();
}
