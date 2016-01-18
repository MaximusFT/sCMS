<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: text/html; charset=utf8');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');
$res = $db->select('menu', '*', array("ORDER" => "extension_id ASC",));
$resM = $db->get('module', '*', array("id"=>$_POST['id']));
$resM = json_decode($resM['visible'], true);

// print_r($resM['links']);
?>
<table class="table table-condensed table-hover">
    <thead>
        <tr>
            <th>Выбрать</th>
            <th>id</th>
            <th>title</th>
            <th>patch</th>
        </tr>
    </thead>
    <tbody>
<?
foreach($res as $r) {
?>
<tr>
    <td><input class="jedCheckVisible" type="checkbox" data-params="module|visible|<?=$_POST['id'];?>|visible|<?=$r['id'];?>"<?
        foreach ($resM as $key => $value) {
            echo ($r['id'] == $value)?' checked="checked"':'';
        }
    ?>></td>
    <td><?=$r['id']?></td>
    <td><?=$r['title']?></td>
    <td><?=$r['patch']?></td>
</tr>
<?
}
?>
    </tbody>
</table>
<script src="<?=S_A_JS;?>ajax-addjs.js"></script>