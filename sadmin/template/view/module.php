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
                                <th>published</th>
                                <th>lang</th>
                                <th>extension_id</th>
                                <th>title</th>
                                <th>description</th>
                                <th>position</th>
                                <th>ordering</th>
                                <th>view</th>
                                <th><i class="fa fa-eye"></i></th>
                                <th><i class="fa fa-cog"></i></th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal for Add Module -->
<div id="modalModuleAdd" class="modal fade" data-backdrop="true"><div class="row-col h-v"><div class="row-cell v-m">
    <div class="modal-dialog modal-md">
        <form>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h5 class="modal-title">Добавить новый модуль</h5>
                </div>
                <div class="modal-body text-center p-lg">
                    <table class="table table-condensed table-striped table-bordered">
                        <tbody>
                           <tr><td>Заголовок</td>
                                <td><a href="#" class="myeditable meClear"
                                    data-type="text"
                                    data-name="title"
                                    data-title="Заголовок"></a>
                                </td></tr>
                           <tr><td>Extentsion</td>
                                <td><a href="#" class="myeditable meClear"
                                    data-type="select"
                                    data-name="extension_id"
                                    data-source="<?php echo A_URLh;?>get/group/extension/title/type/module/"
                                    data-title="Заголовок"></a>
                                </td></tr>
                           <tr class="hidden"><td>Lang</td>
                                <td><a href="#" class="myeditable"
                                    data-type="select"
                                    data-name="lang"
                                    data-value="ru"
                                    data-source="<?php echo A_URLh;?>get/group/static/lang/"
                                    data-original-title="lang"></a></td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button id="reset-btn" type="button" class="btn dark-white p-x-md">Очистить форму</button>
                    <button id="save-btn" type="button" class="btn primary">Добавить</button>
                </div>
            </div>
        </form>
    </div>
</div></div></div>

<div id="xModalModuleVisible" class="modal fade" data-backdrop="true"><div class="row-col h-v"><div class="row-cell v-m">
    <div class="modal-dialog modal-md">
        <form>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h5 class="modal-title">Видимость модуля</h5>
                </div>
                <div class="modal-body text-center p-lg" id="ModuleVisible"></div>
            </div>
        </form>
    </div>
</div></div></div>

<div id="xModalModuleParams" class="modal fade" data-backdrop="true"><div class="row-col h-v"><div class="row-cell v-m">
    <div class="modal-dialog modal-md">
        <form>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h5 class="modal-title">Параметры модуля</h5>
                </div>
                <div class="modal-body text-center p-lg" id="ModuleParams"></div>
            </div>
        </form>
    </div>
</div></div></div>

<script>
'use strict';

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
            "url": "<?php echo A_URLh;?>get/data/vAdminModule/module-list/",
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
    xEdit();
    $('.myeditable').editable();

    /**
    *   <ModuleAdd
    */
    $('#modalModuleAdd').on('hidden.bs.modal', function (e) {
        $('#moduleAdd .meClear')
            .editable('setValue', null)
            .editable('option', 'pk', null)
            .removeClass('editable-unsaved');
        $('.myeditable').editable();
        dt.draw();
        // $('#appReload').appGo('reload');
    })
    $('.myeditable').on('save.newuser', function(){
        var that = this;
        setTimeout(function() {
            $(that).closest('tr').next().find('.myeditable').editable('show');
        }, 200);
    });
    $('#save-btn').on('click', function() {
        $('#moduleAdd a.myeditable').editable('submit', {
            url: '<?php echo A_URLh;?>save/module/add/',
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(data, config) {
                $('#modalModuleAdd').modal('hide');
                sCMSAletr(result, 'success', data);
            },
            error: function(errors) {
                sCMSAletr(errors, 'warning');
                console.log(errors);
            }
        });
    });
    $('#reset-btn').on('click', function() {
        $('#moduleAdd .meClear')
            .editable('setValue', null)
            .editable('option', 'pk', null)
            .removeClass('editable-unsaved');
        $('.myeditable').editable();
    });
    /* ModuleAdd> */

    /**
    *   <ModuleVisible
    */
    $('#xModalModuleVisible').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            itemId = button.data('id'),
            modal = $(this);
        $.ajax({
            type: 'POST',
            url: '<?php echo A_URLh;?>get/module/visible/',
            data: {id: itemId}
        })
        .done(function(result) {
            $('#ModuleVisible').html(result);
        });
    }).on('hidden.bs.modal', function (e) {
        $('#ModuleVisible').empty();
    });

    /**
    *   <ModuleParams
    */
    $('#xModalModuleParams').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            itemId = button.data('id'),
            extension_id = button.data('extension_id'),
            modal = $(this);
        $.ajax({
            type: 'POST',
            url: '<?php echo A_URLh;?>get/module/params/',
            data: {id: itemId,extension_id: extension_id}
        })
        .done(function(result) {
            $('#ModuleParams').html(result);
        });
    }).on('hidden.bs.modal', function (e) {
        $('#ModuleParams').empty();
    });

});
</script>