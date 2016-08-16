<?
require_once $_SERVER['DOCUMENT_ROOT']."/configuration.php";
if (IS_LANG === true) {
    if (!in_array($langUrl, $langArrayA)) {
    	header('HTTP/1.1 301 Moved Permanently');
    	header('Location: '.S_URLh.USER_LANG.'/');
    	exit();
    }
}
require_once P_CORE."routers.php";

if ($res->menuItemCurrent->method === 'POST') {
    include $res->extensionCurrent->fileName;
    exit();
} elseif ($res->menuItemCurrent->extension_id === '6') {
    require_once P_TEMP."_head.php";
    include $res->extensionCurrent->fileName;
    require_once P_TEMP."_ender.php";
    exit();
} elseif ($res->menuItemCurrent->extension_id === '8') {
    include $res->extensionCurrent->fileName;
    exit();
}

require_once P_TEMP."_template.php";

/* Debuging */
// if (isset($_GET['d'])) {
    echo '<div class="debug"><pre>';
    // print_r($router->getRoutesNamed());
    // print_r($router);
    // echo '<hr>';
    // print_r(get_defined_constants(true));
    echo '<hr>';
    print_r($res->user->Username);
    echo '<hr>';
    print_r($res);
    echo '</pre></div>';
// }
/*
*/
