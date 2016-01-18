'use strict';

$(function() {
    $("[data-toggle='popover']").popover();
    $("[data-toggle='tooltip']").tooltip();
    $("body").on('click', '.jedCheck', function() {
        $.post('/sadmin/ajax/save-to-db-check.php', {
            params: $(this).data('params'),
            check: $(this).prop('checked')
        }, function(sValue) {
            $(this).prop('checked', function(i,val){return !val;});
            $.jGrowl('Новое значение поля = ' + sValue, {
                theme: 'lightness',
                header: "Состояние запроса:",
                life: 1500
            });
        });
    })
    $('.edit_sel').editable('/sadmin/ajax/save-to-db-select.php', { 
        type        : 'select',
        loadurl     : '/sadmin/ajax/load-secelt-from-db.php',
        loaddata    : function(value) {
            return {params: $(this).data('select')};
        },
        submitdata: function() {
            return {
                params: $(this).data('params'),
                sel: $(this).data('select')
            }
        },
        callback    : function(value) {
            $.jGrowl('Новое значение поля = ' + value, {
                theme: 'lightness',
                header: "Состояние запроса:",
                life: 1500
            });
        },
        event       : 'click',
        submit      : 'OK'
    });
    $('.edit_area').editable('/sadmin/ajax/save-to-db.php', {
        type        : 'textarea',
        callback    : function(value) {
            $.jGrowl('Новое значение поля = ' + value, {
                theme: 'lightness',
                header: "Состояние запроса:",
                life: 1500
            });
        },
        submitdata: {
            params: $(this).data('params')
        },
        height      : '150',
        width       : '300',
        submit      : 'OK',
        event       : 'click'
    });
    $('.edit_snippet').editable('/sadmin/ajax/save-to-db.php', {
        type        : 'textarea',
        callback    : function(value) {
            $.jGrowl('Новое значение поля = ' + value, {
                theme: 'lightness',
                header: "Состояние запроса:",
                life: 1500
            });
        },
        submitdata: {
            params: $(this).data('params')
        },
        height      : '150',
        width       : '94%',
        submit      : '<div class="col-md-8"></div><div class="col-md-4"><input class="btn btn-primary btn-block" type="button" value="Сохранить"></div>',
        event       : 'click'
    });
    $(".edit_row").editable("/sadmin/ajax/save-to-db.php", {
        callback: function(value) {
            $.jGrowl('Новое значение поля = ' + value, {
                theme: 'lightness',
                header: "Состояние запроса:",
                life: 1500
            });
        },
        submitdata: {
            params: $(this).data('params')
        },
        height      : '28',
        width       : '170',
        event: "click"
    });
})
