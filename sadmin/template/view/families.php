<div class="row">
    <div class="col-md-4">
        <h2>Семьи</h2>
    </div>
    <div class="col-md-4">
    </div>
    <div class="col-md-4">
        <div id="resss"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="myTable" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th></th>
                    <th>Фамилия</th>
                    <th>Мама</th>
                    <th>Папа</th>
                    <th>Количество детей</th>
                    <th>Адрес</th>
                    <th>Телефон</th>
                    <th>Дата свадьбы</th>
                    <th>Дата развода</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
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

<script>
'use strict';

function addInfoDT(d){return d.addInfoRowDT;}

$(function() {
    var detailRows = [];
    var myTab = $('#myTable');
    var dt = myTab.DataTable({
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'RC<"clear">lfrtip',
        colVis: {
            exclude: [ 0 ]
        },
        columnDefs: [
            { visible: false, targets: [5, 6] }
        ],
        stateSave: true,
        "ajax": {
            "url": "<?php echo A_URLh;?>get/data/vfamilies/families/",
            "type": "POST"
        },
        "columns": [
            {
                "class":          "details-control",
                "orderable":      false,
                "data":           null,
                "defaultContent": ""
            },
            { "data": "f-title" },
            { "data": "f-mother-id" },
            { "data": "f-father-id" },
            { "data": "f-child" },
            { "data": "f-full-address" },
            { "data": "f-full-phone" },
            { "data": "f-date-married" },
            { "data": "f-date-divorced" }
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
});
</script>