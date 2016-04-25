<?php
require_once $_SERVER['DOCUMENT_ROOT']."/configuration.php";
require_once A_CORE."index.php";

/**
 * Route settings
 * @var AltoRouter
 */

$router = new AltoRouter();
$router->setBasePath('/sadmin');

// $router->map('GET|POST','/', 'home#index', 'home');
// Example: GET|POST|PATCH|PUT|DELETE

/**
 * PAGES Route
 */
$router->map( 'GET', '/', 'AdminCrtl', 'sadmin');
$router->map( 'GET', '/comments/', 'CommentsCrtl', 'comments');
$router->map( 'GET', '/subscribers/', 'SubscribersCrtl', 'subscribers');
$router->map( 'GET', '/askings/', 'AskingsCrtl', 'askings');


$router->map('POST|GET', '/menu/', 'MenuCrtl', 'menu');
$router->map('POST|PUT', '/save/menutype/add/', 'saveMenuTypeAdd', 'save-menutype-add', null, 'ajax');
$router->map('POST|PUT', '/save/menutype/del/', 'saveMenuTypeDel', 'save-menutype-del', null, 'ajax');


$router->map('POST|GET', '/menu/[i:type]/', 'MenuOneCrtl', 'menuone');
$router->map('POST|PUT', '/save/menu/homepage/', 'saveMenuHomepage', 'save-menu-homepage', null, 'ajax');
$router->map('POST|PUT', '/save/menu/add/', 'saveMenuAdd', 'save-menu-add', null, 'ajax');
$router->map('POST|PUT', '/save/menu/del/', 'saveMenuDel', 'save-menu-del', null, 'ajax');
$router->map('POST|PUT', '/save/menu/refresh/', 'saveMenuRefresh', 'save-menu-refresh', null, 'ajax');


$router->map('POST|GET', '/content/', 'ContentCrtl', 'content');
$router->map('POST|GET', '/content/[i:id]/', 'ContentOneCrtl', 'contentone');
$router->map('POST|PUT', '/save/content/add/', 'saveContentAdd', 'save-content-add', null, 'ajax');
$router->map('POST|PUT', '/save/content/del/', 'saveContentDel', 'save-content-del', null, 'ajax');
$router->map('POST', '/content/csv-to-mysql/', 'appCSVtoMysql', 'content-csv-to-mysql');
$router->map( 'GET', '/content/mysql-to-csv/', 'appMysqlToCSV', 'content-mysql-to-csv');


$router->map('POST|GET', '/extension/', 'ExtensionCrtl', 'extension');
$router->map('POST|PUT', '/save/extension/add/', 'saveExtensionAdd', 'save-extension-add', null, 'ajax');
$router->map('POST|PUT', '/save/extension/del/', 'saveExtensionDel', 'save-extension-del', null, 'ajax');


$router->map('POST|GET', '/module/', 'ModuleCrtl', 'module');
$router->map('POST|GET', '/get/module/visible/', 'getModuleVisible', 'get-module-visible', null, 'ajax');
$router->map('POST|GET', '/get/module/params/', 'getModuleParams', 'get-module-params', null, 'ajax');
$router->map('POST|GET', '/save/module/visible/', 'saveModuleVisible', 'save-module-visible', null, 'ajax');
$router->map('POST|GET', '/save/module/params/', 'saveModuleParams', 'save-module-params', null, 'ajax');
$router->map('POST|PUT', '/save/module/add/', 'saveModuleAdd', 'save-module-add', null, 'ajax');
$router->map('POST|PUT', '/save/module/del/', 'saveModuleDel', 'save-module-del', null, 'ajax');


$router->map('POST|GET', '/category/', 'CategoryCrtl', 'category');
$router->map('POST|PUT', '/save/categorytype/add/', 'saveCategoryTypeAdd', 'save-categorytype-add', null, 'ajax');
$router->map('POST|PUT', '/save/categorytype/del/', 'saveCategoryTypeDel', 'save-categorytype-del', null, 'ajax');


$router->map('POST|GET', '/category/[i:type]/', 'CategoryOneCrtl', 'categoryone');
$router->map('POST|PUT', '/save/category/add/', 'saveCategoryAdd', 'save-category-add', null, 'ajax');
$router->map('POST|PUT', '/save/category/del/', 'saveCategoryDel', 'save-category-del', null, 'ajax');
$router->map('POST|PUT', '/save/category/refresh/', 'saveCategoryRefresh', 'save-category-refresh', null, 'ajax');


