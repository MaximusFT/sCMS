<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: text/html; charset=utf8');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');

$res = $db->get('content', 'full_text', array(
		"id" => $_POST['id']
	));
 /*
 <div class="mainWCont" data-params="content|full_text|<?=$_POST['id'];?>"><?=$res;?></div>
 */
echo $res;