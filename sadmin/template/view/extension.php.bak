<div class="row">
    <div class="col-md-12">
        <h2>Расширения
            <a class="btn btn-success pull-right"
                id="RowAdd"
                data-params="extension"
                href="/sadmin/ajax/_row-add.php">Добавить расширение</a>
        </h2>
        <table class="table table-condensed table-hover">
            <tr class="active">
                <th></th>
                <th><span data-toggle="tooltip" title="Заголовок">title</span></th>
                <th><span data-toggle="tooltip" title="Тип">type</span></th>
                <th>fileName</th>
                <th>enabled</th>
                <th>params</th>
                <th width="1%"><span class="glyphicon glyphicon-edit"></span></th>
                <th width="1%"><span class="glyphicon glyphicon-trash"></span></th>
            </tr>
    <?
    foreach(json_decode(json_encode($res->qContent), true) as $r) {
    ?>
        <tr>
            <td><?=$r['id'];?></td>
            <td class="edit_row" data-params="extension|title|<?=$r['id'];?>"><?=$r['title'];?></td>
            <td class="edit_sel_custom" data-case="extension-type" data-params="extension|type|<?=$r['id'];?>"><?=$r['type'];?></td>
            <td class="edit_row" data-params="extension|fileName|<?=$r['id'];?>"><?=$r['fileName'];?></td>
            <td><input class="jedCheck" type="checkbox" data-params="extension|enabled|<?=$r['id'];?>"<?=(($r['enabled'] == true)?' checked="checked"':'');?>></td>
            <td><?=$r['params'];?></td>
            <td>
                <?
                $rParams = json_decode($r['params'], true);
                if (empty($rParams['file'])) {

                } else {?>
            <a class="btn btn-sm btn-primary extensionEdit"
                data-id="<?=$r['id'];?>"
                data-params='<?=$r['params'];?>'
                data-toggle="modal"
                data-target="#modalContentEdit">
                    <span class="glyphicon glyphicon-edit"></span></a></td>
                <?}?>
            <td>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">
                        <input type="checkbox" value="Del">
                    </span>
                    <span class="input-group-btn">
                        <a href="/sadmin/ajax/_row-del.php" class="btn btn-danger RowDel" data-params="id=<?=$r['id'];?>"><span class="glyphicon glyphicon-trash"></span></a>
                    </span>
                </div>
            </td>
        </tr>
    <?
    }
    ?>
        </table>
    </div>
</div>

<!-- Modal for Edit Page -->
<div class="modal fade" id="modalContentEdit" tabindex="-1" role="dialog" aria-labelledby="contentEdit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="contentEdit">Редактировать расширение</h4>
            </div>
            <div class="modal-body" id="ajaxContent" data-contentid=""></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
