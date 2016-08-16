<div class="row">
    <div class="col-md-4">
        <h2>Лист</h2>
    </div>
    <div class="col-md-4">
        <a class="btn printq">qqq</a>
    </div>
    <div class="col-md-4">
        <div id="resss"><?
        print_r($res->resId);
        echo $res->resId[0]->date;
        ?></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="myTable" data-parid="<?=$res->printId;?>" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <th>ФИО</th>
                    <th>ФИ</th>
                    <th>Адрес</th>
                    <th>Телефон</th>
                    <th>Год</th>
                    <th>Редактировать</th>
                </tr>
            </thead>
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

<script>
'use strict';

$(function() {
    var myTab = $('#myTable');
    var dt = myTab.DataTable({
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        "pageLength": -1,
        dom: 'RC<"clear">lfrtip',
        columnDefs: [
            { visible: false, targets: [4] }
        ],
        stateSave: true,
        "ajax": {
            "url": "<?php echo A_URLh;?>get/data/people/print-people/",
            "type": "POST",
            "data": function ( d ) {
                return $.extend( {}, d, {
                    "printId": <?=$res->printId;?>
                });
            }
        },
        "columns": [
            { "data": "full-name" },
            { "data": "ful-name" },
            { "data": "full-address" },
            { "data": "full-phone" },
            { "data": "date-birdth" },
            { "data": "func" }
        ],
        "order": [[1, 'asc']],
        "drawCallback": function(settings){
            xEdit();
        }
    });
    $("body").on('click', '.jedCheckListRemove', function() {
        $.post('<?php echo A_URLh;?>printrem/<?=$res->printId;?>/', {
            pid: $(this).data('params')
        }, function(sValue) {
            dt.draw();
            $.jGrowl('Новое значение поля = ' + sValue, {
                theme: 'lightness',
                header: "Состояние запроса:",
                life: 1500
            });
        });
    })
    $("body").on('click', '.printq', function(){
        var table = myTab.tableToJSON(); // Convert the table into a javascript object
        console.log(table);
        $.ajax({
            url: '<?php echo A_URLh;?>get/prints/<?=$res->printId;?>/',
            type:'POST',
            data: {
                jtable: table
            },
            success: function(responce){
                console.log('1');
            }
        });
    })
});
</script>