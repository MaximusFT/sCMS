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
function saveToDBParams() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');

    $menuRes = $db->get($_POST['table'], "*", [
            "AND" => [
                "id" => $_POST['pk']
            ]
        ]
    );

    $menuRes['params'] = json_decode($menuRes['params'], true);
    $menuRes['params'][$_POST['name']] = $_POST['value'];
    $db->update($_POST['table'], [
            "params" => json_encode($menuRes['params'])
        ], [
            "AND" => [
                "id" => $_POST['pk']
            ]
        ]
    );

    $response = [
        'msg' => 'Новое значение поля '.$_POST['name'].' = '.$_POST['value']
    ];

    echo json_encode($response);
    exit();
}
function saveToDBTypeHead() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');

    $db->update($_POST['table'], [
        $_POST['name'] => $_POST['tokens']
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
function getFromDBSimpleSelect($table, $table_name) {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');

    $res = $db->select($table,
        [
            "id", $table_name
        ],[
            'AND' => [
                'published' => 1,
        ]
    ]);

    foreach($res as $r) {
        $i++;
        $array[] = ['value' => $r['id'], 'text' => $r[$table_name]];
    }

    print json_encode($array);
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

    if ($table_param == 'component') {
        $res = $db->select($table, [
            "id", $table_name
        ], [
            'AND' => [
                $table_cond => $table_param,
                'published' => 1,
            ]
        ]);
    } elseif ($table_param == 'module') {
        $res = $db->select($table, [
            "id", $table_name
        ], [
            'AND' => [
                $table_cond => $table_param,
                'published' => 1,
            ]
        ]);
        // echo $db->last_query();
        // var_dump($db->error());
    } else {
        $res = $db->select($table, [
            "id", $table_name
        ], [
            $table_cond => $table_param,
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
        case 'module-view':
            $array = [
                ['value' => 'default', 'text' => 'default'],
                ['value' => 'category', 'text' => 'category'],
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
        case 'position':
            $array = [
                ['value' => 'tech', 'text' => 'tech'],
                ['value' => 'nav-top', 'text' => 'nav-top'],
                ['value' => 'nav-top-right', 'text' => 'nav-top-right'],
                ['value' => 'after-nav', 'text' => 'after-nav'],
                ['value' => 'container-top', 'text' => 'container-top'],
                ['value' => 'page-header-bottom', 'text' => 'page-header-bottom'],
                ['value' => 'breadcrumb', 'text' => 'breadcrumb'],
                ['value' => 'before-content-1', 'text' => 'before-content-1'],
                ['value' => 'before-content-2', 'text' => 'before-content-2'],
                ['value' => 'after-content-1', 'text' => 'after-content-1'],
                ['value' => 'after-content-2', 'text' => 'after-content-2'],
                ['value' => 'aside-1', 'text' => 'aside-1'],
                ['value' => 'aside-2', 'text' => 'aside-2'],
                ['value' => 'aside-3', 'text' => 'aside-3'],
                ['value' => 'container-bottom', 'text' => 'container-bottom'],
                ['value' => 'after-container', 'text' => 'after-container'],
                ['value' => 'footer-pos-left', 'text' => 'footer-pos-left'],
                ['value' => 'footer-pos-center', 'text' => 'footer-pos-center'],
                ['value' => 'footer-pos-right', 'text' => 'footer-pos-right'],
                ['value' => 'after-footer', 'text' => 'after-footer'],
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
function getTypeAHeadLang($table, $table_col, $table_cond, $lang) {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');

    $res = $db->select($table, [
            "id(tokens)",
            $table_col.'(value)'
        ], [
            'AND' => [
                $table_cond.'[~]' => $_GET['q'],
                "lang" => $lang,
            ],
            "LIMIT" => 10
        ]);

    print json_encode($res);
    exit();
}
function getTypeAHeadLink($table, $table_col, $table_cond) {
    global $match;
    global $db;

	if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json;');

    if ($_GET['extension_id'] == 6) {
        $_GET['category_id'] = 1;
    } elseif ($_GET['extension_id'] == 1) {
        $_GET['category_id'] = 2;
    }

    $res = $db->select($table, [
            "id(tokens)",
            $table_col.'(value)'
        ], [
            'AND' => [
                $table_cond.'[~]' => $_GET['q'],
                "category_id" => $_GET['category_id'],
            ],
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
        "lang" => $_POST['lang'],
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
function saveMenuHomepage() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $menuArray = $db->select("menu", "*", [
        'AND' => [
            "home" => 1,
            "lang" => $_POST['lang']
        ]
    ]);

    foreach ($menuArray as $key => $value) {
        $temp[] = $value['id'];
    }
    $newArray = json_encode($temp, true);

    $db->update("menu", [
        'home' => 0
    ], [
        'id' => $temp
    ]);
    $db->update("menu", [
        'home' => 1
    ], [
        'id' => $_POST['id']
    ]);

    $response = array(
        'msg' => 'New HomePage'
    );

    echo json_encode($response);
    exit();
}











function saveCategoryAdd() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $last_id = $db->insert("category", array(
        "title" => $_POST['title'],
        "lang" => $_POST['lang'],
        "fileName" => 'category_one',
        "params" => '{"aside":"right","noPath":true}',
        "categorytype_id" => $_POST['categorytype_id'],
        "published" => 0
    ));

    $categoryArray = $db->get("categorytype", "params", [
        "id" => $_POST['categorytype_id']
    ]);

    $categoryArray = json_decode($categoryArray);
    array_push($categoryArray, array('id' => intval($last_id)));
    $categoryArray = json_encode($categoryArray);

    $db->update("categorytype", [
        'params' => $categoryArray
    ], [
        'id' => $_POST['categorytype_id']
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

function saveCategoryDel() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $categoryArray = $db->get("categorytype", "params", [
        "id" => intval($_POST['categorytype_id'])
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

    $categoryArrayTemp = json_decode($categoryArray, true);
    $temp[0]['id'] = 0;
    $temp[0]['children'] = $categoryArrayTemp;

    $newArraytemp = delId($temp, intval($_POST['id']), $temp);
    $newArray = json_encode($newArraytemp[0]['children'], true);

    $db->update("categorytype", [
        'params' => $newArray
    ], [
        'id' => $_POST['categorytype_id']
    ]);

    $db->delete("category", [
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

function saveCategoryRefresh() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $categoryArray = $db->select("category", "*", [
        "categorytype_id" => $_POST['id']
    ]);

    $i = 0;
    foreach ($categoryArray as $key => $value) {
        $temp[$i]['id'] = $value['id'];
        $i++;
    }
    $newArray = json_encode($temp, true);

    $db->update("categorytype", [
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










function saveMenuTypeAdd() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $last_id = $db->insert("menutype", array(
        "title" => $_POST['title'],
        "name" => $_POST['name'],
        "lang" => $_POST['lang'],
        "position" => $_POST['position']
    ));

    $response = array(
        'msg' => 'Добавлен новый пункт меню'
    );

    echo json_encode($response);
    exit();
}

function saveMenuTypeDel() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $db->delete("menutype", [
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










function saveCategoryTypeAdd() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $last_id = $db->insert("categorytype", array(
        "title" => $_POST['title'],
        "name" => $_POST['name'],
        "lang" => $_POST['lang'],
        "position" => $_POST['position']
    ));

    $response = array(
        'msg' => 'Добавлен новый пункт меню'
    );

    echo json_encode($response);
    exit();
}

function saveCategoryTypeDel() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $db->delete("categorytype", [
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










function saveContentAdd() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $last_id = $db->insert("content", array(
        "alias" => 'NewRecord',
        "published" => 0,
        "category_id" => 2,
        "h1" => 'NewRecord',
        "lang" => 'ru',
    ));

    $response = array(
        'msg' => 'Добавлен новый пункт меню'
    );

    echo json_encode($response);
    exit();
}











function saveExtensionAdd() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $last_id = $db->insert("extension", array(
        "title" => 'new',
        "published" => 0
    ));

    $response = array(
        'msg' => 'Добавлен новый пункт меню'
    );

    echo json_encode($response);
    exit();
}

function saveExtensionDel() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $db->delete("menutype", [
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







function getModuleVisible() {
    global $langArrayU;
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: text/html; charset=utf-8');

    $articleRes = $db->select("content", '*', [
        "AND" => [
            "published" => 1
        ],
        "ORDER" => "publish_up DESC"
    ]);

    $menuTypeRes = $db->select("menutype", "*", [
            "AND" => [
                "published" => 1
            ]
        ]
    );
    foreach ($menuTypeRes as $key => $value) {
        $menuTypeRes[$value['id']]['params'] = json_decode($value['params'], true);
    }

    $menuRes_alt = $db->select("menu", "*", [
            "AND" => [
                "menu.published" => 1
            ]
        ]
    );
    foreach ($menuRes_alt as $key => $value) {
        $menuRes[$value['id']] = $value;
    }

    $catTypeRes = $db->select("categorytype", "*", [
            "AND" => [
                "published" => 1
            ]
        ]
    );

    foreach ($catTypeRes as $key => $value) {
        $catTypeRes[$value['id']]['params'] = json_decode($value['params'], true);
    }

    $catRes_alt = $db->select("category", "*", [
            "AND" => [
                "published" => 1
            ]
        ]
    );
    foreach ($catRes_alt as $key => $value) {
        $catRes[$value['id']] = $value;
    }

    $moduleRes = $db->get("module", "*", [
            "AND" => [
                "id" => $_POST['id']
            ]
        ]
    );
    $moduleRes['params'] = json_decode($moduleRes['params'], true);
    $moduleRes['visible'] = json_decode($moduleRes['visible'], true);

    $classActive1 = ($moduleRes['visible']['typeVis'] === 1)?'success active':'info';
    $classActive2 = ($moduleRes['visible']['typeVis'] === 2)?'success active':'info';
    $classActive3 = ($moduleRes['visible']['typeVis'] === 3)?'success active':'info';
    $classActive4 = ($moduleRes['visible']['typeVis'] === 4)?'success active':'info';

    $classActive5 = ($moduleRes['visible']['primary'] === 'menu')?'success active':'info';
    $classActive6 = ($moduleRes['visible']['primary'] === 'article')?'success active':'info';

    $html .= '
    <div class="btn-group" data-toggle="buttons">
        <label class="selectTypeVisBtn btn btn-xs btn-'.$classActive1.'">
            <input type="radio" name="options" id="option1" class="" value="1" data-name="typeVis" data-id="'.$moduleRes['id'].'" autocomplete="off"> On all pages
        </label>
        <label class="selectTypeVisBtn btn btn-xs btn-'.$classActive2.'">
            <input type="radio" name="options" id="option2" class="" value="2" data-name="typeVis" data-id="'.$moduleRes['id'].'" autocomplete="off"> No pages
        </label>
        <label class="selectTypeVisBtn btn btn-xs btn-'.$classActive3.'">
            <input type="radio" name="options" id="option3" class="" value="3" data-name="typeVis" data-id="'.$moduleRes['id'].'" autocomplete="off"> Only on the pages selected
        </label>
        <label class="selectTypeVisBtn btn btn-xs btn-'.$classActive4.'">
            <input type="radio" name="options" id="option4" class="" value="4" data-name="typeVis" data-id="'.$moduleRes['id'].'" autocomplete="off"> On all pages except those selected
        </label>
    </div>
    <div class="btn-group pull-right" data-toggle="buttons">
        <label class="selectTypeVisBtn btn btn-xs btn-'.$classActive5.'">
            <input type="radio" name="primary" id="option5" value="menu" data-name="primary" data-id="'.$moduleRes['id'].'" autocomplete="off"> Menu
        </label>
        <label class="selectTypeVisBtn btn btn-xs btn-'.$classActive6.'">
            <input type="radio" name="primary" id="option6" value="article" data-name="primary" data-id="'.$moduleRes['id'].'" autocomplete="off"> Article
        </label>
    </div>
    <hr>
    ';
    $html .= '<ul id="visibleByLang" class="nav nav-tabs" role="tablist">';
    foreach ($langArrayU as $key => $langValue) {
        $html .= '<li role="presentation" class="">
            <a href="#menu-'.$langValue.'" aria-controls="'.$langValue.'" role="tab" data-toggle="tab">Menu-'.$langValue.'</a></li>';
    }
    foreach ($langArrayU as $key => $langValue) {
        $html .= '<li role="presentation" class="">
            <a href="#article-'.$langValue.'" aria-controls="'.$langValue.'" role="tab" data-toggle="tab">Article-'.$langValue.'</a></li>';
    }
    $html .= '</ul>';
    $html .= '<div class="tab-content">';
    foreach ($langArrayU as $key => $langValue) {
        $html .= '<div role="tabpanel" class="tab-pane" id="menu-'.$langValue.'">';
        $html .= '<h3>Menu</h3>';
        foreach ($menuTypeRes as $menuValue) {
            if ($menuValue['lang'] == $langValue) {
                $html .= '<h4>'.$menuValue['title'].'</h4>';
                $html .= adminModuleVisibleBuild($menuTypeRes[$menuValue['id']]['params'], $menuRes, 'visMenu', $moduleRes);
            }
        }
        $html .= '<h3>Category</h3>';
        foreach ($catTypeRes as $catValue) {
            if ($catValue['lang'] == $langValue) {
                $html .= '<h4>'.$catValue['title'].'</h4>';
                $html .= adminModuleVisibleBuild($catTypeRes[$catValue['id']]['params'], $catRes, 'visCat', $moduleRes);
            }
        }
        $html .= '</div>';
    }
    foreach ($langArrayU as $key => $langValue) {
        $html .= '<div role="tabpanel" class="tab-pane" id="article-'.$langValue.'">';
        foreach ($articleRes as $articleVal) {
            if ($articleVal['lang'] == $langValue) {
                $retVal = (array_search($articleVal['id'], $moduleRes['visible']['visArticle']) === false || $moduleRes['visible']['visArticle'] === null)?'':' checked="checked"';
                $html .= '<div class="checkbox"><label><input class="selectTypeVis" type="checkbox" data-name="visArticle" data-id="'.$moduleRes['id'].'" name="article'.$articleVal['id'].'" value="'.$articleVal['id'].'" '.$retVal.'> '.$articleVal['h1'].' - '.$articleVal['id'].'</label></div>';
            }
        }
        $html .= '</div>';
    }
    $html .= '</div>';
    $html .= "
    <script>
        $(function() {
            $('.selectTypeVisBtn').on('click', function () {
                var ths = $(this),
                    sfind = ths.find('input'),
                    sPar = ths.parent(),
                    iID = parseInt(sfind.data('id')),
                    iVal = sfind.attr('value'),
                    iName = sfind.data('name');
                $.ajax({
                    type: 'POST',
                    url: '/sadmin/save/module/visible/',
                    data: {id: iID, value: iVal, name: iName}
                })
                .done(function(result) {
                    $('#outpuut').empty().html(result);
                    sPar.find('.btn-success').removeClass('btn-success').addClass('btn-info');
                    ths.removeClass('btn-info').addClass('btn-success');
                    sCMSAletr(result, 'success');
                });
            })
            $('.selectTypeVis').on('click', function () {
                var sfind = $(this),
                    iID = parseInt(sfind.data('id')),
                    iVal = parseInt(sfind.attr('value')),
                    iName = sfind.data('name');
                $.ajax({
                    type: 'POST',
                    url: '/sadmin/save/module/visible/',
                    data: {id: iID, value: iVal, name: iName}
                })
                .done(function(result) {
                    sCMSAletr(result, 'success');
                });
            })
            $('#visibleByLang a:first').tab('show');
        });
    </script>";

    echo $html;
    exit();
}
function saveModuleVisible() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: text/html; charset=utf-8');
    // header('Content-Type: application/json; charset=utf-8');

    /**
     *
     * 1 = On all pages
     * 2 = No pages
     * 3 = Only on the pages selected
     * 4 = On all pages except those selected
     *
     */

    $moduleRes = $db->get("module", "*", [
            "AND" => [
                "id" => $_POST['id']
            ]
        ]
    );

    $moduleRes['visible'] = json_decode($moduleRes['visible'], true);

    if ($_POST['name'] == 'visMenu' || $_POST['name'] == 'visCat' || $_POST['name'] == 'visArticle') {
        if (isset($moduleRes['visible'][$_POST['name']][$_POST['value']])) {
            unset($moduleRes['visible'][$_POST['name']][$_POST['value']]);
        } else {
            $moduleRes['visible'][$_POST['name']][$_POST['value']] = intval($_POST['value']);
        }
    } elseif ($_POST['name'] == 'primary') {
        $moduleRes['visible'][$_POST['name']] = $_POST['value'];
        echo $_POST['value'];
    } elseif ($_POST['name'] == 'typeVis') {
        $moduleRes['visible'][$_POST['name']] = intval($_POST['value']);
    }

    $db->update("module", [
            "visible" => json_encode($moduleRes['visible'])
        ], [
            "AND" => [
                "id" => $_POST['id']
            ]
        ]
    );

    exit();
}

function getModuleParams() {
    global $rd;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: text/html; charset=utf-8');

    $modRes = $db->get("module", [
        "[>]extension" => ["extension_id" => "id"]
    ], [
        "module.id",
        "module.title",
        "module.description",
        "module.published",
        "module.ordering",
        "module.position",
        "module.lang",
        "module.view",
        "module.visible",
        "module.params",
        "extension.id(extension_id)",
        "extension.title(extension_title)",
        "extension.type(extension_type)",
        "extension.fileName(extension_fileName)",
        "extension.function(extension_function)",
        "extension.published(extension_published)",
        "extension.params(extension_params)",
    ], [
            "module.id" => $_POST['id']
        ]
    );

    $categoryRes = $db->get("category", '*', [
        "published" => 1
    ]);

    $categoryTypeRes = $db->get("categorytype", '*', [
        "published" => 1
    ]);

    $articleRes = $db->select("content", '*', [
        "AND" => [
            "published" => 1,
            "lang" => $modRes['lang']
        ],
        "ORDER" => "publish_up DESC"
    ]);

    $modRes['params'] = json_decode($modRes['params'], true);
    $tempCategoryTypeRes = $db->get("categorytype", '*', [
        "id" => $modRes['params']['categorytype']
    ]);
    $modRes['params']['_categorytype_title'] = $tempCategoryTypeRes['title'];

    $tempMenuTypeRes = $db->get("menutype", '*', [
        "id" => $modRes['params']['menutype']
    ]);
    $modRes['params']['_menutype_title'] = $tempMenuTypeRes['title'];

    $modRes['visible'] = json_decode($modRes['visible'], true);
    $modRes['extension_params'] = json_decode($modRes['extension_params'], true);

    $modPath = A_AJAX.$modRes['extension_fileName'].'/extension-'.$modRes['extension_fileName'].'.php';

    // var_dump($db->log());
    // var_dump($db->error());

    include $modPath;

    exit();
}
function saveModuleParams() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    // header('Content-Type: text/html; charset=utf-8');
    header('Content-Type: application/json; charset=utf-8');

    $modRes = $db->get("module", "*", ["id" => $_POST['id']]);

    $modRes['params'] = json_decode($modRes['params'], true);

    if ($_POST['name'] == 'links') {
        $modRes['params'][$_POST['name']][$_POST['value']] = intval($_POST['value']);
    }

    $db->update("module", [
            "params" => json_encode($modRes['params'])
        ], [
            "id" => $_POST['id']
        ]
    );

    exit();
}

function saveModuleAdd() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $last_id = $db->insert("module", array(
        "title" => $_POST['title'],
        "extension_id" => $_POST['extension_id'],
        "lang" => $_POST['lang'],
        "published" => 0
    ));

    $response = array(
        'msg' => 'Добавлен новый пункт меню'
    );

    echo json_encode($response);
    exit();
}

function saveModuleDel() {
    global $match;
    global $db;

    if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    header('Content-Type: application/json; charset=utf-8');

    $db->delete("menutype", [
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







