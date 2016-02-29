<div class="row">
    <div class="col-md-4">
        <h2>Menu Types</h2>
    </div>
    <div class="col-md-4">
        <h3>Получить переменные сайта в CSV</h3>
        <a href="/sadmin/content/mysql-to-csv/" class="btn btn-success">mysql-to-csv</a>
    </div>
    <div class="col-md-4">
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
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="clearfix">
                    <div id="nestable-menu" class="pull-left">
                        <button type="button" data-toggle="modal" data-target="#modalMenuAdd" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add MenuType</button>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<script>
'use strict';

function addInfoDT(d){return d.addInfoRowDT;}
function addElemA (argument) {
    var par = $(argument).data('params');
    $(argument).before('<a href="#" class="myeditable hidden killreset" data-type="text" data-name="'+par.name+'-id">'+par.tokens+'</a>');
}

$(function() {
    var detailRows = [];
    var myTab = $('#myTable');
    var dt = myTab.DataTable({
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        stateSave: true,
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
        "order": [[1, 'asc']],
        "drawCallback": function(settings){
            xEdit();
        }
    });

    myTab.on('click', 'tr td.details-control', function() {
        var tr = $(this).closest('tr'),
            row = dt.row(tr),
            idx = $.inArray(tr.attr('id'), detailRows);
        if (row.child.isShown()) {
            tr.removeClass('details');
            row.child.hide();
            detailRows.splice(idx, 1);
        } else {
            tr.addClass('details');
            row.child(addInfoDT(row.data())).show();

            xEdit();

            if (idx === -1) {
                detailRows.push(tr.attr('id'));
            }
        }
    });
    dt.on('draw', function() {
        $.each(detailRows, function(i, id) {
            $('#' + id + ' td:first-child').trigger('click');
        });
    });

    $("body").on('click', '.getTranslitAlias', function(event) {
        var $this = $(this);
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "/sadmin/get/translit/",
            data: {params: $('#' + $this.data('source')).editable('getValue', true)}
        }).done(function(result) {
            $('#' + $this.data('target')).editable('setValue', result).editable('submit');
            sCMSAletr(result, 'success');
        });
    });

    $('.aExPlace').editable({
        typeahead: {remote: {url: '/sadmin/get/typeahead/place/name/name_alt/?q=%QUERY'}},
        success: function(response, newValue) {addElemA(this)}});
});
</script>