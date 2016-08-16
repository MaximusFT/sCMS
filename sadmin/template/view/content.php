<div class="padding">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <div class="nav-active-border b-warn top box">
                        <div class="nav nav-md">
                            <a href="<?php echo A_URLh;?>content/mysql-to-csv/" class="nav-link">Мета в CSV</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="nav-active-border b-warn top box">
                        <form role="form" class="form-inline" enctype="multipart/form-data" action="<?php echo A_URLh;?>content/csv-to-mysql/" method="post">
                            <div class="form-group">
                                <input type="file" class="form-control no-b-a" name="csvfile">
                            </div>
                            <button class="nav-link" type="submit">Загрузить Мета в базу</button>
                        </form>
                    </div>
                </div>
            </div>


            <div class="box">
                <div class="box-header"><h2 class="ng-binding">Список материалов</h2></div>
                <div class="box-divider m-a-0"></div>
                <div class="box-body">
                    <table id="myTable" class="table table-condensed table-striped table-bordered">
                        <thead>
                            <tr>
                                <th></th>
                                <th>published</th>
                                <th>Category</th>
                                <th>Favorite</th>
                                <th>Title (h1)</th>
                                <th>Alias</th>
                                <th>FileName</th>
                                <th>Language</th>
                                <th>Settings</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal fade" id="xModalContentParams" tabindex="-1" role="dialog" aria-labelledby="ContentParams" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Content Params</h4>
                </div>
                <div class="modal-body" id="ContentParams"></div>
            </form>
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
    'use strict';

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
            "url": "<?php echo A_URLh;?>get/data/content/content-list/",
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
            { "data": "category_id" },
            { "data": "favorite" },
            { "data": "h1" },
            { "data": "alias" },
            { "data": "fileName" },
            { "data": "lang" },
            { "data": "editFull" },
        ],
        "order": [[1, 'asc'], [7, 'asc'], [2, 'asc'], [4, 'asc']],
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

    $('#addArticle').on('click', function() {
        $.ajax({
            type: "POST",
            url: '<?php echo A_URLh;?>save/content/add/',
        }).done(function(result) {
            sCMSAletr(result, 'success');
            dt.draw();
        });
    });
    $("body").on('click', '.getTranslitAlias', function(event) {
        var $this = $(this);
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?php echo A_URLh;?>get/translit/",
            data: {params: $('#' + $this.data('source')).editable('getValue', true)}
        }).done(function(result) {
            $('#' + $this.data('target')).editable('setValue', result).editable('submit');
            sCMSAletr(result, 'success');
        });
    });

    /**
    *   <ContentParams
    */
    $('#xModalContentParams').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            itemId = button.data('id'),
            modal = $(this);
        $.ajax({
            type: 'POST',
            url: '<?php echo A_URLh;?>get/content/params/',
            data: {id: itemId}
        })
        .done(function(result) {
            $('#ContentParams').html(result);
        });
    }).on('hidden.bs.modal', function (e) {
        $('#ContentParams').empty();
    });
});
</script>