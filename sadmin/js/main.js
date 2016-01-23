'use strict';

$(function() {
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
     * Extension Scripts
     * @return {[type]} [description]
     */
    $("body").on('click', '.extensionEdit', function() {
        //event.preventDefault();
        var $this = $(this),
            id = $this.data('id'),
            _params = $this.data('params') ? $this.data('params') : [],
            $ACont = $("#ajaxContent");
        $ACont.empty();
        $ACont.data('contentid', id);
        if(_params.file)
            $.ajax({
                type: "POST",
                url: _params.file,
                data: {
                    id: id,
                    params: _params
                }
            }).done(function(result) {
                $ACont.html(result);
            });
        else
            $.ajax({
                type: "POST",
                url: "/sadmin/ajax/extension-snippet-edit.php",
                data: {
                    id: id,
                    params: _params
                }
            }).done(function(result) {
                $ACont.html(result);
            });
    });


    /**
     * Modules Scripts
     * @return {[type]} [description]
     */
    $("body").on('click', '.moduleVisibleEdit', function() {
        //event.preventDefault();
        var $this = $(this),
            id = $this.data('id'),
            _params = $this.data('params') ? $this.data('params') : [],
            $ACont = $("#ajaxContent");
        $ACont.empty();
        $ACont.data('contentid', id);
        $.ajax({
            type: "POST",
            url: '/sadmin/ajax/module-visible.php',
            data: {
                id: id,
                params: _params
            }
        }).done(function(result) {
            $ACont.html(result);
        });
    });
    $("body").on('click', '.moduleEdit', function() {
        //event.preventDefault();
        var $this = $(this),
            id = $this.data('id'),
            _params = $this.data('params') ? $this.data('params') : [],
            $ACont = $("#ajaxContent");
        $ACont.empty();
        $ACont.data('contentid', id);
        $.ajax({
            type: "POST",
            url: _params.file,
            data: {
                id: id,
                params: _params
            }
        }).done(function(result) {
            $ACont.html(result);
        });
    });
    $("body").on('click', '.jedCheckVisible', function() {
        $.post('/sadmin/ajax/module-visible-add.php', {
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
    $("body").on('click', '.jedCheckLink', function() {
        $.post('/sadmin/ajax/module-link-useful-add.php', {
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
    /*$("body").on('click', '.articleEdit', function(event) {
        event.preventDefault();
        var $this = $(this),
            id = $this.data('id'),
            $ACont = $("#editor");
        $('#editor').data('cid', id).attr('data-cid', id);
        console.log(id);
        $ACont.empty();
        $ACont.data('contentid', id);
        $.ajax({
            type: "POST",
            url: "/sadmin/ajax/content-body-article-edit.php",
            data: {
                id: id
            }
        }).done(function(result) {
            $ACont.html(result);
            $('input[id=file]').data('id', id);
        });
    });*/
    $("body").on('click', '.ToTranslit', function(event) {
        event.preventDefault();
        var $this = $(this),
            id = $this.data('id');
        $.ajax({
            type: "POST",
            url: "/sadmin/ajax/_to-translit.php",
            data: {
                params: $this.data('params'),
                id: $this.data('id')
            }
        })
        .done(function(result) {
            $this.prev('span').text(result);
            $.jGrowl('Новое значение поля = '+result, {
                theme: 'lightness',
                header: "Состояние запроса:",
                life: 1500
            })
        });
    });




    /**
     * All page Scripts
     * @return {[type]} [description]
     */
    $("[data-toggle='popover']").popover();
    $("[data-toggle='tooltip']").tooltip();
    $("body").on('click', '#RowAdd', function(event) {
        var $this = $(this),
            promises;
        event.preventDefault();
        promises = $.map([$this.attr('href')], function(urls) {
            return $.ajax({
                url : urls,
                data : {'params': $this.data('params')},
                type : "post"
            }).then(function(result) {
                $.jGrowl('Новая страница добавлена, обновите страницу!', {
                    theme: 'lightness',
                    header: "Состояние запроса:",
                    life: 1500
                })
            })
        });
    });
    $("body").on('click', '.RowDel', function(event) {
        var $this = $(this),
            promises;

        event.preventDefault();
        if ($this.parent().prev().find('input').prop('checked') === false) {return false;};
        promises = $.map([$this.attr('href')], function(urls) {
            return $.ajax({
                url : urls,
                data : {'params': $this.data('params')},
                type : "post"
            }).then(function(result) {
                $.jGrowl('Страница удалена, обновите страницу!', {
                    theme: 'lightness',
                    header: "Состояние запроса:",
                    life: 1500
                })
            })
        });
    });
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
        loadurl     : '/sadmin/ajax/load-select-from-db.php',
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
    $('.edit_sel_custom').editable('/sadmin/ajax/save-to-db.php', {
        type        : 'select',
        loadurl     :  '/sadmin/ajax/select-custom.php',
        loaddata    : function(value) {
            return {params: $(this).data('case')};
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
        height      : '200',
        width       : '100%',
        submit      : 'OK',
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
        height      : '24',
        width       : '250',
        event: "click"
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
