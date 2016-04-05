<?php
/**
 * Function for call modules from position
 * @param  string $type [description]
 * @param  string $pos  [description]
 * @return [type]       [description]
 */
function funPos($type='', $pos=''){
    global $db;
    global $rd;
    global $res;

    if (!$db->has("module", array("position" => $pos))) return false;
    $qRes = $db->select("module", [
        "[>]extension" => ["extension_id" => "id"]
    ], [
        "module.id",
        "module.title",
        "module.description",
        "module.published",
        "module.ordering",
        "module.position",
        "module.view",
        "module.visible",
        "module.params",
        "extension.id(extension_id)",
        "extension.title(extension_title)",
        "extension.type(extension_type)",
        "extension.fileName(extension_fileName)",
        "extension.function(extension_function)",
        "extension.enabled(extension_enabled)",
        "extension.params(extension_params)",
    ], [
            "AND" => [
                "lang" => USER_LANG,
                "position" => $pos,
                "published" => 1
            ]
        ]
    );
    foreach ($qRes as $key => $value) {
        $modRes = $qRes[$key];
        $modRes['visible'] = json_decode($modRes['visible'], true);
        $modRes['params'] = json_decode(stripslashes($modRes['params']), true);
        if ($modRes['extension_id'] == 16) {
            echo frontMenuBuild(json_decode($res->menuItems->$modRes['params']['menutype']->params, true), json_decode(json_encode($res->menuItems->$modRes['params']['menutype']->items), true), $res->menuItemCurrent->alias);
        } else {
            if ($modRes['view'] == 'default') {
                $view = '';
            } else {
                $view = '-'.$modRes['view'];
            }
            $modPath = P_MODL.'mod-'.$modRes['extension_fileName'].'/'.$modRes['extension_fileName'].$view.'.php';
            $modPathView = P_MODL.'mod-'.$modRes['extension_fileName'].'/view-'.$modRes['extension_fileName'].$view.'.php';

            if ($modRes['visible']['typeVis'] == 1) {
                include $modPath;
            } elseif ($modRes['visible']['typeVis'] == 3) {
                if ($modRes['visible']['primary'] == 'menu') {
                    if (in_array($res->menuItemCurrent->id, $modRes['visible']['visMenu']) || in_array($res->menuItemCurrent->id, $modRes['visible']['visCat'])) {
                        include $modPath;
                    } else {
                        continue;
                    }
                } elseif ($modRes['visible']['primary'] == 'article') {
                    if (in_array($res->contentCurrent->id, $modRes['visible']['visArticle'])) {
                        include $modPath;
                    }
                }
            } elseif ($modRes['visible']['typeVis'] == 4) {
                if ($modRes['visible']['primary'] == 'menu') {
                    if (!in_array($res->menuItemCurrent->id, $modRes['visible']['visMenu']) || !in_array($res->menuItemCurrent->id, $modRes['visible']['visCat'])) {
                        include $modPath;
                    } else {
                        continue;
                    }
                } elseif ($modRes['visible']['primary'] == 'article') {
                    if (!in_array($res->contentCurrent->id, $modRes['visible']['visArticle'])) {
                        include $modPath;
                    }
                }
            } elseif ($modRes['visible']['typeVis'] == 2) {
                    continue;
            }
        }
    }
}

/**
 * Function for Logging
 * @param  string $varName  [description]
 * @param  string $varValue [description]
 * @return [type]           [description]
 */
function logos($varName="", $varValue=""){
    $f = fopen($_SERVER["DOCUMENT_ROOT"]."/sadmin/logos.log", "a+");
    if ($varName == TRUE && $varValue == FALSE) {
        // Simple message
        // logos("Hi it`s simple message");
        fwrite($f,date("Y-m-d H:i:s")."\t--> ".$varName."\n");
    } else if ($varName == FALSE && $varValue == TRUE) {
        // Title for Log
        // logos("","Important H1");
        fwrite($f,date("Y-m-d H:i:s")."\t\n###############\n--> ".$varValue."\n###############\n");
    } else if ($varName == FALSE && $varValue == FALSE) {
        // This is a divider
        // logos();
        fwrite($f,date("Y-m-d H:i:s")."\t\n--------------------------------------------------------------------------------\n\n"); // записываем
    } else if ($varName == TRUE && $varValue == TRUE) {
        // 
        // logos("Variable","Value");
        fwrite($f,date("Y-m-d H:i:s")."\t ".$varName." = ".$varValue."\n");
    }
    fclose($f);
}


