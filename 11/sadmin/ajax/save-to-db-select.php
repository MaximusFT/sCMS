<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: text/html; charset=utf8');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');

$par = explode("|", $_POST['params']);
$sel = explode("|", $_POST['sel']);

$db->update($par[0], array(
    $par[1] => $_POST['value']
), array(
    'id' => $par[2]
));

if ($sel !== false) {
	$res = $db->select($sel[0], $sel[1], array(
		"id" => $_POST['value']
		));
	print_r($res[0]);
} else {
	print_r($_POST['value']);
}
