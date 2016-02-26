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
    $('.aCountry').editable({
        url: '/sadmin/save/',
        typeahead: {
            name: 'name',
            remote: {
                url: '/sadmin/get/typeahead/country/name/name/?q=%QUERY'
            }
        },
        success: function(response, newValue) { xjGrowl(response, newValue) }
    })
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


    /**
     * Menu Scripts
     * @return {[type]} [description]
     */
    $("body").on('click', '.linkArticle', function() {
        //event.preventDefault();
        var $this = $(this),
            params = $this.data('params'),
            $ACont = $("#AjaxContent");
        $ACont.empty();
        $ACont.data('contentid', params);
        $.get( '/sadmin/ajax/content-show-article.php' , function( data ) {
            $ACont.html(data);
        });
    });
    $("body").on('click', '.linkArticleAdd', function() {
        var $this = $(this),
            $ACont = $("#AjaxContent"),
            menuid = $ACont.data('contentid');
        $.ajax({
            type: "POST",
            url: "/sadmin/ajax/content-show-article-add.php",
            data: {
                params: $this.data('params'),
                menu_id: menuid
            }
        })
        .done(function(result) {
            $('#modalLinkArticle').modal('hide');
            $ACont.empty();
            $('.LinkArticle[data-params = ' + menuid + ']').empty().html( result.id + ' <span class="glyphicon glyphicon-link"></span>');
            $.jGrowl('Новое значение поля = '+result.title, {
                theme: 'lightness',
                header: "Состояние запроса:",
                life: 1500
            })
        });
    });

    /**
     * Content Scripts
     * @return {[type]} [description]
     */
    $("body").on('click', '.contentEdit', function(event) {
        event.preventDefault();
        var $this = $(this),
            id = $this.data('id'),
            $ACont = $("#ajaxContent");
        $ACont.empty();
        $ACont.data('contentid', id);
        $.ajax({
            type: "POST",
            url: "/sadmin/ajax/content-show-article-edit.php",
            data: {
                id: id
            }
        }).done(function(result) {
            $ACont.html(result);
        });
    });

    $("body").on('click', '.getTranslit', function(event) {
        event.preventDefault();
        var $this = $(this);
        $.ajax({
            type: "POST",
            url: "/sadmin/get/translit/",
            data: {params: $('#' + $this.data('source')).editable('getValue', true)}
        }).done(function(result) {
            $('#' + $this.data('target')).editable('setValue', result);
            xjGrowl('Значение поля было обновлено!', result);
        });
    });

    $('.btnWSave').on('click', function(event){
        event.preventDefault();
        var $this = $(this),
            params = $('#editor').data('params'),
            htmlx = $('.btnWSave').data('htmlx'),
            cid = $('#editor').data('cid'),
            text = $('#editor').html();

            if (htmlx === false) {
                text = $('#editor').text();
            };
        $.ajax({
            type: "POST",
            url: "/sadmin/ajax/save-to-db-full.php",
            data: {
                value: text,
                params: params,
                id: cid
            }
        })
        .done(function(result) {
            $('#modalContentBodyEdit').modal('hide');
            $.jGrowl('Запись успешно изменена.', {
                theme: 'lightness',
                header: "Состояние запроса:",
                life: 1500
            })
        });
    })
})
