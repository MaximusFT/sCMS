<div class="padding">
    <div class="row">
        <div class="col-md-12">

            <div class="box">
                <div class="box-header"><h2 class="ng-binding">Типы меню</h2></div>
                <div class="box-divider m-a-0"></div>
                <div class="box-body">
                    <table id="myTable" class="table table-condensed table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Language</th>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Tools</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="modalMenuAdd" class="modal fade" data-backdrop="true">
    <div class="row-col h-v">
        <div class="row-cell v-m">
            <div class="modal-dialog modal-md">
                <form>
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h5 class="modal-title">Добавить новый тип меню</h5>
                        </div>
                        <div class="modal-body text-center p-lg">
                            <table class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                                <tbody>
                                    <tr>
                                        <td>name</td>
                                        <td><a href="#" class="myeditable" data-type="text" data-name="name" data-original-title="name"></a></td>
                                    </tr>
                                    <tr>
                                        <td>title</td>
                                        <td><a href="#" class="myeditable" data-type="text" data-name="title" data-original-title="title"></a></td>
                                    </tr>
                                    <tr>
                                        <td>lang</td>
                                        <td><a href="#" class="myeditable" data-name="lang" data-type="select" data-source="/sadmin/get/group/static/lang/" data-title="Пол" data-original-title="lang"></a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button id="reset-btn" type="button" class="btn dark-white p-x-md">Очистить форму</button>
                            <button id="save-btn" type="button" class="btn primary">Добавить</button>
                        </div>
                    </div>
                    <!-- /.modal-content -->
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalMenuTypeDel" tabindex="-1" role="dialog" aria-labelledby="contentEdit" aria-hidden="true">
<div class="row-col h-v">
<div class="row-cell v-m">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Delete menutype item</h4>
                </div>
                <div class="modal-body text-center"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button id="delMenuTypeItem" data-delMenuTypeItem="" type="button" class="btn btn-primary">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>

<script>
'use strict';

function addInfoDT(d) {
    return d.addInfoRowDT;
}
$(function() {
    var detailRows = [];
    var myTab = $('#myTable');
    var dt = myTab.DataTable({
        "processing": true,
        "serverSide": true,
        "deferRender": true,
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],
        stateSave: true,
        "ajax": {
            "url": "/sadmin/get/data/menutype/menutype-list/",
            "type": "POST"
        },
        "columns": [{
        //     "data": "link"
        // }, {
            "data": "lang"
        }, {
            "data": "name"
        }, {
            "data": "title"
        }, {
            "data": "tools"
        }, ],
        "drawCallback": function(settings) {
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
    $('#modalMenuAdd').on('hidden.bs.modal', function(e) {
        $('#menuAdd .meClear')
            .editable('setValue', null)
            .editable('option', 'pk', null)
            .removeClass('editable-unsaved');
        $('.myeditable').editable();
        $(document).trigger("pjaxReload");
    })
    $('.myeditable').on('save.newuser', function() {
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
                sCMSAletr(null, 'success', data);
            },
            error: function(errors) {
                sCMSAletr(errors, 'warning');
                console.log(errors);
            }
        });
    });
    $('#menuAddTitle').editable('option', 'validate', function(v) {
        if (!v) return 'Должно быть заполнено!';
    });
    $('#reset-btn').on('click', function() {
        $('#menuAdd .meClear')
            .editable('setValue', null)
            .editable('option', 'pk', null)
            .removeClass('editable-unsaved');
        $('.myeditable').editable();
    });
    /* MenuTypeAdd> */

    /**
    *   <MenuTypeDel
    */
    $('#modalMenuTypeDel').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            itemId = button.data('id'),
            menuTypeId = button.data('menutypeid'),
            modal = $(this);
        // console.log(itemId);
        $.ajax({
            type: 'POST',
            url: '/sadmin/save/menutype/del-check/',
            data: {
                id: itemId
            }
        })
        .then(function(result) {
            modal.find('.modal-body').html(result.html);
        }, function(result) {
            sCMSAletr(result.html, 'warning');
            console.log(result.html);
        });
        modal.find('#delMenuTypeItem')
            .data('delMenuTypeItem', itemId)
            .attr('data-delMenuTypeItem', itemId);
    }).on('hidden.bs.modal', function (e) {
        $(document).trigger("pjaxReload");
    })
    $('#delMenuTypeItem').on('click', function(event) {
        event.preventDefault();
        var $this = $(this),
            id = $this.data('delMenuTypeItem');
        $.ajax({
            type: 'POST',
            url: '/sadmin/save/menutype/del/',
            data: {
                id: id
            }
        })
        .done(function(result) {
            $('#modalMenuTypeDel').modal('hide');
            sCMSAletr(result, 'success');
        });
    });
    /* MenuTypeDel> */

});
</script>
