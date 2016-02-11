<?php
$columns = array(
    array(
        'db' => 'id',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row, $table ) {
            return 'row_'.$d;
        }
    ),
    array('db' => 'menutype_id', 'dt' => 'menutype_id',
        'formatter' => function( $d, $row, $table ) {
            return '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="select"
                    data-value="'.$d.'"
                    data-source="/sadmin/get/group/menutype/name/"
                    data-params=\'{"name":"menutype_id","table":"'.$table.'"}\'
                    data-title="Menu Type">'.$d.'</a>';
        }
    ),
    array('db' => 'extension_id', 'dt' => 'extension_id',
        'formatter' => function( $d, $row, $table ) {
            return '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="select"
                    data-value="'.$d.'"
                    data-source="/sadmin/get/group/extension/title/"
                    data-params=\'{"name":"extension_id","table":"'.$table.'"}\'
                    data-title="Menu Extension">'.$d.'</a>';
        }
    ),
    array('db' => 'title', 'dt' => 'title',
        'formatter' => function( $d, $row, $table ) {
            return '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"title","table":"'.$table.'"}\'
                    data-title="Заголовок">'.$d.'</a>';
        }
    ),
    array('db' => 'alias', 'dt' => 'alias'),
    array('db' => 'path', 'dt' => 'path'),
    array('db' => 'method', 'dt' => 'method',
        'formatter' => function( $d, $row, $table ) {
            return '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="select"
                    data-value="'.$d.'"
                    data-source="/sadmin/get/group/static/menu-method/"
                    data-params=\'{"name":"method","table":"'.$table.'"}\'
                    data-title="Menu Method">'.$d.'</a>';
        }
    ),
    array('db' => 'function', 'dt' => 'function',
        'formatter' => function( $d, $row, $table ) {
            return '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="select"
                    data-value="'.$d.'"
                    data-source="/sadmin/get/group/static/menu-function/"
                    data-params=\'{"name":"function","table":"'.$table.'"}\'
                    data-title="Menu Function">'.$d.'</a>';
        }
    ),
    array('db' => 'published', 'dt' => 'published',
        'formatter' => function( $d, $row, $table ) {
            return '<input class="jedCheck" type="checkbox"
                data-params="people|is-working|'.$row['id'].'"'.
                (($row['is-working'] == true)?' checked="checked"':'').'> Опубликовать';
        }
    ),
    array('db' => 'home', 'dt' => 'home'),
    array('db' => 'lang', 'dt' => 'lang',
        'formatter' => function( $d, $row, $table ) {
            return '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="select"
                    data-value="'.$d.'"
                    data-source="/sadmin/get/group/static/lang/"
                    data-params=\'{"name":"lang","table":"'.$table.'"}\'
                    data-title="Language">'.$d.'</a>';
        }
    ),
    array('db' => 'pos', 'dt' => 'pos'),
    array(
        'db' => 'id',
        'dt' => 'addInfoRowDT',
        'formatter' => function( $d, $row, $table, $tmpl ) {
            $res = '
<div class="row">
    <div class="col-sm-8">
            <h4>Контактная информация</h4>
            <dl>
                <dt for="link_id">Link to article</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="select"
                    data-value="'.$row['link_id'].'"
                    data-source="/sadmin/get/group/content/h1/"
                    data-params=\'{"name":"link_id","table":"'.$table.'"}\'
                    data-title="Menu Type">'.$row['link_id'].'</a></dd>

                <dt for="params">params</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"params","table":"'.$table.'"}\'
                    data-title="Телефон Домашний">'.$row['params'].'</a></dd>

                <dt for="parent_id">parent_id</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"parent_id","table":"'.$table.'"}\'
                    data-title="Телефон Основной">'.$row['parent_id'].'</a></dd>

                <dt for="level">level</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"level","table":"'.$table.'"}\'
                    data-title="Телефон Домашний">'.$row['level'].'</a></dd>
            </dl>
    </div>
    <div class="col-sm-4">
    </div>
</div>';
            return $res;
        }
    ),
    array('db' => 'link_id', 'dt' => 'link_id'),
    array('db' => 'params', 'dt' => 'params'),
    array('db' => 'parent_id', 'dt' => 'parent_id'),
    array('db' => 'level', 'dt' => 'level')
);
