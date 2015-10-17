<div class="row">
    <div class="col-md-12">
        <h2>Меню сайта
            <a class="btn btn-success pull-right"
                id="RowAdd"
                data-params="menu"
                href="/sadmin/ajax/_row-add.php">Добавить пункт меню</a>
        </h2>
        <table class="table table-condensed table-hover table-bordered">
            <tr class="active">
                <th></th>
                <th><span data-toggle="tooltip" title="Тип меню">MT</span></th>
                <th><span data-toggle="tooltip" title="Опубликовать">Pub</span></th>
                <th><span data-toggle="tooltip" title="Название пункта меню">Title</span></th>
                <th><span data-toggle="tooltip" title="Alias">Alias</span></th>
                <th><span data-toggle="tooltip" title="Page URL path">Path</span></th>
                <th>method</th>
                <th>Func</th>
                <th>type</th>
                <th width="1%"><span class="glyphicon glyphicon-link" data-toggle="tooltip" title="Привязать статью"></span></th>
                <?/*
                <th>params</th>
                */?>
                <th width="1%"><span class="glyphicon glyphicon-trash"></span></th>
            </tr>
    <?
    foreach(json_decode(json_encode($res->qMenu), true) as $r) {
        if ($r['id'] == 1) continue;
    ?>
        <tr>
            <td><?=$r['id'];?></td>
            <td class="edit_sel"
                data-select="menutype|name|<?=$r['menutype_id'];?>"
                data-params="menu|menutype_id|<?=$r['id'];?>|menutype|name"><?=$r['menutype_name'];?></td>
            <td><input class="jedCheck" type="checkbox" data-params="menu|published|<?=$r['id'];?>"<?=(($r['published'] == true)?' checked="checked"':'');?>></td>
            <td class="edit_row" data-params="menu|title|<?=$r['id'];?>"><?=$r['title'];?></td>
            <td>
                <span class="edit_row" data-params="menu|alias|<?=$r['id'];?>"><?=$r['alias'];?></span>
                <a class="btn btn-sm btn-primary pull-right ToTranslit"
                    data-id="<?=$r['id'];?>"
                    data-toggle="tooltip" title="Перевести в транслит из title"
                    data-params="menu|title|alias|<?=$r['alias'];?>">
                        <span class="fa fa-undo"></span></a>
            </td>
            <td class="edit_row" data-params="menu|path|<?=$r['id'];?>"><?=$r['path'];?></td>
            <td class="edit_sel_custom" data-case="menu-method" data-params="menu|method|<?=$r['id'];?>"><?=$r['method'];?></td>
            <td class="edit_row" data-params="menu|function|<?=$r['id'];?>"><?=$r['function'];?></td>
            <td class="edit_sel"
                data-select="extension|title|<?=$r['extension_id'];?>|type|component"
                data-params="menu|extension_id|<?=$r['id'];?>|extension|title"><?=$r['extension_title'];?></td>
            <td><a class="btn btn-primary btn-sm linkArticle"
                data-params="<?=$r['id'];?>"
                data-toggle="modal"
                data-target="#modalLinkArticle">
                    <?=$r['link_id'];?> <span class="glyphicon glyphicon-link"></span></a></td>
            <?/*
            <td><?=$r['params'];?></td>
            */?>
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

<!-- Modal for link Article to Menu-->
<div class="modal fade" id="modalLinkArticle" tabindex="-1" role="dialog" aria-labelledby="linkArticle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="linkArticle">Привязать статью к пункту меню</h4>
            </div>
            <div class="modal-body" id="AjaxContent" data-contentid=""></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>