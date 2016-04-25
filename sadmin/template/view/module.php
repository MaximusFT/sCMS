<div class="app-view-header">Module list</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="clearfix">
                    <div id="nestable-menu" class="pull-left">
                        <button type="button" data-toggle="modal" data-target="#modalModuleAdd" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Module</button>
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
                            <th><i class="fa fa-cog"></i></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Add Module -->
<div class="modal fade" id="modalModuleAdd" tabindex="-1" role="dialog" aria-labelledby="contentEdit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Add modal item</h4>
                </div>
                <div class="modal-body" id="moduleAdd">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
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
                                            data-source="/sadmin/get/group/extension/title/type/module/"
                                            data-title="Заголовок"></a>
                                        </td></tr>
                                   <tr class="hidden"><td>Lang</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="lang"
                                            data-value="ru"
                                            data-source="/sadmin/get/group/static/lang/"
                                            data-original-title="lang"></a></td></tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Закрыть окно</button>
                    <button id="reset-btn" type="button" class="btn btn-danger">Очистить форму</button>
                    <button id="save-btn" type="button" class="btn btn-primary">Добавить</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade" id="xModalModuleVisible" tabindex="-1" role="dialog" aria-labelledby="ModuleVisible" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Module Visible</h4>
                </div>
                <div class="modal-body" id="ModuleVisible"></div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="xModalModuleParams" tabindex="-1" role="dialog" aria-labelledby="ModuleParams" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Module Params</h4>
                </div>
                <div class="modal-body" id="ModuleParams"></div>
            </form>
        </div>
    </div>
</div>


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
            "url": "/sadmin/get/data/vAdminModule/module-list/",
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
            url: '/sadmin/save/module/add/',
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
            url: '/sadmin/get/module/visible/',
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
            url: '/sadmin/get/module/params/',
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