<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: text/html; charset=utf8');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');

$id = $_POST['id'];
$par = explode("|", $_POST['params']);

$res = $db->get($par[0], array(
		$par[1], $par[2]
	), array(
		"id" => $id
	));

// echo $db->last_query();
// var_dump($db->error());

if ($res[$par[1]] != '') {
	$tran = translitlow($res[$par[1]]);

	$db->update($par[0], array(
	    $par[2] => $tran
	), array(
	    'id' => $id
	));
	// echo $db->last_query();

	print $tran;
}