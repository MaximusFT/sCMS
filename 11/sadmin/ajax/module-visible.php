<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: text/html; charset=utf8');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');
?>
<div id="showLink"></div>
<script>
	$.ajax({ url : '/sadmin/ajax/module-visible-show.php', data: {"id": <?=$_POST['id'];?>} ,type : "post" }).then(function(result) { $('#showLink').html(result); });
</script>