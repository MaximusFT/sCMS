<div class="app-view-header">Content list</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="clearfix">
                    <div id="nestable-menu" class="pull-left">
                        <button id="addArticle" type="button" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Article</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table id="myTable" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th></th>
                            <th>published</th>
                            <th>Category</th>
                            <th>Favorite</th>
                            <th>Title (h1)</th>
                            <th>Alias</th>
                            <th>subTitle (h1Small)</th>
                            <th>Language</th>
                            <th>editFull</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
'use strict';

$(function() {
    var detailRows = [];
    var myTab = $('#myTable');
    var dt = myTab.DataTable({
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "pageLength": 25,
        "stateSave": true,
        "ajax": {
            "url": "/sadmin/get/data/content/content-list/",
            "type": "POST"
        },
        "columns": [
            {
                "class":          "details-control",
                "orderable":      false,
                "data":           null,
                "defaultContent": ""
            },
            { "data": "published" },
            { "data": "extension_id" },
            { "data": "favorite" },
            { "data": "h1" },
            { "data": "alias" },
            { "data": "h1Small" },
            { "data": "lang" },
            { "data": "editFull" },
        ],
        "order": [[1, 'asc'], [7, 'asc'], [2, 'asc'], [4, 'asc']],
        "drawCallback": function(settings){
            xEdit();
        }
    });


    $('#addArticle').on('click', function() {
        $.ajax({
            type: "POST",
            url: '/sadmin/save/content/add/',
        }).done(function(result) {
            sCMSAletr(result, 'success');
            dt.draw();
            // $('#appReload').appGo('reload');
        });
    });
});
</script>

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
                if (empty($rParams['file'])&&empty($r['params'])) {

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
                        <a href="/sadmin/ajax/_row-del.php" class="btn btn-danger RowDel" data-params="extension|<?=$r['id'];?>"><span class="glyphicon glyphicon-trash"></span></a>
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