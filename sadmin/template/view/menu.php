<div class="app-view-header">Menu Types</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="clearfix">
                    <div id="nestable-menu" class="pull-left">
                        <button type="button" data-toggle="modal" data-target="#modalMenuAdd" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add MenuType</button>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <table id="myTable" class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Edit items</th>
                            <th>Language</th>
                            <th>Name</th>
                            <th>Title</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit Page -->
<div class="modal fade" id="modalMenuAdd" tabindex="-1" role="dialog" aria-labelledby="contentEdit" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="contentEdit">Add menu item</h4>
                </div>
                <div class="modal-body" id="menuAdd">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                                <tbody>
                                   <tr><td>name</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="name"
                                            data-original-title="name"></a></td></tr>
                                   <tr><td>title</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="title"
                                            data-original-title="title"></a></td></tr>
                                   <tr><td>lang</td>
                                        <td><a href="#" class="myeditable"
                                            data-name="lang"
                                            data-type="select"
                                            data-source="/sadmin/get/group/static/lang/"
                                            data-title="Пол"
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
        stateSave: true,
        "ajax": {
            "url": "/sadmin/get/data/menutype/menutype-list/",
            "type": "POST"
        },
        "columns": [
            { "data": "link" },
            { "data": "lang" },
            { "data": "name" },
            { "data": "title" },
        ],
        "drawCallback": function(settings){
            xEdit();
        }
    });

    dt.on('draw', function() {
        $.each(detailRows, function(i, id) {
            $('#' + id + ' td:first-child').trigger('click');
        });
    });

    $('.myeditable').editable();

    /**
    *   <MenuTypeAdd
    */
    $('#modalMenuAdd').on('hidden.bs.modal', function (e) {
        $('#menuAdd .meClear')
            .editable('setValue', null)
            .editable('option', 'pk', null)
            .removeClass('editable-unsaved');
        $('.myeditable').editable();
        $('#appReload').appGo('reload');
    })
    $('.myeditable').on('save.newuser', function(){
        var that = this;
        setTimeout(function() {
            $(that).closest('tr').next().find('.myeditable').editable('show');
        }, 200);
    });
    $('#save-btn').on('click', function() {
        $('#menuAdd a.myeditable').editable('submit', {
            url: '/sadmin/save/menutype/add/',
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(data, config) {
                $('#modalMenuAdd').modal('hide');
                sCMSAletr(result, 'success', data);
            },
            error: function(errors) {
                sCMSAletr(errors, 'warning');
                console.log(errors);
            }
        });
    });
    $('#menuAddTitle').editable('option', 'validate', function(v) {
        if(!v) return 'Должно быть заполнено!';
    });
    $('#reset-btn').on('click', function() {
        $('#menuAdd .meClear')
            .editable('setValue', null)
            .editable('option', 'pk', null)
            .removeClass('editable-unsaved');
        $('.myeditable').editable();
    });
    /* MenuTypeAdd> */

});
</script>