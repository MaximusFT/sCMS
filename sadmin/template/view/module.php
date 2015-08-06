<div class="row">
    <div class="col-md-12">
        <h2>Модули
            <a class="btn btn-success pull-right"
                id="RowAdd"
                data-params="module"
                href="/sadmin/ajax/_row-add.php">Добавить модуль</a>
        </h2>
        <table class="table table-condensed table-hover">
            <tr class="active">
                <th></th>
                <th width="1%"><span class="glyphicon glyphicon-link" data-toggle="tooltip" title="Выбрать модуль"></span></th>
                <th><span data-toggle="tooltip" title="Заголовок">title</span></th>
                <th><span data-toggle="tooltip" title="Описание">description</span></th>
                <th>published</th>
                <th>ordering</th>
                <th>position</th>
                <th>visible</th>
                <th>params</th>
                <th width="1%"><span class="glyphicon glyphicon-edit"></span></th>
                <th width="1%"><span class="glyphicon glyphicon-trash"></span></th>
            </tr>
    <?
    foreach(json_decode(json_encode($res->qContent), true) as $r) {
    ?>
        <tr>
            <td><?=$r['id'];?></td>
            <td class="edit_sel"
                data-select="extension|title|<?=$r['extension_id'];?>|type|module"
                data-params="module|extension_id|<?=$r['id'];?>|extension|title"><?=$r['extension_title'];?></td>
            <td class="edit_row" data-params="module|title|<?=$r['id'];?>"><?=$r['title'];?></td>
            <td class="edit_row" data-params="module|description|<?=$r['id'];?>"><?=$r['description'];?></td>
            <td><input class="jedCheck" type="checkbox" data-params="module|published|<?=$r['id'];?>"<?=(($r['published'] == true)?' checked="checked"':'');?>></td>
            <td class="edit_row" data-params="module|ordering|<?=$r['id'];?>"><?=$r['ordering'];?></td>
            <td class="edit_sel_custom" data-case="module-position" data-params="module|position|<?=$r['id'];?>"><?=$r['position'];?></td>
            <td><a class="btn btn-sm btn-primary moduleVisibleEdit"
                data-id="<?=$r['id'];?>"
                data-params='<?=$r['visible'];?>'
                data-toggle="modal"
                data-target="#modalContentEdit">
                    <span class="glyphicon glyphicon-edit"></span></a></td>
            <td><?=$r['params'];?></td>
            <td>
                <?
                $rParams = json_decode($r['params'], true);
                if (empty($rParams['file'])) {
                } else {?>
            <a class="btn btn-sm btn-primary moduleEdit"
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
                <h4 class="modal-title" id="contentEdit">Редактировать модуль</h4>
            </div>
            <div class="modal-body" id="ajaxContent" data-contentid=""></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
