'use strict';

function xEdit(){
    $('.xeditAddDate').datepicker({
        format: "yyyy-mm-dd",
        language: "ru",
        autoclose: true
    });
    $('.xedit').editable({
        url: '/sadmin/save/',
        success: function(response, newValue) { xjGrowl(response, newValue) }
    })
    $('.xeditcheck').editable({
        url: '/sadmin/save/check/',
        success: function(response, newValue) { xjGrowl(response, newValue) }
    })
    $('.xeditParams').editable({
        url: '/sadmin/save/params/',
        success: function(response, newValue) { xjGrowl(response, newValue) }
    })
    // $('.thMenuLinkIds').editable({
    //     url: '/sadmin/save/',
    //     typeahead: {
    //         name: 'name',
    //         remote: {
    //             url: '/sadmin/get/typeahead/country/name/name/?q=%QUERY'
    //         }
    //     },
    //     success: function(response, newValue) { xjGrowl(response, newValue) }
    // })
}

$(function() {

    $('#appGo').appGo();

    $('#appReload').on('click', function(){
        $(this).appGo('reload');
    })

    $('#mainMenu').find('a[data-match-name='+$('#mainMenu').data('match-now')+']').parent().addClass('active');

    /*
    $('.form_datetime').datetimepicker({
        language:  'ru',
        weekStart: 1,
        todayBtn:  1,
        autoclose: 1,
        todayHighlight: 1
    }).on('changeDate', function(ev){
        if (ev.date.valueOf()){
            console.log(ev);
        }
    });
    */
})
