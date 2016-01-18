<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: text/html; charset=utf8');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');

$res = $db->get('extension', 'params', ["AND"=>["id" => $_POST['id'],"type" => "snippet"]]);
 /*
 <div class="mainWCont" data-params="content|full_text|<?=$_POST['id'];?>"><?=$res;?></div>
 */
echo '
<div class="alert alert-warning alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <strong>Внимание!</strong> Исходный сниппет будет обернут в тег <i>&#060;script&#062;</i> автоматически.
</div>
<div class="row">
	<div class="col-md-12 edit_snippet" data-params="extension|params|'.$_POST['id'].'">'.$res.'</div>
</div>';
?>
<script src="<?=S_A_JS;?>ajax-addjs.js"></script>