$router->map(' GET', '/people/', 'PeoplesCrtl', 'peoples');
$router->map(' GET', '/people/[i:id]/', 'PeopleCrtl', 'people');
$router->map('POST|PUT', '/people/add/', 'PeopleAddCrtl', 'people-add');
$router->map(' GET', '/people/edit/[i:id]/', 'PeopleEditCrtl', 'people-edit');

$router->map(' GET', '/family/', 'FamiliesCrtl', 'families');

$router->map( 'GET', '/print/', 'PrintsCrtl', 'prints');
$router->map( 'GET', '/print/[i:id]/', 'PrintCrtl', 'print');

$router->map('POST', '/printrem/[i:id]/', 'PrintRemoveCrtl', 'print-remove');

/**
 * SAVE Route
 */
$router->map('POST|PUT','/save/', 'saveToDB', 'save-to-db', null, 'ajax');
$router->map('POST|PUT','/save/params/', 'saveToDBParams', 'save-to-db-params', null, 'ajax');
$router->map('POST|PUT','/saveth/', 'saveToDBTypeHead', 'save-to-db-th', null, 'ajax');
$router->map('POST|PUT','/savemf/', 'saveToDBMF', 'save-to-db-mf', null, 'ajax');
$router->map('POST|PUT','/save/check/', 'saveToDBCheck', 'save-to-db-check', null, 'ajax');

$router->map('POST|PUT','/save/list/[*:col]/', 'saveListItem', 'save-list-item', null, 'ajax');

$router->map('POST|PUT','/save/copyar/', 'saveCopyAR', 'save-copy-ar', null, 'ajax');
$router->map('POST|PUT','/save/people/add/', 'savePeopleAdd', 'save-people-add', null, 'ajax');
$router->map('POST|PUT','/save/family/add/', 'saveFamilyAdd', 'save-family-add', null, 'ajax');
$router->map('POST|PUT','/save/family/people/add/', 'saveFamilyPeopleAdd', 'save-family-people-add', null, 'ajax');

/**
 * AJAX Route
 */
$router->map('GET|POST',    '/get/data/[*:table]/[*:tmpl]/', 'getFromDB', 'get-from-db', null, 'ajax');
$router->map('GET|POST',    '/get/list/[*:table]/[*:tmpl]/', 'getListDB', 'get-list-db', null, 'ajax');
$router->map('GET|POST',    '/get/group/static/[*:title]/', 'getFromDBSelectStatic', 'get-from-db-select-static', null, 'ajax');
$router->map('GET|POST',    '/get/group/simple/[*:table]/[*:table_name]/', 'getFromDBSimpleSelect', 'get-from-db-simple-select', null, 'ajax');
$router->map('GET|POST',    '/get/group/[*:table]/[*:table_name]/[*:table_cond]/[*:table_param]/', 'getFromDBSelect', 'get-from-db-select', null, 'ajax');
$router->map('GET|POST',    '/get/typeahead/[*:table]/[*:table_col]/[*:table_cond]/', 'getTypeAHead', 'get-typea-head', null, 'ajax');
$router->map('GET|POST',    '/get/typeaheadlang/[*:table]/[*:table_col]/[*:table_cond]/[*:lang]/', 'getTypeAHeadLang', 'get-typea-head-lang', null, 'ajax');
$router->map('GET|POST',    '/get/typeaheadmf/[*:cond]/', 'getTypeAHeadMF', 'get-typea-head-mf', null, 'ajax');

$router->map('GET|POST',    '/get/prints/[*:id]', 'getPrintsCrtl', 'get-prints');

// get Translit from POST params
$router->map('GET|POST',    '/get/translit/', 'getTranslit', 'get-translit');
$router->map('GET|POST',    '/get/translit/alias/', 'getTranslitAlias', 'get-translit-alias');

$match = $router->match();

if ($match['type'] === 'view' || $match['type'] === null){
	$pathTo = A_VIEW;
} elseif ($match['type'] === 'ajax'){
	$pathTo = A_AJAX;
}

if($match && is_callable($match['target'])) {
    $res = call_user_func_array($match['target'], $match['params']);
    $res = json_decode(json_encode($res), FALSE);

    if ($match['method'] === 'POST' && $res->appGoPost === true) {
        include A_VIEW.$res->pageContent;
        exit();
    }

    require_once A_TEMP."_template.php";
} else {
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    require_once A_TEMP."_template-404.php";
    exit();
}

/* Debuging */
if (isset($_GET['d'])) {
    echo '<div class="debug"><pre>';
    // print_r($router);
    print_r($match);
    print_r($res);
    echo '</pre></div>';
}
/**/