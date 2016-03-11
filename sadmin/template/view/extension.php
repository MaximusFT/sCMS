<div class="app-view-header">Extension list</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="clearfix">
                    <div id="nestable-menu" class="pull-left">
                        <button id="addExtension" type="button" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Extension</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table id="myTable" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>title</th>
                            <th>type</th>
                            <th>fileName</th>
                            <th>function</th>
                            <th>enabled</th>
                            <th>params</th>
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
            "url": "/sadmin/get/data/extension/extension-list/",
            "type": "POST"
        },
        "columns": [
            { "data": "title" },
            { "data": "type" },
            { "data": "fileName" },
            { "data": "function" },
            { "data": "enabled" },
            { "data": "params" },
        ],
        "order": [[1, 'asc']],
        "drawCallback": function(settings){
            xEdit();
        }
    });


    $('#addExtension').on('click', function() {
        $.ajax({
            type: "POST",
            url: '/sadmin/save/extension/add/',
        }).done(function(result) {
            sCMSAletr(result, 'success');
            dt.draw();
            // $('#appReload').appGo('reload');
        });
    });
});
</script>
