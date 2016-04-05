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
    array('db' => 'extension_id', 'dt' => 'extension_id',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="select"
                    data-value="'.$d.'"
                    data-source="/sadmin/get/group/extension/title/type/module/"
                    data-params=\'{"name":"extension_id","table":"'.$table.'"}\'
                    data-title="Language"></a>';
        }
    ),
    array('db' => 'published', 'dt' => 'published',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xeditcheck"
                    data-pk="'.$row['id'].'"
                    data-type="checklist"
                    data-value="'.$d.'"
                    data-source=\'{"1":"true"}\'
                    data-emptytext="\'false\'"
                    data-params=\'{"name":"published","table":"'.$table.'"}\'
                    data-title="Public"></a>    ';
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
    array('db' => 'params', 'dt' => 'params',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xModalModuleParams btn btn-info btn-xs"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"params","table":"'.$table.'"}\'
                    data-title="Заголовок"><i class="fa fa-cog"></i></a>';
        }
    ),
    array('db' => 'view', 'dt' => 'view',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"view","table":"'.$table.'"}\'
                    data-title="Заголовок">'.$d.'</a>';
        }
    ),
    array('db' => 'visible', 'dt' => 'visible',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="btn btn-info btn-xs"
                    data-id="'.$row['id'].'"
                    data-toggle="modal"
                    data-target="#xModalModuleVisible"
                    ><i class="fa fa-eye"></i></a>';
        }
    ),
    array('db' => 'description', 'dt' => 'description',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"description","table":"'.$table.'"}\'
                    data-title="Заголовок">'.$d.'</a>';
        }
    ),
    array('db' => 'ordering', 'dt' => 'ordering',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"ordering","table":"'.$table.'"}\'
                    data-title="Заголовок">'.$d.'</a>';
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
);