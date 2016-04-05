<?php
/**
 * @package     sCMS.Module
 * @subpackage  mod_link-favorite
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

$modUsefulArticle = $db->select("content", [
        "id",
        "alias",
        "h1",
        "hits"
    ], [
        "id" => $modRes['params']['links'],
        "ORDER" => array('hits DESC'),
        "LIMIT" => 6
    ]);

include $modPathView;
?>