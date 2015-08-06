<?php
require_once $_SERVER['DOCUMENT_ROOT']."/configuration.php";
require_once P_CFG."routers.php";

if ($res->qMenuCurr->method === 'POST') {
    include $res->fileName;
    exit();
} elseif ($res->qMenuCurr->extension_id === '8') {
    require_once P_TMP."_head.php";
    include $res->fileName;
    require_once P_TMP."_ender.php";
    exit();
} elseif ($res->qMenuCurr->extension_id === '12') {
    include $res->fileName;
    exit();
}

require_once P_TMP."_template.php";

/* Debuging */
if (isset($_GET['d'])) {
    echo '<div class="debug"><pre>';
    print_r($res);
    echo '</pre></div>';
}
/**/
