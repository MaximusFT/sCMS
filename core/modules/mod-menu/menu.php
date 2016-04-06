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
function frontMenuBuild($params, $res, $active) {
    $html = '';
    foreach($params as $key => $value) {
        $i == 0;
        foreach($value as $key => $index) {
            $i++;
            if($key == 'id') $tempId = $index;
            if ($res[$value['id']]['id'] == $value['id']) {
                $url = menuLinkBuilder('menu', $res[$value['id']]['id']);
                $title = $res[$value['id']]['title'];
                $alias = ($active == $res[$value['id']]['alias'])?' active':'';
                if(is_array($index)) {
                    $html .= '
                    <li class="btn-group'.$alias.'">
                        <a href="'.$url.'" class="btn">'.$title.'</a>
                        <a href="#" class="dropdown-toggle btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
                    <ul class="dropdown-menu">';
                    $html .= frontMenuBuild($index, $res, $active);
                    $html .= '</ul></li>';
                } else {
                    if ($i !== 1) $html .= '</li>';
                    if (is_array($value['children'])) {
                    } else {
                		$title = $res[$index]['title'];
		                $alias = ($active == $res[$index]['alias'])?' class="active"':'';
                        $html .= '<li'.$alias.'><a href="'.$url.'">'.$title.'</a>';
                    }
                }
            }
        }
    }
    $html .= '</li>';
    return $html;
}

echo frontMenuBuild(json_decode($res->menuItems->$modRes['params']['menutype']->params, true), json_decode(json_encode($res->menuItems->$modRes['params']['menutype']->items), true), $res->menuItemCurrent->alias);

// include $modPathView;
?>