/**
 * Function for controling ADV
 * @param [type] $position [description]
 * @param [type] $type     [description]
 * @param string $addCss   [description]
 */
function ModAdv($position, $type, $addCss = '') {
	if (ADVIS == true) {
		$eh = '<div class="text-center '.$addCss.'"><img src="http://placehold.it/'.$type.'" alt=""></div>';
		if ($position == 'aside') {
			$eh .= '<hr>';
		} elseif ($position == 'article') {
		}
		return $eh;
	} else {
		return '';
	}
};

/**
 * Quick Ask To DB to find a need Page
 * @param  [type] $match [description]
 * @return [type]        [description]
 */
function qToDB($match){
    global $db;
    $qRes = $db->select("page", [
        "params"
    ], [
        "alias[=]" => $match['name']
    ]);
    return json_decode($qRes['0']['params'], true);
}

/**
 * CSV to Array convertor
 * @param  string $filename  [description]
 * @param  string $delimiter [description]
 * @return [type]            [description]
 */
function csv_to_array($filename='', $delimiter=',') {
    if(!file_exists($filename) || !is_readable($filename)) return FALSE;
    
    $header = NULL;
    $data = array();
    if (($handle = fopen($filename, 'r')) !== FALSE)
    {
        while (($row = fgetcsv($handle, 0, $delimiter)) !== FALSE)
        {
            if(!$header)
                $header = $row;
            else
                $data[] = array_combine($header, $row);
        }
        fclose($handle);
    }
    return $data;
}

/**
 * Translit function
 * @param  [type] $st [description]
 * @return [type]     [description]
 */
