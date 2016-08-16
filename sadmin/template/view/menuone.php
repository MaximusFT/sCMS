<?
function build_list($array, $res) {
    $list = '<ol class="dd-list">';
    foreach($array as $key => $value) {
        $i == 0;
        foreach($value as $key => $index) {
            $i++;
            if(is_array($index)) {
                $list .= build_list($index, $res);
                $list .= '</li>';
            } else {
                $resHomeClass = ($res->$index->home == true)?'btn-success disabled':'btn-info btn-HomeSet';
                $resHomeVal = ($res->$index->home == true)?'true':'false';
                if ($i !== 1) $list .= '</li>';
                $catStatic = 'style="display: none;"';
                $catModule = 'style="display: none;"';
                $catCategory = 'style="display: none;"';
                $catCategoryType = 'style="display: none;"';
                $catFileName = 'style="display: none;"';

                $res->$index->params = json_decode($res->$index->params);

                if ($res->$index->extension_id == 1) {
                    $catStatic = '';
                } elseif ($res->$index->extension_id == 21) {
                    $catModule = '';
                } elseif ($res->$index->extension_id == 3 || $res->$index->extension_id == 4) {
                    $catCategory = '';
                } elseif ($res->$index->extension_id == 5) {
                    $catCategoryType = '';
                } elseif ($res->$index->extension_id == 6) {
                    $catStatic = '';
                    // $catFileName = '';
                }
                $list .= '<li data-id="'.$index.'" class="dd-item dd3-item"><div class="dd-handle dd3-handle"><span class="fa fa-bars"></span></div>
                <div class="dd3-content">
                    <div class="row">
                        <div class="col-md-1 text-center">
                            <small>Public</small><br>
                            <a href="#" class="xeditcheck"
                                data-pk="'.$res->$index->id.'"
                                data-type="checklist"
                                data-value="'.$res->$index->published.'"
                                data-source=\'{"1":"true"}\'
                                data-emptytext="\'false\'"
                                data-params=\'{"name":"published","table":"menu"}\'
                                data-title="Public"></a>
                        </div>
                        <div class="col-md-1 text-center">
                            <small>Главная</small><br>
                            <a href="#" class="btn '.$resHomeClass.' btn-xs"
                                data-id="'.$res->$index->id.'"
                                data-mt_id="'.$res->$index->menutype_id.'"
                                data-lang="'.$res->$index->lang.'"
                                data-value="'.$res->$index->home.'"
                                data-title="Главная">'.$resHomeVal.'</a>
                        </div>
                        <div class="col-md-5">
                            <small>Заголовок</small><br>
                            <a href="#" class="xedit" id="menuEditTitle'.$res->$index->id.'"
                                data-pk="'.$res->$index->id.'"
                                data-value="'.$res->$index->title.'"
                                data-params=\'{"name":"title","table":"menu"}\'
                                data-title="Заголовок">'.$res->$index->title.'</a>
                        </div>
                        <div class="col-md-2">
                            <small>Алиас</small>
                            <a class="btn btn-xs getTranslitAlias" title="Перевести в транслит из h1"
                                data-toggle="tooltip"
                                data-source="menuEditTitle'.$res->$index->id.'"
                                data-target="menuEditAlias'.$res->$index->id.'"
                                data-params=""><span class="fa fa-undo"></span></a>
                            <br>
                            <a href="#" class="xedit" id="menuEditAlias'.$res->$index->id.'"
                                data-pk="'.$res->$index->id.'"
                                data-value="'.$res->$index->alias.'"
                                data-params=\'{"name":"alias","table":"menu"}\'
                                data-title="Алиас">'.$res->$index->alias.'</a>
                        </div>
                        <div class="col-md-2">
                            <small>Путь</small>
                            <a class="btn btn-xs buildPath" title="Перевести в транслит из h1"
                                data-toggle="tooltip"
                                data-source="menuEditAlias'.$res->$index->id.'"
                                data-target="menuEditPath'.$res->$index->id.'"
                                data-params=""><span class="fa fa-undo"></span></a>
                            <br>
                            <a href="#" class="xedit" id="menuEditPath'.$res->$index->id.'"
                                data-pk="'.$res->$index->id.'"
                                data-value="'.$res->$index->path.'"
                                data-params=\'{"name":"path","table":"menu"}\'
                                data-title="Путь">'.$res->$index->path.'</a>
                        </div>
                        <div class="col-md-1"><a class="btn btn-primary pull-right" role="button" data-toggle="collapse" href="#collapse'.$res->$index->id.'" aria-expanded="false" aria-controls="collapseExample">Edit <i class="fa fa-angle-double-down"></i></a></div>
                    </div>
                    <div class="collapse" id="collapse'.$res->$index->id.'">
                        <hr>
                        <div class="well well-sm">
                            <div class="row">
                                <div class="col-md-4">
                                    <dl class="dl-horizontal">
                                        <dt><small>Метод вызова</small></dt>
                                        <dd>
                                            <a href="#" class="xedit"
                                                data-pk="'.$res->$index->id.'"
                                                data-type="select"
                                                data-source="'.A_URLh.'get/group/static/menu-method/"
                                                data-value="'.$res->$index->method.'"
                                                data-params=\'{"name":"method","table":"menu"}\'
                                                data-title="Метод вызова">'.$res->$index->method.'</a>
                                        </dd>

                                        <dt><small>Тип расширения</small></dt>
                                        <dd>
                                            <a href="#" class="xeditExt"
                                                data-pk="'.$res->$index->id.'"
                                                data-type="select"
                                                data-value="'.$res->$index->extension_id.'"
                                                data-source="'.A_URLh.'get/group/extension/title/type/component/"
                                                data-params=\'{"name":"extension_id","table":"menu"}\'
                                                data-title="Тип расширения">'.$res->$index->extension_title.'</a>
                                        </dd>

                                        <div id="extMod'.$res->$index->id.'" '.$catModule.'>
                                            <dt><small>Модуль</small></dt>
                                            <dd>
                                                <a href="#" class="xedit"
                                                    data-pk="'.$res->$index->id.'"
                                                    data-type="select"
                                                    data-value="'.$res->$index->category_id.'"
                                                    data-source="'.A_URLh.'get/group/module/title/extension_id/21/"
                                                    data-params=\'{"name":"category_id","table":"menu"}\'
                                                    data-title="Модуль">'.$res->$index->category_id_title.'</a>
                                            </dd>
                                        </div>

                                        <div id="extCat'.$res->$index->id.'" '.$catCategory.'>
                                            <dt><small>Категория</small></dt>
                                            <dd>
                                                <a href="#" class="xedit"
                                                    data-pk="'.$res->$index->id.'"
                                                    data-type="select"
                                                    data-value="'.$res->$index->category_id.'"
                                                    data-source="'.A_URLh.'get/group/simple/category/title/"
                                                    data-params=\'{"name":"category_id","table":"menu"}\'
                                                    data-title="Категория">'.$res->$index->category_id_title.'</a>
                                            </dd>
                                        </div>
                                        <div id="extCatType'.$res->$index->id.'" '.$catCategoryType.'>
                                            <dt><small>Группа категорий</small></dt>
                                            <dd>
                                                <a href="#" class="xedit"
                                                    data-pk="'.$res->$index->id.'"
                                                    data-type="select"
                                                    data-value="'.$res->$index->category_id.'"
                                                    data-source="'.A_URLh.'get/group/simple/categorytype/title/"
                                                    data-params=\'{"name":"category_id","table":"menu"}\'
                                                    data-title="Категория">'.$res->$index->category_id_title.'</a>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                                <div class="col-md-7">
                                    <dl>
                                        <div id="extLink'.$res->$index->id.'" '.$catStatic.'>
                                            <dt><small>Ссылка на материал</small></dt>
                                            <dd>
                                                <a href="#" class="thMenuLinkId"
                                                    data-pk="'.$res->$index->id.'"
                                                    data-type="typeaheadjs"
                                                    data-typeparams=\'{"extension_id":'.$res->$index->extension_id.',"category_id":'.$res->$index->category_id.',"_id":'.$res->$index->id.'}\'
                                                    data-params=\'{"name":"link_id","table":"menu"}\'
                                                    data-title="Ссылка на материал">'.$res->$index->link_title.'</a>
                                            </dd>
                                        </div>
                                        <div id="fileName'.$res->$index->id.'" '.$catFileName.'>
                                            <dt><small>Имя файла</small></dt>
                                            <dd>
                                                <a href="#" class="xeditParams"
                                                    data-pk="'.$res->$index->id.'"
                                                    data-value="'.$res->$index->params->fileName.'"
                                                    data-params=\'{"name":"fileName","table":"menu"}\'
                                                    data-title="Имя файла">'.$res->$index->params->fileName.'</a>
                                            </dd>
                                        </div>
                                    </dl>
                                </div>
                                <div class="col-md-1">
                                    <a class="btn btn-danger btn-xs delMenuItem" data-id="'.$res->$index->id.'" data-menutypeid="'.$res->$index->menutype_id.'" data-toggle="modal" data-target="#modalMenuDel" role="button" href="#">Delete <i class="fa fa-trash"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
            }
        }
    }
    $list .= '</li></ol>';
    return $list;
}

