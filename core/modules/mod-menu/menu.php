<?php
/**
 * @package     sCMS.Module
 * @subpackage  mod_menu
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

/**
 * @param 	JSON 	$params This is JSON structure menuitems
 * @param 	Array 	$res 	Array with menu items
 * @param 	String 	$active Alias menu item that is Active
 * @return 	HTML 			Return builded HTML
 */

$tempMenuTypeRes = $db->get("menutype", '*', [
    "id" => $modRes['params']['menutype']
]);
$modRes['params']['_menutype_name'] = $tempMenuTypeRes['name'];

echo frontMenuBuild(json_decode($res->menuItems->$modRes['params']['_menutype_name']->params, true), json_decode(json_encode($res->menuItems->$modRes['params']['_menutype_name']->items), true), $res->menuItemCurrent->alias);

// include $modPathView;
?>