<?
$columns = array(
    array(
        'db' => 'id',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row, $table ) {
            return 'row_'.$d;
        }
    ),
    array('db' => 'name', 'dt' => 'name',
        'formatter' => function( $d, $row, $table ) {
            $res = '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"name","table":"'.$table.'"}\'
                    data-title="Имя">'.$d.'</a>';
            return $res;
        }
    ),
    array('db' => 'type', 'dt' => 'type',
        'formatter' => function( $d, $row, $table ) {
            switch ($d) {
                case 0:
                    $dval = 'Список семей';
                break;
                
                case 1:
                    $dval = 'Список детей';
                break;
            }
            return '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="select"
                    data-value="'.$d.'"
                    data-source="'.A_URLh.'get/group/static/print-type/"
                    data-params=\'{"name":"type","table":"'.$table.'"}\'
                    data-title="Пол">'.$dval.'</a>';
        }
    ),
    array('db' => 'data', 'dt' => 'data'),
    array('db' => 'number-is', 'dt' => 'number-is',
        'formatter' => function( $d, $row, $table ) {
            $res = '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"number-is","table":"'.$table.'"}\'
                    data-title="Имя">'.$d.'</a>';
            return $res;
        }
    ),
    array('db' => 'to', 'dt' => 'to',
        'formatter' => function( $d, $row, $table ) {
            $res = '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="textarea"
                    data-placement="right"
                    data-rows="5"
                    data-params=\'{"name":"to","table":"'.$table.'"}\'
                    data-title="Имя">'.$d.'</a>';
            return $res;
        }
    ),
    array('db' => 'title', 'dt' => 'title',
        'formatter' => function( $d, $row, $table ) {
            $res = '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"title","table":"'.$table.'"}\'
                    data-title="Имя">'.$d.'</a>';
            return $res;
        }
    ),
    array('db' => 'inside', 'dt' => 'inside',
        'formatter' => function( $d, $row, $table ) {
            $res = '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="textarea"
                    data-placement="left"
                    data-rows="15"
                    data-params=\'{"name":"inside","table":"'.$table.'"}\'
                    data-title="Имя">'.$d.'</a>';
            return $res;
        }
    ),
    
    array('db' => 'id', 'dt' => 'func',
        'formatter' => function( $d, $row, $table, $tmpl ) {
            $res = '
            <div class="btn-group" role="group">
                <a class="btn btn-xs btn-success addItem" data-id="'.$row['id'].'"
                    data-toggle="modal" data-keyboard="false" data-target="#modItemAdd">Add</a>
                <a href="'.A_URLh.'print/'.$row['id'].'/" class="btn btn-xs btn-primary editItem" data-id="'.$row['id'].'">Edit</a>
            </div>
            ';
            return $res;
        }
    ),
    array('db' => 'id', 'dt' => 'addInfoRowDT',
        'formatter' => function( $d, $row, $table, $tmpl ) {
            $res = '<div></div>';
            return $res;
        }
    ),
    array('db' => 'date', 'dt' => 'date',
        'formatter' => function( $d, $row, $table ) {
            $res = '<a href="#" class="xedit"
                data-pk="'.$row['id'].'"
                data-type="date"
                data-value="'.$d.'"
                data-placement="right"
                data-format="yyyy-mm-dd"
                data-viewformat="yyyy-mm-dd"
                data-title="Выберите дату"
                data-params=\'{"name":"date","table":"'.$table.'"}\'
                data-title="Дата рождения">'.$row['date'].'</a>';
            return $res;
        }
    )
);