$menuArray = json_decode($res->menuArray->params, true);

?>
<div class="padding">
    <div class="row">
        <div class="col-md-12">

            <div class="nav-active-border b-warn top box">
                <div class="nav nav-md">
                    <a data-toggle="modal" data-target="#modalMenuAdd" class="nav-link success"><i class="fa fa-plus"></i> Add Menu item</a>
                    <a data-toggle="modal" data-target="#modalMenuRefresh" data-id="<?php echo $res->menuTypeId;?>" class="nav-link"><i class="fa fa-refresh"></i> Menu Refresh</a>
                </div>
            </div>

            <div class="box light">
                <div class="box-header"><h2>Menu: <?php echo $res->menuArray->title;?> - <span class="label label-info"><?php echo $res->menuArray->lang;?></span></h2></div>
                <div class="box-divider m-a-0"></div>
                <div class="box-body">
                    <?
                    echo '<div id="nestable" data-id="'.$res->menuTypeId.'" class="dd">';
                    echo build_list($menuArray, $res->menuItems);
                    echo '</div>';
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal for Add Page -->
<div class="modal fade" id="modalMenuAdd" tabindex="-1" role="dialog" aria-labelledby="contentEdit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Add menu item</h4>
                </div>
                <div class="modal-body" id="menuAdd">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                                <tbody>
                                   <tr class="hidden"><td>Тип меню</td>
                                        <td>
                                        <a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="menutype_id"
                                            data-value="<?php echo $res->menuTypeId;?>"
                                            data-title="Тип меню"></a>
                                        </td></tr>
                                   <tr><td>Заголовок</td>
                                        <td>
                                        <a href="#" class="myeditable meClear" id="menuAddTitle"
                                            data-type="text"
                                            data-name="title"
                                            data-title="Заголовок"></a>
                                        </td></tr>
                                   <tr><td>Алиас</td>
                                        <td>
                                        <a href="#" class="myeditable meClear" id="menuAddAlias"
                                            data-type="text"
                                            data-name="alias"
                                            data-title="Алиас"></a>
                                        </td></tr>
                                   <tr><td>Method</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="method"
                                            data-value="GET"
                                            data-source="<?php echo A_URLh;?>get/group/static/menu-method/"
                                            data-original-title="menutype_id"></a></td></tr>
                                   <tr class="hidden"><td>Lang</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="lang"
                                            data-value="<?php echo $res->menuArray->lang;?>"
                                            data-source="<?php echo A_URLh;?>get/group/static/lang/"
                                            data-original-title="lang"></a></td></tr>
                                   <tr><td>Тип расширения</td>
                                        <td>
                                        <a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="extension_id"
                                            data-value="1"
                                            data-source="<?php echo A_URLh;?>get/group/extension/title/type/component/"
                                            data-title="Тип расширения"></a>
                                        </td></tr>
                                   <tr class="hidden"><td>category_id</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="category_id"
                                            data-value="commonPageCtrl"
                                            data-source="<?php echo A_URLh;?>get/group/simple/category/title/"
                                            data-original-title="category_id"></a></td></tr>
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

