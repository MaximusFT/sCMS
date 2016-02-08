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
$router->map( 'GET', '/content/', 'ContentCrtl', 'content');
$router->map( 'GET', '/content/[i:id]/', 'ContentOneCrtl', 'contentone');
$router->map( 'GET', '/module/', 'ModuleCrtl', 'module');
$router->map( 'GET', '/extension/', 'ExtensionCrtl', 'extension');
$router->map( 'GET', '/comments/', 'CommentsCrtl', 'comments');
$router->map( 'GET', '/subscribers/', 'SubscribersCrtl', 'subscribers');
$router->map( 'GET', '/askings/', 'AskingsCrtl', 'askings');

$router->map( 'GET', '/menu/', 'MenuCrtl', 'menu');

$router->map('POST', '/content/csv-to-mysql/', 'appCSVtoMysql', 'content-csv-to-mysql');
$router->map( 'GET', '/content/mysql-to-csv/', 'appMysqlToCSV', 'content-mysql-to-csv');

$router->map(' GET', '/people/', 'PeoplesCrtl', 'peoples');
$router->map(' GET', '/people/[i:id]/', 'PeopleCrtl', 'people');
$router->map('POST', '/people/add/', 'PeopleAddCrtl', 'people-add');
$router->map(' GET', '/people/edit/[i:id]/', 'PeopleEditCrtl', 'people-edit');

$router->map(' GET', '/family/', 'FamiliesCrtl', 'families');

$router->map( 'GET', '/print/', 'PrintsCrtl', 'prints');
$router->map( 'GET', '/print/[i:id]/', 'PrintCrtl', 'print');

$router->map('POST', '/printrem/[i:id]/', 'PrintRemoveCrtl', 'print-remove');

/**
 * SAVE Route
 */
$router->map('POST|PUT','/save/', 'saveToDB', 'save-to-db', null, 'ajax');
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
$router->map('GET|POST',    '/get/group/[*:table]/[*:table_name]/[*:table_cond]/[*:table_param]/', 'getFromDBSelect', 'get-from-db-select', null, 'ajax');
$router->map('GET|POST',    '/get/typeahead/[*:table]/[*:table_col]/[*:table_cond]/', 'getTypeAHead', 'get-typea-head', null, 'ajax');
$router->map('GET|POST',    '/get/typeaheadmf/[*:cond]/', 'getTypeAHeadMF', 'get-typea-head-mf', null, 'ajax');

$router->map('GET|POST',    '/get/prints/[*:id]', 'getPrintsCrtl', 'get-prints');

$match = $router->match();

if ($match['type'] === 'view' || $match['type'] === null){
	$pathTo = A_VIEW;
} elseif ($match['type'] === 'ajax'){
	$pathTo = A_AJAX;
}


if($match && is_callable($match['target'])) {
    $res = call_user_func_array($match['target'], $match['params']);
    $res = json_decode(json_encode($res), FALSE);
    require_once A_TEMP."_template.php";
} else {
    header( $_SERVER["SERVER_PROTOCOL"] . ' 404 Not Found');
    require_once A_TEMP."_template-404.php";
    exit();
}

/* Debuging */
if (isset($_GET['d'])) {
    echo '<div class="debug"><pre>';
    print_r($res);
    echo '</pre></div>';
}
/**/