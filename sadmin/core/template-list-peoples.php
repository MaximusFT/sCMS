<?
$columns = array(
    array(
        'db' => 'id',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row, $table ) {
            return 'row_'.$d;
        }
    ),
    array(
        'db' => 'id',
        'dt' => 'check',
        'formatter' => function( $d, $row, $table, $tmpl ) {
            $res = '<label><input class="jedCheckListAdd" type="checkbox"
                data-params="print_item|'.$row['id'].'"></label>';
            return $res;
        }
    ),
    array('db' => 'address-country', 'dt' => 'address-country'),
    array('db' => 'address-city', 'dt' => 'address-city'),
    array('db' => 'address-street', 'dt' => 'address-street'),
    array('db' => 'address-house', 'dt' => 'address-house'),
    array('db' => 'address-flat', 'dt' => 'address-flat'),
    array('db' => 'address-room', 'dt' => 'address-room'),
    array('db' => 'phone-home', 'dt' => 'phone-home'),
    array('db' => 'phone-mobile', 'dt' => 'phone-mobile'),
    array('db' => 'phone-second', 'dt' => 'phone-second'),
    
    array('db' => 'name-l', 'dt' => 'name-l',
        'formatter' => function( $d, $row, $table ) {
            $res = ''.$d.'';
            if (!empty($row['name-l-old'])) $res .= ' - '.$row['name-l-old'].'';
            return $res;
        }
    ),
    array('db' => 'name-l-old', 'dt' => 'name-l-old'),
    array('db' => 'name-f', 'dt' => 'name-f'),
    array('db' => 'name-s', 'dt' => 'name-s'),
    array('db' => 'name-f', 'dt' => 'full-name',
        'formatter' => function( $d, $row, $table ) {
            $res = $row['name-l'].' '.$row['name-f'].' '.$row['name-s'];
            return $res;
        }
    ),
    array('db' => 'name-f', 'dt' => 'full-address',
        'formatter' => function( $d, $row, $table ) {
            $res = $row['address-street'].
                ', '.$row['address-house'].
                ((!empty($row['address-flat']))?', кв.'.$row['address-flat']:'').
                ((!empty($row['address-room']))?', комн.'.$row['address-room']:'');
            return $res;
        }
    ),
    array('db' => 'name-f', 'dt' => 'full-phone',
        'formatter' => function( $d, $row, $table ) {
            $array = array($row['phone-home'], $row['phone-mobile'], $row['phone-second']);
            $array = array_diff($array, array(''));
            $res = implode(", ", $array);
            return $res;
        }
    ),
    array('db' => 'date-birdth', 'dt' => 'date-birdth',
        'formatter' => function( $d, $row, $table ) {
            return strstr($d, '-', true);
        }
    )
);