<div class="modal fade" id="modalMenuDel" tabindex="-1" role="dialog" aria-labelledby="contentEdit" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Delete menu item</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button id="delMenuItem" data-delMenuItem="" data-delMenuType="" type="button" class="btn btn-primary">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalMenuRefresh" tabindex="-1" role="dialog" aria-labelledby="contentEdit" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Refresh menu item</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button id="refreshMenuItem" data-refreshMenuItem="" type="button" class="btn btn-primary">Refresh</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
'use strict';

(function() {
    'use strict';
    $(function() {
        if (!$('#nestable').length) return;
        var updateOutput = function(e) {
            var list = e.length ? e : $(e.target);
            if (window.JSON) {
                if (list.nestable('serialize').length === 0) return;
                $.ajax({
                        type: "POST",
                        url: "<?php echo A_URLh;?>save/",
                        data: {
                            table: 'menutype',
                            name: 'params',
                            value: window.JSON.stringify(list.nestable('serialize')),
                            pk: list.data('id')
                        }
                    })
                    .done(function(result) {
                        sCMSAletr(result, 'success');
                    });
            }
        };
        $('#nestable').nestable().on('change', updateOutput);
        updateOutput($('#nestable').data('output', $('#nestable-output')));
        $('#nestable-menu').on('click', function(e) {
            var target = $(e.target),
                action = target.data('action');
            if (action === 'expand-all') {
                $('.dd').nestable('expandAll');
            }
            if (action === 'collapse-all') {
                $('.dd').nestable('collapseAll');
            }
        });
    });
})();

