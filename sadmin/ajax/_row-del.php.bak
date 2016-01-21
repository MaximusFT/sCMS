<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: text/html; charset=utf8');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');

$par = explode("|", $_POST['params']);

$db->delete($par[0], array(
    "id" => $_POST['id']
));

?>