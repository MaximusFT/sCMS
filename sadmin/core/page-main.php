<?php
/**
 * Functions Routing
 */
function AdminCrtl() {
    global $match;
    global $db;

    $qTable = $db->select("page", "*");

    return [
        'appGoPost'       => true,
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
        "[>]extension(extension)" => ["extension_id" => "id"],
        "[>]category(category)" => ["category_id" => "id"],
        "[>]content" => ["link_id" => "id"]
    ], [
        "menu.id",
        "menu.extension_id",
        "menu.menutype_id",
        "extension.title(extension_title)",
        "menu.category_id",
        "category.title(category_title)",
        "menu.link_id",
        "content.h1(link_title)",
        "menu.title",
        "menu.alias",
        "menu.path",
        "menu.lang",
        "menu.method",
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

function CategoryCrtl() {
    global $match;
    global $db;

    return [
        'appGoPost'       => true,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    ];
}

function CategoryOneCrtl($type) {
    global $match;
    global $db;

    $categoryArray = $db->get("categorytype", ["title", "params", "lang"], [
        "id" => $type
    ]);

    $categoryItems_alt = $db->select("category", [
        "[>]extension(function)" => ["function" => "id"]
    ], [
        "category.id",
        "category.categorytype_id",
        "category.title",
        "category.alias",
        "category.path",
        "category.fileName",
        "category.function",
        "function.title(function_title)",
        "category.published",
        "category.lang",
        "category.params"
    ], [
        "categorytype_id" => $type
    ]);

    foreach ($categoryItems_alt as $key => $value) {
        $categoryItems[$value['id']] = $value;
    }

    return [
        'appGoPost'       => true,
        'categoryLang'    => $categoryLang,
        'categoryArray'   => $categoryArray,
        'categoryItems'   => $categoryItems,
        'params'          => qToDB($match),
        'categoryTypeId'  => $type,
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

function ExtensionCrtl() {
    global $match;
    global $db;

    $qContent = $db->select("extension", "*");

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

    $qContent = $db->get("content", "*", [
        'id' => $id
        ]);

    return [
        'appGoPost'       => true,
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
        // echo $db->last_query();
        // var_dump($qContent);

    return [
        'appGoPost'       => true,
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
        'appGoPost'       => true,
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
        'appGoPost'       => true,
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
        'appGoPost'       => true,
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
        'appGoPost'       => true,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    ];
}