$(function() {
    'use strict';
    xEdit();
    $('.myeditable').editable();
    $('.xeditExt').editable({
        url: '<?php echo A_URLh;?>save/',
        success: function(response, newValue) {
            var q = $(this).data('pk');
            newValue = parseInt(newValue);
            if (newValue === 1) {
                $('#extCat'+q).hide().find('a').editable('setValue', '').editable('submit');
                // $('#fileName'+q).hide().find('a').editable('setValue', '').editable('submit');
                $('#extCatType'+q).hide().find('a').editable('setValue', '').editable('submit');
                $('#extLink'+q).show().find('a').editable('setValue', '').editable('submit');
                var qwe = $('#extLink'+q).find('a').data('typeparams');
                qwe.extension_id = newValue;
                $('#extLink'+q).find('a').data('typeparams', qwe);
                $('#extLink'+q).find('a').editable('destroy').editable({
                    url: '<?php echo A_URLh;?>saveth/',
                    typeahead: {name:'link_id',remote:{url: '<?php echo A_URLh;?>get/typeaheadlink/content/h1/h1/?q=%QUERY'}},
                    success: function(response, newValue) {
                        sCMSAletr(response, 'success', newValue);
                    }
                });
            } else if (newValue === 4) {
                $('#extLink'+q).hide().find('a').editable('setValue', '').editable('submit');
                $('#extCatType'+q).hide().find('a').editable('setValue', '').editable('submit');
                $('#extCat'+q).show().find('a').editable('setValue', '').editable('submit');
                $('#extMod'+q).hide();
            } else if (newValue === 5) {
                $('#extCat'+q).hide().find('a').editable('setValue', '').editable('submit');
                $('#extLink'+q).hide().find('a').editable('setValue', '').editable('submit');
                $('#extCatType'+q).show().find('a').editable('setValue', '').editable('submit');
                $('#extMod'+q).hide();
            } else if (newValue === 19) {
                $('#extCat'+q).hide().find('a').editable('setValue', '').editable('submit');
                $('#extCatType'+q).hide().find('a').editable('setValue', '').editable('submit');
                $('#extLink'+q).hide().find('a').editable('setValue', '').editable('submit');
                $('#extMod'+q).hide();
            } else if (newValue === 21) {
                $('#extMod'+q).show().find('a').editable('setValue', '').editable('submit');
                $('#extLink'+q).hide().find('a').editable('setValue', '').editable('submit');
                $('#extCat'+q).hide();
                $('#extCatType'+q).hide();
            } else if (newValue === 6) {
                $('#extCat'+q).hide();
                $('#extCat'+q).hide().find('a').editable('setValue', '').editable('submit');
                $('#extCatType'+q).hide().find('a').editable('setValue', '').editable('submit');
                $('#extLink'+q).show().find('a').editable('setValue', '').editable('submit');
                var qwe = $('#extLink'+q).find('a').data('typeparams');
                qwe.extension_id = newValue;
                $('#extLink'+q).find('a').data('typeparams', qwe);
                $('#extLink'+q).find('a').editable('destroy').editable({
                    url: '<?php echo A_URLh;?>saveth/',
                    typeahead: {name:'link_id',remote:{url: '<?php echo A_URLh;?>get/typeaheadlink/content/h1/h1/?q=%QUERY'}},
                    success: function(response, newValue) {
                        sCMSAletr(response, 'success', newValue);
                    }
                });
                // $('#fileName'+q).show().find('a').editable('setValue', '').editable('submit');
            }
        }
    })
    $("body").on('click', '.getTranslitAlias', function(event) {
        var $this = $(this);
        event.preventDefault();
        $.ajax({
            type: "POST",
            url: "<?php echo A_URLh;?>get/translit/",
            data: {params: $('#' + $this.data('source')).editable('getValue', true)}
        }).done(function(result) {
            $('#' + $this.data('target')).editable('setValue', result).editable('submit');
            sCMSAletr(result, 'success');
        });
    });
    $("body").on('click', '.buildPath', function(event) {
        event.preventDefault();
        var $this = $(this),
            src = $('#' + $this.data('source')).editable('getValue', true),
            path = '/'+src+'/',
            parentId = $this.parents('.dd-item').parents('.dd-item').data('id');
        if (parentId !== undefined) {
            path = ($('#menuEditPath'+parentId).editable('getValue', true) + path).replace(/\/\//g,'/');
            $('#' + $this.data('target')).editable('setValue', path).editable('submit');
            sCMSAletr('', 'success');
        } else {
            $('#' + $this.data('target')).editable('setValue', path).editable('submit');
            sCMSAletr('', 'success');
        }
    });

    /**
    *   <MenuAdd
    */
    $('#modalMenuAdd').on('hidden.bs.modal', function (e) {
        $('#menuAdd .meClear')
            .editable('setValue', null)
            .editable('option', 'pk', null)
            .removeClass('editable-unsaved');
        $('.myeditable').editable();
        $(document).trigger("pjaxReload");
    })
    $('.myeditable').on('save.newuser', function(){
        var that = this;
        setTimeout(function() {
            $(that).closest('tr').next().find('.myeditable').editable('show');
        }, 200);
    });
    $('#save-btn').on('click', function() {
        $('#menuAdd a.myeditable').editable('submit', {
            url: '<?php echo A_URLh;?>save/menu/add/',
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(data, config) {
                $('#modalMenuAdd').modal('hide');
                sCMSAletr('', 'success', data);
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
    /* MenuAdd> */


    /**
    *   <MenuDel
    */
    $('#modalMenuDel').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            itemId = button.data('id'),
            menuTypeId = button.data('menutypeid'),
            modal = $(this);
        modal.find('#delMenuItem')
            .data('delMenuItem', itemId)
            .attr('data-delMenuItem', itemId);
        modal.find('#delMenuItem')
            .data('delMenuType', menuTypeId)
            .attr('data-delMenuType', menuTypeId);
    }).on('hidden.bs.modal', function (e) {
        $(document).trigger("pjaxReload");
    })
    $('#delMenuItem').on('click', function(event) {
        event.preventDefault();
        var $this = $(this),
            id = $this.data('delMenuItem'),
            menutype_id = $this.data('delMenuType');
        $.ajax({
            type: 'POST',
            url: '<?php echo A_URLh;?>save/menu/del/',
            data: {
                id: id,
                menutype_id: menutype_id
            }
        })
        .done(function(result) {
            $('#modalMenuDel').modal('hide');
            sCMSAletr(result, 'success');
        });
    });
    /* MenuDel> */


    /**
    *   <MenuRefresh
    */
    $('#modalMenuRefresh').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            itemId = button.data('id'),
            modal = $(this);
        modal.find('#refreshMenuItem').data('refreshMenuItem', itemId).attr('data-refreshMenuItem', itemId);
    }).on('hidden.bs.modal', function (e) {
        $(document).trigger("pjaxReload");
    })
    $('#refreshMenuItem').on('click', function(event) {
        event.preventDefault();
        var $this = $(this),
            id = $this.data('refreshMenuItem');
        $.ajax({
            type: 'POST',
            url: '<?php echo A_URLh;?>save/menu/refresh/',
            data: {id:id}
        })
        .done(function(result) {
            $('#modalMenuRefresh').modal('hide');
            sCMSAletr(result, 'success');
        });
    });
    /* MenuRefresh> */


    /**
    *   <MenuSetHomepage
    */
    $('.btn-HomeSet').on('click', function(event) {
        event.preventDefault();
        var $this = $(this),
            lang = $this.data('lang'),
            mt_id = $this.data('mt_id'),
            id = $this.data('id');
        $.ajax({
            type: 'POST',
            url: '<?php echo A_URLh;?>save/menu/homepage/',
            data: {id:id,mt_id:mt_id,lang:lang}
        })
        .done(function(result) {
            sCMSAletr(result, 'success');
            $(document).trigger("pjaxReload");
        });
    });
    /* MenuRefresh> */

    $('.thMenuLinkId').editable({
        url: '<?php echo A_URLh;?>saveth/',
        typeahead: {name: 'link_id',remote: {url: '<?php echo A_URLh;?>get/typeaheadlink/content/h1/h1/?q=%QUERY'}},
        success: function(response, newValue) {
            sCMSAletr(response, 'success', newValue);
        }
    });
});
</script>