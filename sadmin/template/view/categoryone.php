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
                if ($i !== 1) $list .= '</li>';
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
                                data-params=\'{"name":"published","table":"category"}\'
                                data-title="Public"></a>
                        </div>
                        <div class="col-md-4">
                            <small>Заголовок</small><br>
                            <a href="#" class="xedit" id="categoryEditTitle'.$res->$index->id.'"
                                data-pk="'.$res->$index->id.'"
                                data-value="'.$res->$index->title.'"
                                data-params=\'{"name":"title","table":"category"}\'
                                data-title="Заголовок">'.$res->$index->title.'</a>
                        </div>
                        <div class="col-md-2">
                            <small>Алиас</small>
                            <a class="btn btn-xs getTranslitAlias" title="Перевести в транслит из h1"
                                data-toggle="tooltip"
                                data-source="categoryEditTitle'.$res->$index->id.'"
                                data-target="categoryEditAlias'.$res->$index->id.'"
                                data-params=""><span class="fa fa-undo"></span></a>
                            <br>
                            <a href="#" class="xedit" id="categoryEditAlias'.$res->$index->id.'"
                                data-pk="'.$res->$index->id.'"
                                data-value="'.$res->$index->alias.'"
                                data-params=\'{"name":"alias","table":"category"}\'
                                data-title="Алиас">'.$res->$index->alias.'</a>
                        </div>
                        <div class="col-md-4">
                            <small>Путь</small>
                            <a class="btn btn-xs buildPath" title="Перевести в транслит из h1"
                                data-toggle="tooltip"
                                data-source="categoryEditAlias'.$res->$index->id.'"
                                data-target="categoryEditPath'.$res->$index->id.'"
                                data-params=""><span class="fa fa-undo"></span></a>
                            <br>
                            <a href="#" class="xedit" id="categoryEditPath'.$res->$index->id.'"
                                data-pk="'.$res->$index->id.'"
                                data-value="'.$res->$index->path.'"
                                data-params=\'{"name":"path","table":"category"}\'
                                data-title="Путь">'.$res->$index->path.'</a>
                        </div>
                        <div class="col-md-1"><a class="btn btn-danger btn-xs delCategoryItem" data-id="'.$res->$index->id.'" data-categorytypeid="'.$res->$index->categorytype_id.'" data-toggle="modal" data-target="#modalСategoryDel" role="button" href="#">Delete <i class="fa fa-trash"></i></a></div>
                    </div>
                </div>';
            }
        }
    }
    $list .= '</li></ol>';
    return $list;
}

$categoryArray = json_decode($res->categoryArray->params, true);
?>
<div class="padding">
    <div class="row">
        <div class="col-md-12">

            <div class="nav-active-border b-warn top box">
                <div class="nav nav-md">
                    <a data-toggle="modal" data-target="#modalCategoryAdd" class="nav-link success"><i class="fa fa-plus"></i> Add Category item</a>
                    <a data-toggle="modal" data-target="#modalCategoryRefresh" data-id="<?php echo $res->categoryTypeId;?>" class="nav-link"><i class="fa fa-refresh"></i> Category Refresh</a>
                </div>
            </div>

            <div class="box light">
                <div class="box-header"><h2>Category: <?php echo $res->categoryArray->title;?> - <span class="label label-info"><?php echo $res->categoryArray->lang;?></span></h2></div>
                <div class="box-divider m-a-0"></div>
                <div class="box-body">
                    <?
                    echo '<div id="nestable" data-id="'.$res->categoryTypeId.'" class="dd">';
                    echo build_list($categoryArray, $res->categoryItems);
                    echo '</div>';
                    ?>
                </div>
            </div>

        </div>
    </div>
</div>

<!-- Modal for Add Page -->
<div class="modal fade" id="modalCategoryAdd" tabindex="-1" role="dialog" aria-labelledby="contentEdit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Add category item</h4>
                </div>
                <div class="modal-body" id="categoryAdd">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                                <tbody>
                                   <tr class="hidden"><td>Тип меню</td>
                                        <td>
                                        <a href="#" class="myeditable"
                                            data-type="text"
                                            data-name="categorytype_id"
                                            data-value="<?php echo $res->categoryTypeId;?>"
                                            data-title="Тип меню"></a>
                                        </td></tr>
                                   <tr><td>Заголовок</td>
                                        <td>
                                        <a href="#" class="myeditable meClear" id="categoryAddTitle"
                                            data-type="text"
                                            data-name="title"
                                            data-title="Заголовок"></a>
                                        </td></tr>
                                   <tr class="hidden"><td>Алиас</td>
                                        <td>
                                        <a href="#" class="myeditable meClear" id="categoryAddAlias"
                                            data-type="text"
                                            data-name="alias"
                                            data-title="Алиас"></a>
                                        </td></tr>
                                   <tr class="hidden"><td>Lang</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="lang"
                                            data-value="<?php echo $res->categoryArray->lang;?>"
                                            data-source="<?php echo A_URLh;?>get/group/static/lang/"
                                            data-original-title="lang"></a></td></tr>
                                   <tr class="hidden"><td>function</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="function"
                                            data-value="commonPageCtrl"
                                            data-source="<?php echo A_URLh;?>get/group/static/category-function/"
                                            data-original-title="function"></a></td></tr>
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

