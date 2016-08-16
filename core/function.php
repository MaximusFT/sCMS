<?php
/**
 * Function for call modules from position
 * @param  string $type [description]
 * @param  string $pos  [description]
 * @return [type]       [description]
 */
function funPos($type = '', $pos = ''){
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
        "extension.published(extension_published)",
        "extension.params(extension_params)",
    ], [
            "AND" => [
                "lang" => USER_LANG,
                "position" => $pos,
                "module.published" => 1,
            ],
            "ORDER" => "ordering ASC",
        ]
    );
    // var_dump($db->log());
    // var_dump($db->error());
    foreach ($qRes as $key => $value) {
        $modRes = $qRes[$key];
        $modRes['visible'] = json_decode($modRes['visible'], true);
        $modRes['params'] = json_decode(stripslashes($modRes['params']), true);

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
                if ((!in_array($res->menuItemCurrent->id, $modRes['visible']['visMenu']) && is_array($modRes['visible']['visMenu'])) || (!in_array($res->menuItemCurrent->id, $modRes['visible']['visCat']) && is_array($modRes['visible']['visCat']))) {
                    include $modPath;
                } else {
                    continue;
                }
            } elseif ($modRes['visible']['primary'] == 'article') {
                if (!in_array($res->menuItemCurrent->id, $modRes['visible']['visMenu']) && is_array($modRes['visible']['visMenu'])) {
                    include $modPath;
                }
            }
        } elseif ($modRes['visible']['typeVis'] == 2) {
                continue;
        }
    }
}

/**
 * Function for call snipet in Content
 * @param  string $type [description]
 * @param  string $pos  [description]
 * @return [type]       [description]
 */
function snippetPos($resCont){
    global $db;
    global $rd;
    global $res;

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
        "extension.published(extension_published)",
        "extension.params(extension_params)",
    ], [
            "AND" => [
                "lang" => USER_LANG,
                "module.extension_id" => 20,
                "module.published" => 1
            ]
        ]
    );

    foreach ($qRes as $key => $value) {
        $modRes = $qRes[$key];
        $modRes['visible'] = json_decode($modRes['visible'], true);
        $modRes['params'] = json_decode(stripslashes($modRes['params']), true);

        if ($modRes['view'] == 'default') {
            $view = '';
        } else {
            $view = '-'.$modRes['view'];
        }
        $modPath = P_MODL.'mod-'.$modRes['extension_fileName'].'/'.$modRes['extension_fileName'].$view.'.php';
        $modPathView = P_MODL.'mod-'.$modRes['extension_fileName'].'/view-'.$modRes['extension_fileName'].$view.'.php';

        include $modPath;
    }
    return $resCont;
}

function textToDB($txt){
    $txt = trim($txt);
    $txt = htmlspecialchars($txt, ENT_QUOTES, 'KOI8-R');
    $txt = preg_replace("~ +~", " ", $txt);
    $txt = preg_replace("/(\r\n){3,}/", "\r\n\r\n", $txt);
    return $txt;
}

/**
 * Function for Logging
 * @param  string $varName  [description]
 * @param  string $varValue [description]
 * @return [type]           [description]
 */
