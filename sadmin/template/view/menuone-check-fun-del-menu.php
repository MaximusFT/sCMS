<?
function build_list($array, $res) {
    $list = '<ol class="dd-list">';
    foreach($array as $key => $value) {
        $i == 0;
        foreach($value as $key => $index) {
            $i++;
            if(is_array($index)) {
                $list .= build_list($index, $res);
                echo '</li>';
            } else {
                $resHomeClass = ($res->$index->home == true)?'btn-success disabled':'btn-info btn-HomeSet';
                $resHomeVal = ($res->$index->home == true)?'true':'false';
                if ($i !== 1) echo '</li>';
                $list .= '<li data-id="'.$index.'" class="dd-item dd3-item"><div class="dd-handle dd3-handle"><span class="fa fa-bars"></span></div>
                <div class="dd3-content">
                    <div class="row">
                        <div class="col-md-1 text-center">
                            <small>Public</small><br>
                            <a href="#" class="xedit"
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
                                data-pk="'.$res->$index->id.'"
                                data-value="'.$res->$index->home.'"
                                data-params=\'{"name":"home","table":"menu"}\'
                                data-title="Главная">'.$resHomeVal.'</a>
                        </div>
                        <div class="col-md-6">
                            <small>Заголовок</small><br>
                            <a href="#" class="xedit"
                                data-pk="'.$res->$index->id.'"
                                data-value="'.$res->$index->title.'"
                                data-params=\'{"name":"title","table":"menu"}\'
                                data-title="Заголовок">'.$res->$index->title.'</a>
                        </div>
                        <div class="col-md-3">
                            <small>Алиас</small><br>
                            <a href="#" class="xedit"
                                data-pk="'.$res->$index->id.'"
                                data-value="'.$res->$index->alias.'"
                                data-params=\'{"name":"alias","table":"menu"}\'
                                data-title="Алиас">'.$res->$index->alias.'</a>
                        </div>
                        <div class="col-md-1"><a class="btn btn-primary pull-right" role="button" data-toggle="collapse" href="#collapse'.$res->$index->id.'" aria-expanded="false" aria-controls="collapseExample">Edit <i class="fa fa-angle-double-down"></i></a></div>
                    </div>
                    <div class="collapse" id="collapse'.$res->$index->id.'">
                        <hr>
                        <div class="well well-sm">
                            <div class="row">
                                <div class="col-md-6">
                                <dl class="dl-horizontal">
                                    <dt><small>Тип расширения</small><br></dt>
                                    <dd>
                                        <a href="#" class="xedit"
                                            data-pk="'.$res->$index->id.'"
                                            data-type="select"
                                            data-value="'.$res->$index->extension_id.'"
                                            data-source="/sadmin/get/group/extension/title/type/component/"
                                            data-params=\'{"name":"extension_id","table":"menu"}\'
                                            data-title="Тип расширения">'.$res->$index->extension_title.'</a>
                                    </dd>

                                    <dt><small>Путь</small><br></dt>
                                    <dd>
                                        <a href="#" class="xedit"
                                            data-pk="'.$res->$index->id.'"
                                            data-value="'.$res->$index->path.'"
                                            data-params=\'{"name":"path","table":"menu"}\'
                                            data-title="Путь">'.$res->$index->path.'</a>
                                    </dd>

                                    <dt><small>Метод вызова</small><br></dt>
                                    <dd>
                                        <a href="#" class="xedit"
                                            data-pk="'.$res->$index->id.'"
                                            data-type="select"
                                            data-source="/sadmin/get/group/static/menu-method/"
                                            data-value="'.$res->$index->method.'"
                                            data-params=\'{"name":"method","table":"menu"}\'
                                            data-title="Метод вызова">'.$res->$index->method.'</a>
                                    </dd>

                                    <dt><small>Ссылка на материал</small><br></dt>
                                    <dd>
                                        <a href="#" class="xedit"
                                            data-pk="'.$res->$index->id.'"
                                            data-value="'.$res->$index->link_id.'"
                                            data-params=\'{"name":"link_id","table":"menu"}\'
                                            data-title="Ссылка на материал">'.$res->$index->link_id.'</a>
                                    </dd>

                                    <dt><small>Функция</small><br></dt>
                                    <dd>
                                        <a href="#" class="xedit"
                                            data-pk="'.$res->$index->id.'"
                                            data-value="'.$res->$index->function.'"
                                            data-params=\'{"name":"function","table":"menu"}\'
                                            data-title="Функция">'.$res->$index->function.'</a>
                                    </dd>
                                </dl>
                                </div>
                                <div class="col-md-6">
                                    <a class="btn btn-danger btn-xs delMenuItem" data-delMenuItem="'.$res->$index->id.'" data-toggle="modal" data-target="#modalMenuDel" role="button" href="#">Delete <i class="fa fa-trash"></i></a>
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
<div class="app-view-header">Menu: <?php echo $res->menuArray->title;?> - <span class="label label-info"><?php echo $res->menuArray->lang;?></span></div>
<div class="row">
    <!-- START dashboard content-->
    <div class="col-md-12 fw-boxed">
        <!-- START Tabbed panel-->
        <div class="panel panel-default">
            <div class="panel-body">
                <?
                    echo '<pre>';
                    $qid = 46;
                    // $q0 = '[{"id":12},{"id":13},{"id":4},{"id":10},{"id":14},{"id":15},{"id":46,"children":[{"id":47,"children":[{"id":48,"children":[{"id":49}]}]}]}]';
                    $q0 = '[{"id":11},{"id":12},{"id":13},{"id":14},{"id":15,"children":[{"id":16,"children":[{"id":17,"children":[{"id":18},{"id":25}]},{"id":19},{"id":20,"children":[{"id":21}]}]},{"id":22}]},{"id":23}]';
                    $q1 = json_decode($q0, true);
                    $q2[0]['id'] = 0;
                    $q2[0]['children'] = $q1;
                    // print_r($q2);

                    function delId($massIds, $removeId, $parent) {
                        echo '<br><b>---------Start---------</b><br>';
                        echo '<br>P1 = ';
                        echo json_encode($parent, true);
                        echo '<br>M1 = ';
                        echo json_encode($massIds, true);
                        echo '<br>---------<br>';
                        $newArr = [];
                        foreach ($massIds as $key => $item) {
                            echo '<br><b>---------Foreach---------</b><br>';
                            echo '$id === '.$item['id'].'<br>';
                            if ($item['id'] === $removeId && $item['children']) {
                                echo '<br><b>id && children</b>';
                                echo '<br>$item[children = ';
                                echo json_encode($item['children'], true);
                                echo '<br>newArr = ';
                                echo json_encode($newArr, true);
                                echo '<br>---------<br>';
                                foreach ($item['children'] as $key => $ite) {
                                    echo '<br><b>foreach children</b>';
                                    $newArr[] = $ite;
                                    echo '<br>---------<br>newArr = ';
                                    echo json_encode($newArr, true);
                                    echo '<br>---------<br>';
                                }
                            } elseif ($item['id'] === $removeId){
                                echo '<br><b>Only ID</b>';
                            } elseif ($item['children']){
                                echo '<br><b>Has children</b>';
                                $newArr[$key] = $item;
                                echo '<pre>';
                                $item = delId($item['children'], $removeId, $massIds[$key]);
                                echo '</pre>';
                                $newArr[$key]['children'] = $item;
                                echo '<br>---------<br><u>children '.count($newArr[$key]['children']).'</u> = ';
                                if (count($newArr[$key]['children']) == 0) {
                                    unset($newArr[$key]['children']);
                                    echo '<br>---------<br><u>del children</u> = ';
                                }
                                echo '<br>---------<br>newArr = ';
                                echo json_encode($newArr, true);
                                echo '<br>---------<br>';
                            } else {
                                echo '<br><b>Else</b>';
                                $newArr[] = $item;
                                echo '<br>---------<br>newArr = ';
                                echo json_encode($newArr, true);
                                echo '<br>---------<br>';
                            }
                            // return $item['children'];
                        }
                        return $newArr;
                    }

                    $q3 = delId($q2, 13, $q2);
                    // $q4 = delId($q2, 19, $q2);
                    // $q5 = delId($q2, 18, $q2);
                    echo '<br>---------';
                    echo json_encode($q3[0]['children'], true);
                    echo '<br>---------';
                    echo json_encode($q4[0]['children'], true);
                    echo '<br>---------';
                    echo json_encode($q5[0]['children'], true);
                    echo '</pre>';
                ?>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <div id="nestable-menu" class="pull-left">
                    <button type="button" data-action="expand-all" class="btn btn-default btn-xs">Expand All</button>
                    <button type="button" data-action="collapse-all" class="btn btn-default btn-xs">Collapse All</button>
                </div>
                <div class="pull-right">
                    <button type="button" data-toggle="modal" data-target="#modalMenuAdd" class="btn btn-success btn-xs"><i class="fa fa-plus"></i> Add Menu item</button>
                </div>
            </div>
            <div class="panel-body">
                <?
                echo '<div id="nestable" data-id="'.$res->menuTypeId.'" class="dd">';
                echo build_list($menuArray, $res->menuItems);
                echo '</div>';
                ?>
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
                    <h4 class="modal-title" id="contentEdit">Add menu item</h4>
                </div>
                <div class="modal-body" id="menuAdd">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                                <tbody>
                                   <tr class="hidden"><td>Заголовок</td>
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
                                        <a class="btn btn-sm btn-primary pull-right getTranslit" title="Перевести в транслит из h1"
                                            data-toggle="tooltip"
                                            data-source="menuAddTitle"
                                            data-target="menuAddAlias"
                                            data-params=""><span class="fa fa-undo"></span></a>
                                        </td></tr>
                                   <tr><td>Method</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="method"
                                            data-value="GET"
                                            data-source="/sadmin/get/group/static/menu-method/"
                                            data-original-title="menutype_id"></a></td></tr>
                                   <tr><td>Тип расширения</td>
                                        <td>
                                        <a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="extension_id"
                                            data-value="2"
                                            data-source="/sadmin/get/group/extension/title/type/component/"
                                            data-title="Тип расширения"></a>
                                        </td></tr>
                                   <tr><td>function</td>
                                        <td><a href="#" class="myeditable"
                                            data-type="select"
                                            data-name="function"
                                            data-value="commonPageCtrl"
                                            data-source="/sadmin/get/group/static/menu-function/"
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

<div class="modal fade" id="modalMenuDel" tabindex="-1" role="dialog" aria-labelledby="contentEdit" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <form>
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="contentEdit">Delete menu item</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Закрыть окно</button>
                    <button id="delMenuItem" data-delMenuItem="" type="button" class="btn btn-primary">Добавить</button>
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
                // console.log(list.nestable('serialize').length);
                $.ajax({
                        type: "POST",
                        url: "/sadmin/save/",
                        data: {
                            table: 'menutype',
                            name: 'params',
                            value: window.JSON.stringify(list.nestable('serialize')),
                            pk: list.data('id')
                        }
                    })
                    .done(function(result) {xjGrowl('Значение поля было обновлено!', result, 'success');});
            }
        };

        // activate Nestable for list 1
        $('#nestable').nestable().on('change', updateOutput);
        $('#nestable2').nestable();

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
    xEdit();
    $('#modalMenuAdd').on('hidden.bs.modal', function (e) {
        $('#menuAdd .meClear')
            .editable('setValue', null)
            .editable('option', 'pk', null)
            .removeClass('editable-unsaved');
        $('.myeditable').editable();
        $('#appReload').appGo('reload');
    })
    $('#modalMenuDel').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget),
            itemId = button.data('itemId'),
            modal = $(this);
        modal.find('#delMenuItem').data('delMenuItem', itemId).attr('data-delMenuItem', itemId);
    }).on('hidden.bs.modal', function (e) {
        $('#appReload').appGo('reload');
    })

    $('.myeditable').editable();

    //automatically show next editable
    $('.myeditable').on('save.newuser', function(){
        var that = this;
        setTimeout(function() {
            $(that).closest('tr').next().find('.myeditable').editable('show');
        }, 200);
    });

    $("body").on('click', '.getTranslitAlias', function(event) {
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
            xjGrowl('Значение поля было обновлено!', result, 'success');
        });
    });

    $('#delMenuItem').on('click', function(event) {
        event.preventDefault();
        var $this = $(this),
            id = $this.data('delMenuItem');
        $.ajax({
            type: 'POST',
            url: '/sadmin/save/menu/del/',
            data: {
                id: id
            }
        })
        .done(function(result) {
            $('#modalMenuDel').modal('hide');
            xjGrowl('Пункт меню был удален!', result, 'success');
        });
    });

    $('#save-btn').on('click', function() {
        // $('.myeditable').editable();
        $('#menuAdd a.myeditable').editable('submit', {
            url: '/sadmin/save/menu/add/',
            ajaxOptions: {
                dataType: 'json' //assuming json response
            },
            success: function(data, config) {
                $('#modalMenuAdd').modal('hide');
                xjGrowl('Добавлен новый пункт меню": ', data, 'success');
            },
            error: function(errors) {
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
    $('.aExMother').editable({
        typeahead: {remote: {url: '/sadmin/get/typeaheadmf/mother/?q=%QUERY'}},
        success: function(response, newValue) {addElemA(this)}});
});
</script>