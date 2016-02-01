<div class="row">
    <div class="col-md-4">
        <h2>Все люди</h2>
    </div>
    <div class="col-md-4">
        <button type="button" class="btn btn-success" data-toggle="modal" data-keyboard="false" data-target="#modalContentEdit">Добавить</button>
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
                    <th>Имя</th>
                    <th>Отчество</th>
                    <th>Полное имя</th>
                    <th>Адрес</th>
                    <th>Телефон</th>
                    <th>Пол</th>
                    <th>Год рождения</th>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="contentEdit">Добавить человека</h4>
                </div>
                <div class="modal-body" id="peopleAdd">
                    <div class="row">
                        <div class="col-md-4">
                            <table class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                                <tbody>
                                    <tr><td>Фамилия</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="name-l"
                                            data-original-title="Фамилия"></a></td></tr>
                                    <tr><td>Девичья фамилия</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="name-l-old"
                                            data-original-title="Девичья фамилия"></a></td></tr>
                                    <tr><td>Имя</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="name-f"
                                            data-original-title="Имя"></a></td></tr>
                                    <tr><td>Отчество</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="name-s"
                                            data-original-title="Отчество"></a></td></tr>
                                    <tr><td>Дата рождения</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="date"
                                            data-name="date-birdth"
                                            data-format="yyyy-mm-dd"
                                            data-placement="right"
                                            data-viewformat="yyyy-mm-dd"
                                            data-original-title="Select Date of birth"></a></td></tr>
                                    <tr><td>Пол</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="sex"
                                            data-source="/sadmin/get/group/static/sex/"
                                            data-title="Пол"></a></td></tr>
                                    <tr><td>Серия</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="pass-serial"
                                            data-original-title="Серия"></a></td></tr>
                                    <tr><td>Номер</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="pass-number"
                                            data-original-title="Номер"></a></td></tr>
                                    <tr><td>Кем выдан?</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="pass-who"
                                            data-original-title="Кем выдан?"></a></td></tr>
                                    <tr><td>Дата выдачи</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="date"
                                            data-name="pass-date"
                                            data-format="yyyy-mm-dd"
                                            data-placement="right"
                                            data-viewformat="yyyy-mm-dd"
                                            data-original-title="Дата выдачи"></a></td></tr>
                                    <tr><td>ИД номер</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="id-number"
                                            data-original-title="ИД номер"></a></td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                                <tbody>
                                    <tr><td>Телефон Основной</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="phone-mobile"
                                            data-original-title="Телефон Основной"></a></td></tr>
                                    <tr><td>Телефон Домашний</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="phone-home"
                                            data-original-title="Телефон Домашний"></a></td></tr>
                                    <tr><td>Телефон Дополнительный</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="phone-second"
                                            data-original-title="Телефон Дополнительный"></a></td></tr>
                                    <tr><td>E-mail</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="email"
                                            data-original-title="E-mail"></a></td></tr>
                                    <tr><td>Город</td>
                                        <td><a href="#" class="aExPlace"
                                            data-type="typeaheadjs"
                                            data-name="address-city"
                                            data-params='{"name":"address-city"}'
                                            data-title="Город"></a></td></tr>
                                    <tr><td>Улица</td>
                                        <td><a href="#" class="aExStreet"
                                            data-type="typeaheadjs"
                                            data-name="address-street"
                                            data-params='{"name":"address-street"}'
                                            data-original-title="Улица"></a></td></tr>
                                    <tr><td>Дом</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="address-house"
                                            data-original-title="Дом"></a></td></tr>
                                    <tr><td>Квартира</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="address-flat"
                                            data-original-title="Квартира"></a></td></tr>
                                    <tr><td>Комната</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="address-room"
                                            data-original-title="Комната"></a></td></tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <table class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                                <tbody>
                                    <tr><td>Мама</td>
                                        <td><a href="#" class="aExMother"
                                            data-type="typeaheadjs"
                                            data-name="mother-name"
                                            data-params='{"name":"mother-name"}'
                                            data-original-title="Мама"></a></td></tr>
                                    <tr><td>Папа</td>
                                        <td><a href="#" class="aExFather"
                                            data-type="typeaheadjs"
                                            data-name="father-name"
                                            data-params='{"name":"father-name"}'
                                            data-original-title="Папа"></a></td></tr>
                                    <tr><td>№ Детского сада</td>
                                        <td><a href="#" class="aExKinder"
                                            data-type="typeaheadjs"
                                            data-name="kindergarten-name"
                                            data-params='{"name":"kindergarten-name"}'
                                            data-original-title="№ Детского сада"></a></td></tr>
                                    <tr><td>№ Школы</td>
                                        <td><a href="#" class="aExSchool"
                                            data-type="typeaheadjs"
                                            data-name="school-name"
                                            data-params='{"name":"school-name"}'
                                            data-original-title="№ Школы"></a></td></tr>
                                    <tr><td>Класс</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="school-class"
                                            data-original-title="Класс"></a></td></tr>
                                    <tr><td>Дата поступления</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="date"
                                            data-name="school-date-receipt"
                                            data-format="yyyy-mm-dd"
                                            data-placement="left"
                                            data-viewformat="yyyy-mm-dd"
                                            data-original-title="Дата поступления"></a></td></tr>
                                    <tr><td>Дата окончания</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="date"
                                            data-name="school-date-end"
                                            data-format="yyyy-mm-dd"
                                            data-placement="left"
                                            data-viewformat="yyyy-mm-dd"
                                            data-original-title="Дата окончания"></a></td></tr>
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
        dom: 'RC<"clear">lfrtip',
        colVis: {
            exclude: [ 0 ]
        },
        columnDefs: [
            { visible: false, targets: [4, 5, 6, 7] }
        ],
        stateSave: true,
        "ajax": {
            "url": "/sadmin/get/data/people/peoples/",
            "type": "POST"
        },
        "columns": [
            {
                "class":          "details-control",
                "orderable":      false,
                "data":           null,
                "defaultContent": ""
            },
            { "data": "name-l" },
            { "data": "name-f" },
            { "data": "name-s" },
            { "data": "full-name" },
            { "data": "full-address" },
            { "data": "full-phone" },
            { "data": "sex" },
            { "data": "date-birdth" }
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
        $('#peopleAdd a').editable('submit', {
            url: '/sadmin/save/people/add/',
            ajaxOptions: {
                dataType: 'json' //assuming json response
            },
            success: function(data, config) {
                $('#peopleAdd a')
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
    $('.aExPlace').editable({
        typeahead: {remote: {url: '/sadmin/get/typeahead/place/name/name_alt/?q=%QUERY'}},
        success: function(response, newValue) {addElemA(this)}});
    $('.aExStreet').editable({
        typeahead: {remote: {url: '/sadmin/get/typeahead/street/name/name/?q=%QUERY'}},
        success: function(response, newValue) {addElemA(this)}});
    $('.aExKinder').editable({
        typeahead: {remote: {url: '/sadmin/get/typeahead/kindergarten/name/name/?q=%QUERY'}},
        success: function(response, newValue) {addElemA(this)}});
    $('.aExSchool').editable({
        typeahead: {remote: {url: '/sadmin/get/typeahead/school/name/name/?q=%QUERY'}},
        success: function(response, newValue) {addElemA(this)}});
    $('.aExAcademy').editable({
        typeahead: {remote: {url: '/sadmin/get/typeahead/academy/name/name/?q=%QUERY'}},
        success: function(response, newValue) {addElemA(this)}});
    $('.aExMother').editable({
        typeahead: {remote: {url: '/sadmin/get/typeaheadmf/mother/?q=%QUERY'}},
        success: function(response, newValue) {addElemA(this)}});
    $('.aExFather').editable({
        typeahead: {remote: {url: '/sadmin/get/typeaheadmf/father/?q=%QUERY'}},
        success: function(response, newValue) {addElemA(this)}});
});
</script>