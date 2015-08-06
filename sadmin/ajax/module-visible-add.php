<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: text/html; charset=utf8');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');

$par = explode("|", $_POST['params']);

$res = $db->get($par[0], '*', array("id"=>$par[2]));
$res[$par[3]] = json_decode($res[$par[3]], true);
if (strval($_POST['check']) == 'true') {
	$res[$par[3]][$par[4]] = $par[4];
} else {
	unset($res[$par[3]][$par[4]]);
};
$res = json_encode($res[$par[3]]);
$db->update($par[0], array(
    $par[1] => $res
), array(
    'id' => $par[2]
));

?>