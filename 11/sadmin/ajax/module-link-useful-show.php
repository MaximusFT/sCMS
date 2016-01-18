<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: text/html; charset=utf8');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');
$res = $db->select('link', '*');
$resM = $db->get('module', '*', array("id"=>$_POST['id']));
$resM = json_decode($resM['params'], true);

// print_r($resM['links']);
?>
<table class="table table-condensed table-hover">
    <thead>
        <tr>
            <th>Выбрать</th>
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
    <td><input class="jedCheckLink" type="checkbox" data-params="module|params|<?=$_POST['id'];?>|links|<?=$r['id'];?>"<?
        foreach ($resM['links'] as $key => $value) {
            echo ($r['id'] == $value)?' checked="checked"':'';
        }
    ?>></td>
    <td><?=$r['id']?></td>
    <td><?=$r['title']?></td>
    <td><?=$r['url']?></td>
</tr>
<?
}
?>
    </tbody>
</table>
<script src="<?=S_A_JS;?>ajax-addjs.js"></script>