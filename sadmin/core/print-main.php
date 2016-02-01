<?
function PrintPeopleListCrtl() {
    global $match;
    global $db;

    require_once 'print-people-list.php';

    return array(
        'qContent'        => $qContent,
        'params'          => qToDB($match),
        'pageContent'     => $pathTo.$match['name'].'.php'
    );
}

function getPrintsCrtl($id) {
    global $match;
    global $db;
    global $rd;

    // if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();
    // header('Content-Type: application/json; charset=utf-8');

    $ress = $db->get('print', '*', array(
        "id" => $id
    ));
    require_once 'print-people-list.php';
    exit();
}
