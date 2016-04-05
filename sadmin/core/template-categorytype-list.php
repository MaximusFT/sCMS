<?php
$columns = array(
    array(
        'db' => 'id',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row, $table ) {
            return 'row_'.$d;
        }
    ),
    array('db' => 'id', 'dt' => 'link',
        'formatter' => function( $d, $row, $table ) {
            return '<a href="'.$d.'/" data-title="К редактированию меню">Edit</a>';
        }
    ),
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
    array('db' => 'position', 'dt' => 'position',
        'formatter' => function( $d, $row, $table ) {
            return '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="select"
                    data-value="'.$d.'"
                    data-source="/sadmin/get/group/static/position/"
                    data-params=\'{"name":"position","table":"'.$table.'"}\'
                    data-title="Language">'.$d.'</a>';
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
    array('db' => 'name', 'dt' => 'name',
        'formatter' => function( $d, $row, $table ) {
            return '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"name","table":"'.$table.'"}\'
                    data-title="Заголовок">'.$d.'</a>';
        }
    )
);
