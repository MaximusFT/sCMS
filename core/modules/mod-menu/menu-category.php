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
function frontMenuBuildCategory($params, $res, $active = null) {
    $html = '';
    foreach($params as $key => $value) {
        $i == 0;
        foreach($value as $key => $index) {
            $i++;
            if($key == 'id') $tempId = $index;
            if ($res[$value['id']]['id'] == $value['id']) {
                $url = menuLinkBuilder('category', $res[$value['id']]['id']);
                $id = $res[$value['id']]['id'];
                $title = $res[$value['id']]['title'];
                $alias = ($active == $res[$value['id']]['alias'])?' active':'';
                if(is_array($index)) {
                    $html .= '
                    <li role="presentation" class="list-group-item '.$alias.'">
                        <a class="collapsed" role="button" data-toggle="collapse" href="#coll'.$alias.$id.'" aria-expanded="false" aria-controls="coll'.$alias.$id.'"><span class="caret"></span></a>
                        <a href="'.$url.'" class="">'.$title.'</a>
                    <ul id="coll'.$alias.$id.'" class="list-group collapse" aria-labelledby="coll'.$alias.$id.'Heading" aria-expanded="true">';
                    $html .= frontMenuBuildCategory($index, $res, $active);
                    $html .= '</ul></li>';
                } else {
                    if ($i !== 1) $html .= '</li>';
                    if (is_array($value['children'])) {
                    } else {
                		$title = $res[$index]['title'];
		                $alias = ($active == $res[$index]['alias'])?' active':'';
                        $html .= '<li class="list-group-item '.$alias.'">
                            <a><span class="glyphicon glyphicon-link" aria-hidden="true"></span></a>
                            <a href="'.$url.'">'.$title.'</a>';
                    }
                }
            }
        }
    }
    $html .= '</li>';
    return $html;
}
$currCat = ($res->categoryCurrent->id) ? $res->categoryCurrent->id : null ;
$CatType = json_decode($res->categoryItems->$modRes['params']['categorytype']->params, true);
$CatItems = json_decode(json_encode($res->categoryItems->$modRes['params']['categorytype']->items), true);
echo '
<div class="panel panel-warning nav-category">
    <div class="panel-heading">'.$CatItems[$CatType[0]['id']]['title'].'</div>
    <ul class="list-group">
';
echo frontMenuBuildCategory($CatType[0]['children'], $CatItems, $currCat);
echo '
    </ul>
</div>
';

// include $modPathView;
?>