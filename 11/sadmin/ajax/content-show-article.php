<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: text/html; charset=utf8');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');

$res = $db->select('content', array(
		"id", "alias", "lang", "h1"
	), array(
		"published" => "1"
	));
?>
<table class="table table-condensed table-hover">
    <tr class="active">
        <th>id</th>
        <th><span data-toggle="tooltip" title="Alias">Alias</span></th>
        <th><span data-toggle="tooltip" title="Lang">Lang</span></th>
        <th><span data-toggle="tooltip" title="Название пункта меню">Title</span></th>
        <th><span class="glyphicon glyphicon-link" data-toggle="tooltip" title="Привязать статью"></span></th>
    </tr>

<?
foreach($res as $r) {
?>
    <tr>
        <td><?=$r['id'];?></td>
        <td><?=$r['alias'];?></td>
        <td><?=$r['lang'];?></td>
        <td><?=$r['h1'];?></td>
        <td><a class="btn btn-primary btn-sm linkArticleAdd"
        	data-params="menu|link_id|<?=$r['id'];?>|<?=$r['h1'];?>">
        		<span class="glyphicon glyphicon-link"></span></a>
        </td>
    </tr>
<?
	if ($r['id'] == $cat_id) $result['selected'] = $r['id'];
	$result[$r['id']] = $r[$table_col];
}
?>
</table>
