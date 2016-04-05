<?php
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
    include $res->fileName;
    exit();
} elseif ($res->menuItemCurrent->extension_id === '6') {
    require_once P_TEMP."_head.php";
    include $res->fileName;
    require_once P_TEMP."_ender.php";
    exit();
} elseif ($res->menuItemCurrent->extension_id === '8') {
    include $res->fileName;
    exit();
}

require_once P_TEMP."_template.php";

/* Debuging */
if (isset($_GET['d'])) {
    echo '<div class="debug"><pre>';
    // print_r($router);
    print_r($res);
    echo '</pre></div>';
}
/*
*/