function translit($st, $ru = true) {
    $translit = [
        'а' => 'a',     'б' => 'b',     'в' => 'v',
        'г' => 'g',     'д' => 'd',     'е' => 'e',
        'ё' => 'yo',    'ж' => 'zh',    'з' => 'z',
        'и' => 'i',     'й' => 'j',     'к' => 'k',
        'л' => 'l',     'м' => 'm',     'н' => 'n',
        'о' => 'o',     'п' => 'p',     'р' => 'r',
        'с' => 's',     'т' => 't',     'у' => 'u',
        'ф' => 'f',     'х' => 'h',     'ц' => 'ts',
        'ч' => 'ch',    'ш' => 'sh',    'щ' => 'shc',
        'ь' => '\'',    'ы' => 'y\'',   'ъ' => '',
        'э' => 'e\'',   'ю' => 'yu',    'я' => 'ya',
        'А' => 'A',     'Б' => 'B',     'В' => 'V',
        'Г' => 'G',     'Д' => 'D',     'Е' => 'E',
        'Ё' => 'Yo',    'Ж' => 'Zh',    'З' => 'Z',
        'И' => 'I',     'Й' => 'J',     'К' => 'K',
        'Л' => 'L',     'М' => 'M',     'Н' => 'N',
        'О' => 'O',     'П' => 'P',     'Р' => 'R',
        'С' => 'S',     'Т' => 'T',     'У' => 'U',
        'Ф' => 'F',     'Х' => 'H',     'Ц' => 'Ts',
        'Ч' => 'Ch',    'Ш' => 'Sh',    'Щ' => 'Shc',
        'Ь' => '\'',    'Ы' => 'Y\'',   'Ъ' => '',
        'Э' => 'E\'',   'Ю' => 'Yu',    'Я' => 'Ya',
    ];
    if ($ru == true) {
        $res = strtr(trim($st), $translit);
    } else {
        $res = strtr(trim($st), array_flip($translit));
    }

  return $res;
}
function translitlow($st, $ru = true) {
    $translit = [
        'а' => 'a',     'б' => 'b',     'в' => 'v',
        'г' => 'g',     'д' => 'd',     'е' => 'e',
        'ё' => 'yo',    'ж' => 'zh',    'з' => 'z',
        'и' => 'i',     'й' => 'j',     'к' => 'k',
        'л' => 'l',     'м' => 'm',     'н' => 'n',
        'о' => 'o',     'п' => 'p',     'р' => 'r',
        'с' => 's',     'т' => 't',     'у' => 'u',
        'ф' => 'f',     'х' => 'h',     'ц' => 'ts',
        'ч' => 'ch',    'ш' => 'sh',    'щ' => 'shc',
        'ь' => '',      'ы' => 'y',     'ъ' => '',
        'э' => 'e',     'ю' => 'yu',    'я' => 'ya',
        'А' => 'a',     'Б' => 'b',     'В' => 'v',
        'Г' => 'g',     'Д' => 'd',     'Е' => 'e',
        'Ё' => 'yo',    'Ж' => 'zh',    'З' => 'z',
        'И' => 'i',     'Й' => 'j',     'К' => 'k',
        'Л' => 'l',     'М' => 'm',     'Н' => 'n',
        'О' => 'o',     'П' => 'p',     'Р' => 'r',
        'С' => 's',     'Т' => 't',     'У' => 'u',
        'Ф' => 'f',     'Х' => 'h',     'Ц' => 'ts',
        'Ч' => 'ch',    'Ш' => 'sh',    'Щ' => 'shc',
        'Ь' => '',      'Ы' => 'y',     'Ъ' => '',
        'Э' => 'e',     'Ю' => 'yu',    'Я' => 'ya',
        ' ' => '-',     ':' => '',      ';' => '',
        '"' => '',      '“' => '',      '”' => '',
        '«' => '',      '»' => '',      '.' => '',
        '?' => '',      '!' => '',      '$' => ''
    ];
    if ($ru == true) {
        $res = strtr(trim($st), $translit);
    } else {
        $res = strtr(trim($st), array_flip($translit));
    }

  return strtolower($res);
}

/**
 * Page views function
 */
function Analyze() {
    global $db;
    global $res;

	$ip = getenv("REMOTE_ADDR");
	$os = getenv("HTTP_USER_AGENT");
	$host = getenv("REMOTE_HOST");
	$page = getenv("HTTP_REFERER");
    $time = date("Y-m-d G:i:s", time());

    $qR = $db->select("statistics", "*", [
        "ip[=]" => $ip,
        "ORDER" => "id DESC",
        "LIMIT" => 1
    ]);

	$diffTime = strtotime($time) - strtotime($qR[0]['date']);

    if ($diffTime > 600) {
	    $db->insert("statistics", [
	        "#date" => 'NOW()',
	        "ip" => $ip,
	        "os" => $os,
	        "host" => $host,
	        "page" => $page
	    ]);
		$db->update("content", [
			"hits[+]" => 1
		], [
		    "id" => $res->contentCurrent->id
		]);
    }
}

/**
 * Function of rand from STRING
 * @param  [type] $l [description]
 * @param  string $c [description]
 * @return [type]    [description]
 */
function randStr ($l, $c = 'abcdefghijklmnopqrstuvwxyz1234567890') {
    for ($s = '', $cl = strlen($c)-1, $i = 0; $i < $l; $s .= $c[mt_rand(0, $cl)], ++$i);
    return $s;
}

/**
 * Function for inverse HEX color;
 * @param  [type] $color [description]
 * @return [type]        [description]
 */