function logos($varName = "", $varValue = ""){
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

function arrayRecSearch($array, $searchfor) {
    foreach($array as $k => $v) {
        if ($v == $searchfor) {
            $result .= '1';
        }
        if (is_array($array[$k])) {
            $result .= arrayRecSearch($v, $searchfor);
        }
    }
    return $result;
}

function frontMenuBuild($params, $res, $active, $addPar) {
    $html = '';
    foreach($params as $key => $value) {
        $i == 0;
        foreach($value as $key => $index) {
            $i++;
            if($key == 'id') $tempId = $index;
            if ($res[$value['id']]['id'] == $value['id']) {
                // Check on hidden menu item from Guest
                if ($res[$value['id']]['extension_id'] == 21){
                    if (signedCheck()) {
                        if (guestOnlyCheck($res[$value['id']]['category_id'])) {
                            continue;
                        }
                    } else {
                        if (!guestOnlyCheck($res[$value['id']]['category_id'])) {
                            continue;
                        }
                    }
                }
                if ($res[$value['id']]['extension_id'] == 19) {
                    $url = $res[$value['id']]['alias'];
                } else {
                    $url = menuLinkBuilder('menu', $res[$value['id']]['id']);
                }
                $title = $res[$value['id']]['title'];
                $alias = ($active == $res[$value['id']]['id'])?' active':'';
                if(is_array($index)) {
                    if($addPar['oneLevel'] === false) {
                        $findA = arrayRecSearch($index, $active);
                        $findAClass = ($findA)?' active':'';
                        $html .= '
                        <li class="dropdown'.$alias.' '.$findAClass.'">
                            <a href="'.$url.'">'.$title.' <b class="caret"></b></a>
                            <ul class="dropdown-menu">';
                        $html .= frontMenuBuild($index, $res, $active);
                        $html .= '</ul></li>';
                    } else {
                        $html .= '<li class="'.$alias.'"><a href="'.$url.'">'.$title.'</a>';
                    }
                } else {
                    if ($i !== 1) $html .= '</li>';
                    if (is_array($value['children'])) {
                    } else {
                        $title = $res[$index]['title'];
                        $alias = ($active == $res[$index]['id'])?' class="active"':'';
                        $html .= '<li'.$alias.'><a href="'.$url.'">'.$title.'</a>';
                    }
                }
            }
        }
    }
    $html .= '</li>';
    return $html;
}

function arrayRecSearchArr($array, $searchfor) {
    static $res;
    foreach($array as $k => $v) {
        if ($v == $searchfor) {
            if (is_array($array['children'])) $res = $array['children'];
        }
        if (is_array($array[$k])) arrayRecSearchArr($v, $searchfor);
    }
    return $res;
}

function frontMenuBuildCategory($params, $res, $active = null, $addPar) {
    $html = '';
    foreach($params as $key => $value) {
        $i == 0;
        foreach($value as $key => $index) {
            $i++;
            if ($res[$value['id']]['id'] == $value['id']) {
                $url = menuLinkBuilder('category', $res[$value['id']]['id']);
                $id = $res[$value['id']]['id'];
                $title = $res[$value['id']]['title'];
                $alias = ($active == $res[$value['id']]['id'])?' active':'';
                if(is_array($index)) {
                    if($addPar['oneLevel'] === false) {
                        $html .= '
                        <li role="presentation" class="">
                            <a class="" role="button" data-toggle="collapse" href="#coll'.$res[$value['id']]['alias'].$id.'" aria-expanded="false" aria-controls="coll'.$res[$value['id']]['alias'].$id.'"><span class="caret"></span></a>
                            <a href="'.$url.'" class="'.$alias.'">'.$title.'</a>
                            <ul id="coll'.$res[$value['id']]['alias'].$id.'" class="list-group collapse" aria-labelledby="coll'.$res[$value['id']]['alias'].$id.'Heading" aria-expanded="true">';
                        $html .= frontMenuBuildCategory($index, $res, $active);
                        $html .= '</ul></li>';
                    } else {
                        $html .= '<li class="list-group-item"><a class="'.$alias.'" href="'.$url.'">'.$title.'</a>';
                    }
                } else {
                    if ($i !== 1) $html .= '</li>';
                    if (is_array($value['children'])) {
                    } else {
                        $title = $res[$index]['title'];
                        $alias = ($active == $res[$index]['id'])?' active':'';
                        $html .= '<li class="list-group-item">
                            <a><span class="glyphicon glyphicon-link" aria-hidden="true"></span></a>
                            <a href="'.$url.'" class="'.$alias.'">'.$title.'</a>';
                    }
                }
            }
        }
    }
    $html .= '</li>';
    return $html;
}

function getShortText($text, $counttext = 10, $sep = ' ') {
    $text = strip_tags($text);
    $words = split($sep, $text);
    if (count($words) > $counttext ) {
        $text = join($sep, array_slice($words, 0, $counttext));
    }
    $text = trim($text);
    $text = trim($text, "&nbsp;");
    $text = trim($text);
    $text = rtrim($text, ".");
    $text = rtrim($text, "!,.-");
    $text = $text."…";
    return $text;
}

/**
 * Redirects the user
 *
 * @param bool|string $url
 * @param int         $time
 */
function redirect($url = false, $time = 0)
{
    $url = $url ? $url : $_SERVER['HTTP_REFERER'];

    if (!headers_sent()) {
        if (!$time) {
            header("Location: {$url}");
        } else {
            header("refresh: $time; {$url}");
        }
    } else {
        echo "<script> setTimeout(function(){ window.location = '{$url}' }," . ($time * 1000) . ")</script>";
    }
}

/**
 * Prints an array in a readable form
 * @param array $a
 */
function aPrint(array $a)
{
    echo "<pre>";
    print_r($a);
    echo "</pre>";
}

/**
 * Gets a content of a GET variable either by name or position in the path
 * @param $index
 *
 * @return mixed
 */
function getVar($index)
{
    $tree = explode("/", @$_GET['path']);
    $tree = array_filter($tree);

    if (is_int($index)) {
        $res = @$tree[$index - 1];
    } else {
        $res = @$_GET[$index];
    }
    return $res;
}
