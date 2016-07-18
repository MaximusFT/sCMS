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
if ($modRes['params']['onlyDeep'] == true) {
	/*
	echo '<pre>';
	echo $currCat;
	print_r($CatType);
	echo '<hr>';
	$qwe = arrayRecSearchArr($CatType[0]['children'], $currCat);
	echo gettype($qwe);
	echo '<hr>';
	print_r($qwe);
	echo '</pre>';
	*/
echo '
<div class="panel">
    <div class="panel-heading">
    	<h3 class="panel-title"><a href="'.menuLinkBuilder('category', $currCat).'">'.$CatItems[$currCat]['title'].'</a></h3>
    </div>
    <ul class="list-group">
';
	echo frontMenuBuildCategory(arrayRecSearchArr($CatType, $currCat), $CatItems, $currCat, $modRes['params']);
echo '
    </ul>
</div>
';
} else {
echo '
<div class="panel">
    <div class="panel-heading">
    	<h3 class="panel-title"><a href="'.menuLinkBuilder('category', $CatType[0]['id']).'">'.$CatItems[$CatType[0]['id']]['title'].'</a></h3>
    </div>
    <ul class="list-group">
';
	echo frontMenuBuildCategory($CatType[0]['children'], $CatItems, $currCat, $modRes['params']);
echo '
    </ul>
</div>
';
}

// include $modPathView;
?>