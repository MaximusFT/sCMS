<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: text/html; charset=utf8');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');
$res = $db->select('link', '*');
?>
<table class="table table-condensed table-hover">
    <thead>
        <tr>
            <th>id</th>
            <th>title</th>
            <th>url</th>
        </tr>
    </thead>
    <tbody>
<?
foreach($res as $r) {
?>
        <tr>
            <td><?=$r['id']?></td>
            <td class="edit_row" data-params="link|title|<?=$r['id'];?>"><?=$r['title']?></td>
            <td class="edit_row" data-params="link|url|<?=$r['id'];?>"><?=$r['url']?></td>
        </tr>
<?
}
?>
    </tbody>
</table>
<script src="<?=S_A_JS;?>ajax-addjs.js"></script>