<div class="modal fade" id="modalСategoryDel" tabindex="-1" role="dialog" aria-labelledby="contentEdit" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Delete category item</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button id="delCategoryItem" data-delCategoryItem="" data-delCategoryType="" type="button" class="btn btn-primary">Delete</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCategoryRefresh" tabindex="-1" role="dialog" aria-labelledby="contentEdit" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Refresh category item</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                    <button id="refreshCategoryItem" data-refreshCategoryItem="" type="button" class="btn btn-primary">Refresh</button>
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
                            table: 'categorytype',
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
        $('#nestable-category').on('click', function(e) {
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
                $('#extFun'+q).hide()
                    .find('a').editable('setValue', '').editable('submit');
                $('#extLink'+q).show()
                    .find('a').editable('setValue', '').editable('submit');
            } else if (newValue === 3) {
                $('#extLink'+q).hide()
                    .find('a').editable('setValue', '').editable('submit');
                $('#extFun'+q).show()
                    .find('a').editable('setValue', 17).editable('submit');
            } else if (newValue === 4) {
                $('#extLink'+q).hide()
                    .find('a').editable('setValue', '').editable('submit');
                $('#extFun'+q).show()
                    .find('a').editable('setValue', '').editable('submit');
            }
            /*
            sCMSAletr('', 'success');
            */
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
            path = ($('#categoryEditPath'+parentId).editable('getValue', true) + path).replace(/\/\//g,'/');
            $('#' + $this.data('target')).editable('setValue', path).editable('submit');
            sCMSAletr('', 'success');
        } else {
            $('#' + $this.data('target')).editable('setValue', path).editable('submit');
            sCMSAletr('', 'success');
        }
    });

    /**
    *   <CategoryAdd
    */
    $('#modalCategoryAdd').on('hidden.bs.modal', function (e) {
        $('#categoryAdd .meClear')
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
        $('#categoryAdd a.myeditable').editable('submit', {
            url: '<?php echo A_URLh;?>save/category/add/',
            ajaxOptions: {
                dataType: 'json'
            },
            success: function(data, config) {
                $('#modalCategoryAdd').modal('hide');
                sCMSAletr(result, 'success', data);
            },
            error: function(errors) {
                sCMSAletr(errors, 'warning');
                console.log(errors);
            }
        });
    });
    $('#categoryAddTitle').editable('option', 'validate', function(v) {
        if(!v) return 'Должно быть заполнено!';
    });
    $('#reset-btn').on('click', function() {
        $('#categoryAdd .meClear')
            .editable('setValue', null)
            .editable('option', 'pk', null)
            .removeClass('editable-unsaved');
        $('.myeditable').editable();
    });
    /* CategoryAdd> */


    /**
    *   <CategoryDel
    */
    $('#modalСategoryDel').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            itemId = button.data('id'),
            categoryTypeId = button.data('categorytypeid'),
            modal = $(this);
        modal.find('#delCategoryItem')
            .data('delCategoryItem', itemId)
            .attr('data-delCategoryItem', itemId);
        modal.find('#delCategoryItem')
            .data('delCategoryType', categoryTypeId)
            .attr('data-delCategoryType', categoryTypeId);
    }).on('hidden.bs.modal', function (e) {
        $(document).trigger("pjaxReload");
    })
    $('#delCategoryItem').on('click', function(event) {
        event.preventDefault();
        var $this = $(this),
            id = $this.data('delCategoryItem'),
            categorytype_id = $this.data('delCategoryType');
        $.ajax({
            type: 'POST',
            url: '<?php echo A_URLh;?>save/category/del/',
            data: {
                id: id,
                categorytype_id: categorytype_id
            }
        })
        .done(function(result) {
            $('#modalСategoryDel').modal('hide');
            sCMSAletr(result, 'success');
        });
    });
    /* CategoryDel> */


    /**
    *   <CategoryRefresh
    */
    $('#modalCategoryRefresh').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            itemId = button.data('id'),
            modal = $(this);
        modal.find('#refreshCategoryItem').data('refreshCategoryItem', itemId).attr('data-refreshCategoryItem', itemId);
    }).on('hidden.bs.modal', function (e) {
        $(document).trigger("pjaxReload");
    })
    $('#refreshCategoryItem').on('click', function(event) {
        event.preventDefault();
        var $this = $(this),
            id = $this.data('refreshCategoryItem');
        $.ajax({
            type: 'POST',
            url: '<?php echo A_URLh;?>save/category/refresh/',
            data: {id:id}
        })
        .done(function(result) {
            $('#modalCategoryRefresh').modal('hide');
            sCMSAletr(result, 'success');
        });
    });
    /* CategoryRefresh> */

    $('.thCategoryLinkId').editable({
        url: '<?php echo A_URLh;?>saveth/',
        typeahead: {name: 'link_id', remote: {url: '<?php echo A_URLh;?>get/typeahead/content/h1/h1/?q=%QUERY'}},
        success: function(response, newValue) {
            // addElemA(this, response, newValue);
            sCMSAletr(response, 'success', newValue);
        }
    });
});
</script>