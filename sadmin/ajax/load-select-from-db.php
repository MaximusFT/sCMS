<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: application/json');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');

$par = explode("|", $_GET['params']);
$table_name = $par[0];
$table_col = $par[1];
$row_id = $par[2];
$table_cond = $par[3];
$table_param = $par[4];

// $result['0'] = "!---!";
if ($table_name === 'extension') {
	$res = $db->select($table_name, array("id", $table_col), array($table_cond => $table_param));
} else {
	$res = $db->select($table_name, array("id", $table_col));
}

foreach($res as $r) {
	if ($r['id'] == $cat_id) $result['selected'] = $r['id'];
	$result[$r['id']] = $r[$table_col];
}

print json_encode($result);
