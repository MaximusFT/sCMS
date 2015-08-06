<div class="row">
    <div class="col-md-6">
        <h3>Получить переменные сайта в CSV</h3>
        <a href="/sadmin/content/mysql-to-csv/" class="btn btn-success">mysql-to-csv</a>
    </div>
    <div class="col-md-6">
        <h3>Загрузить переменные сайта базу</h3>
        <form role="form" class="form-inline" enctype="multipart/form-data" action="/sadmin/content/csv-to-mysql/" method="post">
            <div class="form-group">
                <label for="csvfile">Выберите файл</label>
                <input type="file" name="csvfile">
            </div>
            <button class="btn btn-primary" type="submit">Загрузить</button>
        </form>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-12">
        <h2>Страницы сайта
            <a class="btn btn-success pull-right"
                id="RowAdd"
                data-params="content|"
                href="/sadmin/ajax/_row-add.php">Добавить статью</a>
        </h2>
        <table class="table table-condensed table-hover table-bordered">
            <tr class="active">
                <th></th>
                <th>h1</th>
                <th><span data-toggle="tooltip" title="Опубликовать">Pub</span></th>
                <th><span data-toggle="tooltip" title="Избранное">Fav</span></th>
                <th><span data-toggle="tooltip" title="Иконки простомтра и комментариев">Icon</span></th>
                <th><span data-toggle="tooltip" title="Alias">Alias</span></th>
                <th>fileName</th>
                <th>readmore</th>
                <th width="1%"><span data-toggle="tooltip" title="Дата публикации">Дата</span></th>
                <th>hits</th>
                <th width="1%"><span class="glyphicon glyphicon-edit"></span></th>
                <th width="1%"><span class="glyphicon glyphicon-trash"></span></th>
            </tr>
    <?
    foreach(json_decode(json_encode($res->qContent), true) as $r) {
    ?>
        <tr>
            <td><?=$r['id'];?></td>
            <td class="edit_row" data-params="content|h1|<?=$r['id'];?>"><?=$r['h1'];?></td>
            <td><input class="jedCheck" type="checkbox" data-params="content|published|<?=$r['id'];?>"<?=(($r['published'] == true)?' checked="checked"':'');?>></td>
            <td><input class="jedCheck" type="checkbox" data-params="content|favorite|<?=$r['id'];?>"<?=(($r['favorite'] == true)?' checked="checked"':'');?>></td>
            <td><input class="jedCheck" type="checkbox" data-params="content|catid|<?=$r['id'];?>"<?=(($r['catid'] == true)?' checked="checked"':'');?>></td>
            <td>
                <span class="edit_row" data-params="content|alias|<?=$r['id'];?>"><?=$r['alias'];?></span>
                <a class="btn btn-sm btn-primary pull-right ToTranslit"
                    data-id="<?=$r['id'];?>"
                    data-toggle="tooltip" title="Перевести в транслит из h1"
                    data-params="content|h1|alias|<?=$r['alias'];?>">
                        <span class="fa fa-undo"></span></a>
            </td>
            <td class="edit_row" data-params="content|fileName|<?=$r['id'];?>"><?=$r['fileName'];?></td>
            <td class="edit_row" data-params="content|readmore|<?=$r['id'];?>"><?=$r['readmore'];?></td>
            <td><div class="input-group input-group-sm date form_datetime"
                    data-date="<?=$r['publish_up'];?>"
                    data-date-format="dd.mm.yyyy HH:ii"
                    data-link-field="dtp_input1">
                    <input type="hidden" id="dtp_input1" value="" />
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span></div>
            </td>
            <td><?=$r['hits'];?></td>
            <td><a class="btn btn-sm btn-primary contentEdit"
                data-id="<?=$r['id'];?>"
                data-params=""
                data-toggle="modal"
                data-target="#modalContentEdit">
                    <span class="glyphicon glyphicon-edit"></span></a></td>
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
                <h4 class="modal-title" id="contentEdit">Редактировать страницу</h4>
            </div>
            <div class="modal-body" id="ajaxContent" data-contentid=""></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
