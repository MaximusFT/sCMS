<?php
require_once $_SERVER['DOCUMENT_ROOT']."/configuration.php";
require_once P_CORE."routers.php";

if ($res->qMenuCurr->method === 'POST') {
    include $res->fileName;
    exit();
} elseif ($res->qMenuCurr->extension_id === '6') {
    require_once P_TEMP."_head.php";
    include $res->fileName;
    require_once P_TEMP."_ender.php";
    exit();
} elseif ($res->qMenuCurr->extension_id === '8') {
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
/**/
