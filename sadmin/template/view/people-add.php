<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            <table id="listAdd" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th></th>
                        <th>Фамилия</th>
                        <th>Имя</th>
                        <th>Отчество</th>
                        <th>Полное имя</th>
                        <th>Адрес</th>
                        <th>Телефон</th>
                        <th>Год рождения</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
'use strict';

$(function() {
    var myList = $('#listAdd');
    var dlist = myList.DataTable({
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
        dom: 'RC<"clear">lfrtip',
        colVis: {
            exclude: [ 0 ]
        },
        columnDefs: [
            { visible: false, targets: [4, 5, 6] }
        ],
        stateSave: true,
        "ajax": {
            "url": "/sadmin/get/list/people/list-peoples/",
            "type": "POST",
            "data": function ( d ) {
                return $.extend( {}, d, {
                    "printId": <?=$_POST['printId'];?>
                });
            }
        },
        "columns": [
            { "data": "check" },
            { "data": "name-l" },
            { "data": "name-f" },
            { "data": "name-s" },
            { "data": "full-name" },
            { "data": "full-address" },
            { "data": "full-phone" },
            { "data": "date-birdth" }
        ],
        "order": [[1, 'asc']],
        "drawCallback": function(settings){
            xEdit();
        }
    });
});
</script>