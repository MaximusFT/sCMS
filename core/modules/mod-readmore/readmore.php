<?php
/**
 * @package     sCMS.Module
 * @subpackage  mod_readmore
 *
 * @copyright   Copyright (C) 2005-2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * $res - global variable
 * $db - global variable to use MySQL
 * $rd - global variable to use TimeFormat
 * $modRes - main variable with all params by Module
 */

defined('ISsCMS') or die;

$res->contentCurrent->readmore = json_decode($res->contentCurrent->readmore, true);

$modReadMore = $db->select("content", [
        "id",
        "alias",
        "h1",
        "image",
        "hits"
    ], [
        "id" => $res->contentCurrent->readmore['links']
    ]);

if ($modReadMore) {
    include $modPathView;
}
?>
