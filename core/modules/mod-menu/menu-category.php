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

$currCat = ($res->categoryCurrent->id) ? $res->categoryCurrent->id : null ;
$CatType = json_decode($res->categoryItems->$modRes['params']['categorytype']->params, true);
$CatItems = json_decode(json_encode($res->categoryItems->$modRes['params']['categorytype']->items), true);
$CatOneLevel = $res->categoryItems->$modRes['params']['oneLevel'] || false;
echo '
<div class="panel panel-warning nav-category">
    <div class="panel-heading">
    	<a href="'.menuLinkBuilder('category', $CatType[0]['id']).'">'.$CatItems[$CatType[0]['id']]['title'].'</a>
    </div>
    <ul class="list-group">
';
echo frontMenuBuildCategory($CatType[0]['children'], $CatItems, $currCat, $CatOneLevel);
echo '
    </ul>
</div>
';

// include $modPathView;
?>