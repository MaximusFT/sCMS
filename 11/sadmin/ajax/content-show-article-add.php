<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');

$par = explode("|", $_POST['params']);
$menu_id = $_POST['menu_id'];

$db->update($par[0], array(
    $par[1] => $par[2]
), array(
    'id' => $menu_id
));
$res['id'] = $par[2];
$res['title'] = $par[3];
print json_encode($res);
// print_r($par[3]);
