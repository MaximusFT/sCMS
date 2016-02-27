<?php
/**
 * Functions Routing
 */
function AdminCrtl() {
    global $match;
    global $db;

    $qTable = $db->select("page", "*");

    return [
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    ];
}

function MenuCrtl() {
    global $match;
    global $db;

    return [
        'appGoPost'       => true,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    ];
}

function MenuOneCrtl($type) {
    global $match;
    global $db;

    $menuArray = $db->get("menutype", ["title", "params", "lang"], [
        "id" => $type
    ]);

    $menuItems_alt = $db->select("menu", [
        "[>]extension" => ["extension_id" => "id"]
    ], [
        "menu.id",
        "menu.extension_id",
        "menu.menutype_id",
        "extension.title(extension_title)",
        "menu.link_id",
        "menu.title",
        "menu.alias",
        "menu.path",
        "menu.method",
        "menu.function",
        "menu.published",
        "menu.img",
        "menu.home",
        "menu.params"
    ], [
        "menutype_id" => $type
    ]);

    foreach ($menuItems_alt as $key => $value) {
        $menuItems[$value['id']] = $value;
    }

    return [
        'appGoPost'       => true,
        'menuLang'        => $menuLang,
        'menuArray'       => $menuArray,
        'menuItems'       => $menuItems,
        'params'          => qToDB($match),
        'menuTypeId'      => $type,
        'pageContent'     => $pathTo.$match['name'].'.php'
    ];
}

function ContentCrtl() {
    global $match;
    global $db;

    $qContent = $db->select("content", "*");

    return [
        'appGoPost'       => true,
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    ];
}

function ContentOneCrtl($id) {
    global $match;
    global $db;

    $qContent = $db->select("content", "*", [
        'id' => $id
        ]);

    return [
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    ];
}

function ModuleCrtl() {
    global $match;
    global $db;

    $qContent = $db->select("module", [
        "[>]extension" => ["extension_id" => "id"]
    ], [
        "module.id",
        "module.extension_id",
        "module.title",
        "module.description",
        "module.published",
        "module.ordering",
        "module.position",
        "module.visible",
        "module.params",
        "extension.title(extension_title)"
    ]);

    return [
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    ];
}

function ExtensionCrtl() {
    global $match;
    global $db;

    $qContent = $db->select("extension", "*");

    return [
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    ];
}

function CommentsCrtl() {
    global $match;
    global $db;

    $qContent = $db->select("comment", [
        "[>]content" => ["content_id" => "id"]
    ], [
        "comment.id",
        "comment.active",
        "comment.title",
        "comment.name",
        "comment.email",
        "comment.comment",
        "content.h1(h1)",
    ], [
        "type" => "comment",
        "ORDER"=>"id DESC"
    ]);

    return [
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    ];
}

function SubscribersCrtl() {
    global $match;
    global $db;

    $qContent = $db->select("comment", [
        "[>]content" => ["content_id" => "id"]
    ], [
        "comment.id",
        "comment.active",
        "comment.title",
        "comment.name",
        "comment.email",
        "comment.comment",
        "content.h1(h1)",
    ], [
        "type" => "subscribe",
        "ORDER"=>"id DESC"
    ]);

    return [
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    ];
}

function AskingsCrtl() {
    global $match;
    global $db;

    $qContent = $db->select("comment", [
        "[>]content" => array("content_id" => "id")
    ], [
        "comment.id",
        "comment.active",
        "comment.title",
        "comment.name",
        "comment.email",
        "comment.comment",
        "content.h1(h1)",
    ], [
        "type" => "asking",
        "ORDER"=>"id DESC"
    ]);

    return [
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    ];
}

function appMysqlToCSV() {
    global $match;
    global $db;

    $qRes = $db->select("content", [
        "id", "alias", "h1", "h1Small", "h1Description", "introText",
        "metaTitle", "metaKeywords", "metaDescription", "metaOgTitle",
        "metaOgType", "metaOgSiteName", "metaOgDescription", "metaOgSection", "metaOgTag"
    ]);

    $arr = array();
    foreach ($qRes as $key => $value) {
        array_push($arr, $value);
    }

    header("Content-Type: text/csv; charset=utf-8");
    header("Content-Disposition: attachment; filename=dumpMeta.csv");

    $f = fopen('php://output', 'w');

    $firstLineKeys = false;
    foreach ($arr as $line){
        if (empty($firstLineKeys)){
            $firstLineKeys = array_keys($line);
            fputcsv($f, $firstLineKeys);
            $firstLineKeys = array_flip($firstLineKeys);
        }
        fputcsv($f, array_merge($firstLineKeys, $line));
    }
    fclose($f);
    exit();
}
function appCSVtoMysql() {
    global $match;
    global $db;

    $qUpd = csv_to_array($_FILES['csvfile']['tmp_name']);
    foreach ($qUpd as $key => $value) {
        $db->update("content", [
            'alias' => $value['alias'],
            'h1' => $value['h1'],
            'h1Small' => $value['h1Small'],
            'h1Description' => $value['h1Description'],
            'introText' => $value['introText'],
            'metaTitle' => $value['metaTitle'],
            'metaKeywords' => $value['metaKeywords'],
            'metaDescription' => $value['metaDescription'],
            'metaOgTitle' => $value['metaOgTitle'],
            'metaOgType' => $value['metaOgType'],
            'metaOgSiteName' => $value['metaOgSiteName'],
            'metaOgDescription' => $value['metaOgDescription'],
            'metaOgSection' => $value['metaOgSection'],
            'metaOgTag' => $value['metaOgTag']
        ], [
            'id' => $value['id']
        ]);
    }
    return [
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    ];
}

function PeoplesCrtl() {
    global $match;
    global $db;

    return array(
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    );
}
function PeopleAddCrtl() {
    global $match;
    global $db;

    require( A_VIEW.$match['name'].'.php' );

    exit();
}
function FamiliesCrtl() {
    global $match;
    global $db;

    return array(
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    );
}
function PrintsCrtl() {
    global $match;
    global $db;

    return array(
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    );
}
function PrintCrtl($id) {
    global $match;
    global $db;

    /*
    $ress = $db->select('print', '*', array(
        "id" => $id
    ));
    */

    return array(
        'printId'         => $id,
        'resId'         => $ress,
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    );
}