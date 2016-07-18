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

$modPopularArticle = $db->select("content", [
        "id",
        "alias",
        "h1",
        "hits"
    ], [
        "AND" => [
            "category_id[!]" => [1, 2],
            "published" => 1,
        	"lang" => USER_LANG,
        ],
        "ORDER" => array('publish_up DESC'),
        "LIMIT" => 5
    ]);

include $modPathView;
?>