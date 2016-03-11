<div class="app-view-header">Module list</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="clearfix">
                    <div id="nestable-menu" class="pull-left">
                        <button id="addModule" type="button" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Module</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table id="myTable" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>published</th>
                            <th>lang</th>
                            <th>extension_id</th>
                            <th>title</th>
                            <th>description</th>
                            <th>position</th>
                            <th>ordering</th>
                            <th>view</th>
                            <th><i class="fa fa-eye"></i></th>
                            <th><i class="fa fa-cog"></th>
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
            "url": "/sadmin/get/data/module/module-list/",
            "type": "POST"
        },
        "columns": [
            { "data": "published" },
            { "data": "lang" },
            { "data": "extension_id" },
            { "data": "title" },
            { "data": "description" },
            { "data": "position" },
            { "data": "ordering" },
            { "data": "view" },
            { "data": "visible" },
            { "data": "params" },
        ],
        "order": [[1, 'asc']],
        "drawCallback": function(settings){
            xEdit();
        }
    });


    $('#addModule').on('click', function() {
        $.ajax({
            type: "POST",
            url: '/sadmin/save/module/add/',
        }).done(function(result) {
            sCMSAletr(result, 'success');
            dt.draw();
            // $('#appReload').appGo('reload');
        });
    });
});
</script>

<!-- Modal for Edit Page -->
<div class="modal fade" id="modalModuleViewEdit" tabindex="-1" role="dialog" aria-labelledby="contentEdit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Привязка к пунктам меню</h4>
            </div>
            <div class="modal-body" id="ajaxModule" data-contentid="">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>