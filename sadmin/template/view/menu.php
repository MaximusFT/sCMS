<div class="row">
    <div class="col-md-4">
        <h2>Menu Types</h2>
    </div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
    </div>
</div>
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
                <div class="table-responsive">
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
                                   <tr><td>lang</td>
                                        <td><a href="#" class="myeditable"
                                            data-name="lang"
                                            data-type="select"
                                            data-source="/sadmin/get/group/static/lang/"
                                            data-title="Пол"
                                            data-original-title="lang"></a></td></tr>
                                   <tr><td>menutype_id</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="menutype_id"
                                            data-source="/sadmin/get/group/menutype/name/"
                                            data-original-title="menutype_id"></a></td></tr>
                                   <tr><td>extension_id</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="extension_id"
                                            data-source="/sadmin/get/group/extension/title/"
                                            data-original-title="extension_id"></a></td></tr>
                                   <tr><td>metdod</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="metdod"
                                            data-source="/sadmin/get/group/static/menu-method/"
                                            data-original-title="metdod"></a></td></tr>
                                   <tr><td>function</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="function"
                                            data-source="/sadmin/get/group/static/menu-function/"
                                            data-original-title="function"></a></td></tr>
                                   <tr><td>title</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="title"
                                            data-original-title="title"></a></td></tr>
                                   <tr><td>alias</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="alias"
                                            data-original-title="alias"></a></td></tr>
                                   <tr><td>patd</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="patd"
                                            data-original-title="patd"></a></td></tr>
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
function addElemA (argument) {
    var par = $(argument).data('params');
    $(argument).before('<a href="#" class="myeditable hidden killreset" data-type="text" data-name="'+par.name+'-id">'+par.tokens+'</a>');
}

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
            { "data": "title" }
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

    //init editables
    $('.myeditable').editable();

    //automatically show next editable
    $('.myeditable').on('save.newuser', function(){
        var that = this;
        setTimeout(function() {
            $(that).closest('tr').next().find('.myeditable').editable('show');
        }, 200);
    });

    $('#save-btn').click(function() {
        $('.myeditable').editable();
        $('#menuAdd a').editable('submit', {
            url: '/sadmin/save/people/add/',
            ajaxOptions: {
                dataType: 'json' //assuming json response
            },
            success: function(data, config) {
                $('#menuAdd a')
                    .editable('setValue', null)  //clear values
                    .editable('option', 'pk', null)          //clear pk
                    .removeClass('editable-unsaved');        //remove bold css
                $('.killreset').remove();
                $('.myeditable').editable();
            },
            error: function(errors) {
                console.log('Ошибка');
            }
        });
    });
    $('#reset-btn').click(function() {
        $('.myeditable').editable('setValue', null)  //clear values
            .editable('option', 'pk', null)          //clear pk
            .removeClass('editable-unsaved');        //remove bold css
        $('.killreset').remove();
        $('.myeditable').editable();
    });
    $('.aExMother').editable({
        typeahead: {remote: {url: '/sadmin/get/typeaheadmf/mother/?q=%QUERY'}},
        success: function(response, newValue) {addElemA(this)}});
});
</script>