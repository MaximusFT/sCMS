<div class="row">
    <div class="col-md-4">
        <h2>Листы печати</h2>
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
                    <th>Название</th>
                    <th>Тип</th>
                    <th>Дата</th>
                    <th>Номер</th>
                    <th>Кому</th>
                    <th>Уважаемый</th>
                    <th>Text</th>
                    <th>Редактировать</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Modal for Edit Page -->
<div class="modal fade" id="modItemAdd" tabindex="-1" role="dialog" aria-labelledby="contentEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" id="pItemAdd" data-pid=""></div>
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
        stateSave: true,
        "ajax": {
            "url": "<?php echo A_URLh;?>get/data/print/prints/",
            "type": "POST"
        },
        "columns": [
            {
                "class":          "details-control",
                "orderable":      false,
                "data":           null,
                "defaultContent": ""
            },
            { "data": "name" },
            { "data": "type" },
            { "data": "date" },
            { "data": "number-is" },
            { "data": "to" },
            { "data": "title" },
            { "data": "inside", "width": "30%" },
            { "data": "func" }
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
    $('#modItemAdd').on('show.bs.modal', function (event) {
        var printId = $(event.relatedTarget).data('id');
        var modal = $(this);
        modal.find('#pItemAdd').data('pid', printId).attr('data-pid', printId);
        $.post('<?php echo A_URLh;?>people/add/', {
            printId: printId
        }, function(sValue) {
            modal.find('#pItemAdd').html(sValue);
        });
    })
    $('#modItemAdd').on('hidden.bs.modal', function (event) {
        var modal = $(this);
        modal.find('#pItemAdd').empty();
    })
});
</script>