function inverseHex($color) {
    $color       = trim($color);
    $prependHash = FALSE;

    if(strpos($color,'#')!==FALSE) {
        $prependHash = TRUE;
        $color       = str_replace('#',NULL,$color);
    }

    switch($len=strlen($color)) {
        case 3:
            $color=preg_replace("/(.)(.)(.)/","\\1\\1\\2\\2\\3\\3",$color);
        break;
        case 6:
        break;
        default:
            trigger_error("Invalid hex length ($len). Must be a minimum length of (3) or maxium of (6) characters", E_USER_ERROR);
    }

    if(!preg_match('/^[a-f0-9]{6}$/i',$color)) {
        $color = htmlentities($color);
        trigger_error( "Invalid hex string #$color", E_USER_ERROR );
    }

    $r = dechex(255-hexdec(substr($color,0,2)));
    $r = (strlen($r)>1)?$r:'0'.$r;
    $g = dechex(255-hexdec(substr($color,2,2)));
    $g = (strlen($g)>1)?$g:'0'.$g;
    $b = dechex(255-hexdec(substr($color,4,2)));
    $b = (strlen($b)>1)?$b:'0'.$b;

    return ($prependHash?'#':NULL).$r.$g.$b;
}

function menuLinkBuilder($type, $id = null){
    global $res;

    switch ($type) {
        case 'menu':
            foreach ($res->routers as $value) {
                if ($value->menuId == $id) {
                    return S_URLs.$value->url;
                }
            }
        break;
        case 'category':
            foreach ($res->routers as $value) {
                if ($value->categoryId == $id) {
                    return S_URLs.$value->url;
                }
            }
        break;
        case 'article':
            foreach ($res->routers as $value) {
                if ($value->articleId == $id) {
                    return S_URLs.$value->url;
                }
            }
        break;
        case 'inverse':
            return S_URLh.USER_LANG_INV.$res->routerCurrent->requestUrl;
        break;
    }
}

function frontMenuBuild($params, $res, $active) {
    $list = '';
    foreach($params as $key => $value) {
        $i == 0;
        foreach($value as $key => $index) {
            $i++;
            if($key == 'id') $tempId = $index;
            if ($res[$value['id']]['id'] == $value['id']) {
                $url = menuLinkBuilder('menu', $res[$value['id']]['id']);
                if(is_array($index)) {
                    $list .= '
                    <li class="btn-group'.(($active == $res[$value['id']]['alias'])?' active':'').'">
                        <a href="'.$url.'" class="btn">'.$res[$value['id']]['title'].'</a>
                        <a href="#" class="dropdown-toggle btn" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
                    <ul class="dropdown-menu">';
                    $list .= frontMenuBuild($index, $res, $active);
                    $list .= '</ul></li>';
                } else {
                    if ($i !== 1) $list .= '</li>';
                    if (is_array($value['children'])) {
                    } else {
                        $list .= '<li'.(($active == $res[$index]['alias'])?' class="active"':'').'><a href="'.$url.'">'.$res[$index]['title'].'</a>';
                    }
                }
            }
        }
    }
    $list .= '</li>';
    return $list;
}
function adminModuleVisibleBuild($array, $res, $visType, $moduleRes) {
    $html = '<ol class="dd-list">';
    foreach($array as $key => $value) {
        $i = 0;
        foreach($value as $key => $index) {
            $i++;
            if(is_array($index)) {
                $html .= adminModuleVisibleBuild($index, $res, $visType, $moduleRes);
                $html .= '</li>';
            } else {
                if ($res[$index]['published'] == true) {
                    $retVal = (array_search($res[$index]['id'], $moduleRes['visible'][$visType]) === false || $moduleRes['visible'][$visType] === null)?'':' checked="checked"';
                    $html .= '<li data-id="'.$index.'" class="dd-item"><div class="checkbox"><label><input type="checkbox" class="selectTypeVis" data-name="'.$visType.'" data-id="'.$moduleRes['id'].'" name="article'.$res[$index]['id'].'" value="'.$res[$index]['id'].'" '.$retVal.'> '.$res[$index]['title'].' - '.$res[$index]['id'].'</label></div>';
                }
            }
        }
    }
    $html .= '</li></ol>';
    return $html;
}
