<?
$columns = array(
    array(
        'db' => 'id',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row, $table ) {
            return 'row_'.$d;
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
    array('db' => 'type', 'dt' => 'type',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="select"
                    data-value="'.$d.'"
                    data-source="/sadmin/get/group/static/extension-type/"
                    data-params=\'{"name":"type","table":"'.$table.'"}\'
                    data-title="Language"></a>';
        }
    ),
    array('db' => 'fileName', 'dt' => 'fileName',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"fileName","table":"'.$table.'"}\'
                    data-title="Заголовок">'.$d.'</a>';
        }
    ),
    array('db' => 'function', 'dt' => 'function',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"function","table":"'.$table.'"}\'
                    data-title="Заголовок">'.$d.'</a>';
        }
    ),
    array('db' => 'enabled', 'dt' => 'enabled',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xeditcheck"
                    data-pk="'.$row['id'].'"
                    data-type="checklist"
                    data-value="'.$d.'"
                    data-source=\'{"1":"true"}\'
                    data-emptytext="\'false\'"
                    data-params=\'{"name":"enabled","table":"'.$table.'"}\'
                    data-title="Public"></a>    ';
        }
    ),
    array('db' => 'params', 'dt' => 'params',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"params","table":"'.$table.'"}\'
                    data-title="Заголовок">'.$d.'</a>';
        }
    ),
);