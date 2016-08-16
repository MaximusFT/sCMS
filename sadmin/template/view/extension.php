<div class="padding">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header"><h2 class="ng-binding">Расширения</h2></div>
                <div class="box-divider m-a-0"></div>
                <div class="box-body">
                    <table id="myTable" class="table table-condensed table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>title</th>
                                <th>type</th>
                                <th>fileName</th>
                                <th>function</th>
                                <th>published</th>
                                <th>params</th>
                            </tr>
                        </thead>
                    </table>
                </div>
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
            "url": "<?php echo A_URLh;?>get/data/extension/extension-list/",
            "type": "POST"
        },
        "columns": [
            { "data": "title" },
            { "data": "type" },
            { "data": "fileName" },
            { "data": "function" },
            { "data": "published" },
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
            url: '<?php echo A_URLh;?>save/extension/add/',
        }).done(function(result) {
            sCMSAletr(result, 'success');
            dt.draw();
        });
    });
});
</script>
