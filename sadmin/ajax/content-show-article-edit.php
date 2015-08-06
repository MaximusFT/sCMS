<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: text/html; charset=utf8');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');

$res = $db->select('content', '*', array(
		"id" => $_POST['id']
	));
?>
<table class="table table-condensed table-hover">
<?
foreach($res as $r) {
?>
<tr><td class="text-right"><strong>alias</strong></td>
    <td class="edit_row" data-params="content|alias|<?=$r['id'];?>"><?=$r['alias']?></td></tr>
<?/*
<tr><td class="text-right"><strong>ordering</strong></td>
    <td class="edit_row" data-params="content|ordering|<?=$r['id'];?>"><?=$r['ordering']?></td></tr>
<tr><td class="text-right"><strong>catid</strong></td>
    <td class="edit_row" data-params="content|catid|<?=$r['id'];?>"><?=$r['catid']?></td></tr>
*/?>
<tr><td class="text-right"><strong>h1</strong></td>
    <td class="edit_row" data-params="content|h1|<?=$r['id'];?>"><?=$r['h1']?></td></tr>
<tr><td class="text-right"><strong>h1Small</strong></td>
    <td class="edit_row" data-params="content|h1Small|<?=$r['id'];?>"><?=$r['h1Small']?></td></tr>
<tr><td class="text-right"><strong>h1Description</strong></td>
    <td class="edit_row" data-params="content|h1Description|<?=$r['id'];?>"><?=$r['h1Description']?></td></tr>
<tr><td class="text-right"><strong>introText</strong></td>
    <td class="edit_row" data-params="content|introText|<?=$r['id'];?>"><?=$r['introText']?></td></tr>
<tr><td class="text-right"><strong>fileName</strong></td>
    <td class="edit_row" data-params="content|fileName|<?=$r['id'];?>"><?=$r['fileName']?></td></tr>
<tr><td class="text-right"><strong>created</strong></td>
    <td class="edit_row" data-params="content|created|<?=$r['id'];?>"><?=$r['created']?></td></tr>
<tr><td class="text-right"><strong>publish_up</strong></td>
    <td class="edit_row" data-params="content|publish_up|<?=$r['id'];?>"><?=$r['publish_up']?></td></tr>
<tr><td class="text-right"><strong>publish_down</strong></td>
    <td class="edit_row" data-params="content|publish_down|<?=$r['id'];?>"><?=$r['publish_down']?></td></tr>
<tr><td class="text-right"><strong>hits</strong></td>
    <td class="edit_row" data-params="content|hits|<?=$r['id'];?>"><?=$r['hits']?></td></tr>
<?/*
<tr><td class="text-right"><strong>images</strong></td>
    <td class="edit_row" data-params="content|images|<?=$r['id'];?>"><?=$r['images']?></td></tr>
<tr><td class="text-right"><strong>urls</strong></td>
    <td class="edit_row" data-params="content|urls|<?=$r['id'];?>"><?=$r['urls']?></td></tr>
*/?>
<tr><td class="text-right"><strong>metaTitle</strong></td>
    <td class="edit_row" data-params="content|metaTitle|<?=$r['id'];?>"><?=$r['metaTitle']?></td></tr>
<tr><td class="text-right"><strong>metaKeywords</strong></td>
    <td class="edit_row" data-params="content|metaKeywords|<?=$r['id'];?>"><?=$r['metaKeywords']?></td></tr>
<tr><td class="text-right"><strong>metaDescription</strong></td>
    <td class="edit_row" data-params="content|metaDescription|<?=$r['id'];?>"><?=$r['metaDescription']?></td></tr>
<tr><td class="text-right"><strong>metaOgTitle</strong></td>
    <td class="edit_row" data-params="content|metaOgTitle|<?=$r['id'];?>"><?=$r['metaOgTitle']?></td></tr>
<tr><td class="text-right"><strong>metaOgType</strong></td>
    <td class="edit_row" data-params="content|metaOgType|<?=$r['id'];?>"><?=$r['metaOgType']?></td></tr>
<tr><td class="text-right"><strong>metaOgSiteName</strong></td>
    <td class="edit_row" data-params="content|metaOgSiteName|<?=$r['id'];?>"><?=$r['metaOgSiteName']?></td></tr>
<tr><td class="text-right"><strong>metaOgDescription</strong></td>
    <td class="edit_row" data-params="content|metaOgDescription|<?=$r['id'];?>"><?=$r['metaOgDescription']?></td></tr>
<tr><td class="text-right"><strong>metaOgSection</strong></td>
    <td class="edit_row" data-params="content|metaOgSection|<?=$r['id'];?>"><?=$r['metaOgSection']?></td></tr>
<tr><td class="text-right"><strong>metaOgTag</strong></td>
    <td class="edit_row" data-params="content|metaOgTag|<?=$r['id'];?>"><?=$r['metaOgTag']?></td></tr>
<?
}
?>
</table>
<script src="<?=S_A_JS;?>ajax-addjs.js"></script>