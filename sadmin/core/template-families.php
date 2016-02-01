<?
$columns = array(
    array(
        'db' => 'id',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row, $table ) {
            return 'row_'.$d;
        }
    ),
    array('db' => 'f-child', 'dt' => 'f-child'),
    array('db' => 'f-is-divorce', 'dt' => 'f-is-divorce'),
    array('db' => 'f-date-married', 'dt' => 'f-date-married'),
    array('db' => 'f-date-divorced', 'dt' => 'f-date-divorced'),
    array('db' => 'm-id', 'dt' => 'm-id'),
    array('db' => 'm-name-f', 'dt' => 'm-name-f'),
    array('db' => 'm-name-l', 'dt' => 'm-name-l'),
    array('db' => 'm-name-l-old', 'dt' => 'm-name-l-old'),
    array('db' => 'm-name-s', 'dt' => 'm-name-s'),
    array('db' => 'm-date-birdth', 'dt' => 'm-date-birdth'),
    array('db' => 'm-address-country', 'dt' => 'm-address-country'),
    array('db' => 'm-address-city', 'dt' => 'm-address-city'),
    array('db' => 'm-address-street', 'dt' => 'm-address-street'),
    array('db' => 'm-address-house', 'dt' => 'm-address-house'),
    array('db' => 'm-address-flat', 'dt' => 'm-address-flat'),
    array('db' => 'm-address-room', 'dt' => 'm-address-room'),
    array('db' => 'm-phone-home', 'dt' => 'm-phone-home'),
    array('db' => 'm-phone-mobile', 'dt' => 'm-phone-mobile'),
    array('db' => 'm-phone-second', 'dt' => 'm-phone-second'),
    array('db' => 'p-id', 'dt' => 'p-id'),
    array('db' => 'p-name-f', 'dt' => 'p-name-f'),
    array('db' => 'p-name-l', 'dt' => 'p-name-l'),
    array('db' => 'p-name-l-old', 'dt' => 'p-name-l-old'),
    array('db' => 'p-name-s', 'dt' => 'p-name-s'),
    array('db' => 'p-date-birdth', 'dt' => 'p-date-birdth'),
    array('db' => 'p-address-country', 'dt' => 'p-address-country'),
    array('db' => 'p-address-city', 'dt' => 'p-address-city'),
    array('db' => 'p-address-street', 'dt' => 'p-address-street'),
    array('db' => 'p-address-house', 'dt' => 'p-address-house'),
    array('db' => 'p-address-flat', 'dt' => 'p-address-flat'),
    array('db' => 'p-address-room', 'dt' => 'p-address-room'),
    array('db' => 'p-phone-home', 'dt' => 'p-phone-home'),
    array('db' => 'p-phone-mobile', 'dt' => 'p-phone-mobile'),
    array('db' => 'p-phone-second', 'dt' => 'p-phone-second'),
    
    array(
        'db' => 'id',
        'dt' => 'addInfoRowDT',
        'formatter' => function( $d, $row, $table, $tmpl ) {
            $fcs = explode("|",$row['f-child']);
            $res = '
            <div class="row">
                <div class="col-sm-6">
                    <h4>Дети</h4>
                    <table class="table table-condensed table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Фамилия</th>
                                <th>Имя</th>
                                <th>Отчество</th>
                                <th>Год рождения</th>
                            </tr>
                        </thead>
                        <tbody>
                    ';
            foreach ($fcs as $k => $v) {
                $fc = explode(";",$v);
                $res .= '
                    <tr>
                        <td><a href="#" class="xedit"
                            data-pk="'.$fc[0].'"
                            data-type="text"
                            data-params=\'{"name":"name-l","table":"people"}\'
                            data-title="Фамилия">'.$fc[1].'</a></td>
                        <td><a href="#" class="xedit"
                            data-pk="'.$fc[0].'"
                            data-type="text"
                            data-params=\'{"name":"name-f","table":"people"}\'
                            data-title="Имя">'.$fc[2].'</a></td>
                        <td><a href="#" class="xedit"
                            data-pk="'.$fc[0].'"
                            data-type="text"
                            data-params=\'{"name":"name-s","table":"people"}\'
                            data-title="Отчество">'.$fc[3].'</a></td>
                        <td><a href="#" class="xedit"
                            data-pk="'.$fc[0].'"
                            data-type="date"
                            data-value="'.$fc[4].'"
                            data-placement="right"
                            data-format="yyyy-mm-dd"
                            data-viewformat="yyyy-mm-dd"
                            data-title="Выберите дату"
                            data-params=\'{"name":"date-birdth","table":"people"}\'
                            data-title="Дата рождения">'.$fc[4].'</a></td>
                    </tr>
                ';
            }
            $res .= '
                    </tbody>
                    </table>
                </div>
                <div class="col-sm-3">
                    <h4>Мама</h4>
                </div>
                <div class="col-sm-3">
                    <h4>Папа</h4>
                </div>
            </div>';
            return $res;
        }
    ),
    array('db' => 'f-title', 'dt' => 'f-title',
        'formatter' => function( $d, $row, $table ) {
            $res = '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"title","table":"family"}\'
                    data-title="Фамилия">'.$d.'</a>';
            return $res;
        }
    ),
    array('db' => 'f-mother-id', 'dt' => 'f-mother-id',
        'formatter' => function( $d, $row, $table ) {
            $res = '
            <a href="#" class="xedit"
                    data-pk="'.$row['m-id'].'"
                    data-type="text"
                    data-params=\'{"name":"name-l","table":"people"}\'
                    data-title="Фамилия">'.$row['m-name-l'].'</a>&nbsp;';
            if (!empty($row['name-l-old'])) $res .= '(<a href="#" class="xedit"
                    data-pk="'.$row['m-id'].'"
                    data-type="text"
                    data-params=\'{"name":"name-l-old","table":"people"}\'
                    data-title="Фамилия прошлая">'.$row['m-name-l-old'].'</a>)&nbsp;';
            $res .= '<a href="#" class="xedit"
                    data-pk="'.$row['m-id'].'"
                    data-type="text"
                    data-params=\'{"name":"name-f","table":"people"}\'
                    data-title="Имя">'.$row['m-name-f'].'</a> <a href="#" class="xedit"
                    data-pk="'.$row['m-id'].'"
                    data-type="text"
                    data-params=\'{"name":"name-s","table":"people"}\'
                    data-title="Отчество">'.$row['m-name-s'].'</a>';
            return $res;
        }
    ),
    array('db' => 'f-father-id', 'dt' => 'f-father-id',
        'formatter' => function( $d, $row, $table ) {
            $res = '
            <a href="#" class="xedit"
                    data-pk="'.$row['p-id'].'"
                    data-type="text"
                    data-params=\'{"name":"name-l","table":"people"}\'
                    data-title="Фамилия">'.$row['p-name-l'].'</a> <a href="#" class="xedit"
                    data-pk="'.$row['p-id'].'"
                    data-type="text"
                    data-params=\'{"name":"name-f","table":"people"}\'
                    data-title="Имя">'.$row['p-name-f'].'</a> <a href="#" class="xedit"
                    data-pk="'.$row['p-id'].'"
                    data-type="text"
                    data-params=\'{"name":"name-s","table":"people"}\'
                    data-title="Отчество">'.$row['p-name-s'].'</a>';
            return $res;
        }
    ),
    array('db' => 'f-child', 'dt' => 'f-child',
        'formatter' => function( $d, $row, $table ) {
            $res = '';
            return $res;
        }
    ),
    array('db' => 'id', 'dt' => 'f-full-address',
        'formatter' => function( $d, $row, $table ) {
            $res = $row['m-address-street'].
                ', '.$row['m-address-house'].
                ((!empty($row['m-address-flat']))?', кв.'.$row['m-address-flat']:'').
                ((!empty($row['m-address-room']))?', комн.'.$row['m-address-room']:'');
            return $res;
        }
    ),
    array('db' => 'id', 'dt' => 'f-full-phone',
        'formatter' => function( $d, $row, $table ) {
            $res = $row['m-phone-home'].', '.$row['m-phone-mobile'].', '.$row['m-phone-second'];
            return $res;
        }
    ),
    array('db' => 'f-date-married', 'dt' => 'f-date-married',
        'formatter' => function( $d, $row, $table ) {
            $res = '<a href="#" class="xedit"
                data-pk="'.$row['id'].'"
                data-type="date"
                data-value="'.$d.'"
                data-placement="right"
                data-format="yyyy-mm-dd"
                data-viewformat="yyyy-mm-dd"
                data-title="Выберите дату"
                data-params=\'{"name":"date-married","table":"family"}\'
                data-title="Дата рождения">'.$row['f-date-married'].'</a>';
            return $res;
        }
    ),
    array('db' => 'f-date-divorced', 'dt' => 'f-date-divorced',
        'formatter' => function( $d, $row, $table ) {
            $res = '<a href="#" class="xedit"
                data-pk="'.$row['id'].'"
                data-type="date"
                data-value="'.$d.'"
                data-placement="right"
                data-format="yyyy-mm-dd"
                data-viewformat="yyyy-mm-dd"
                data-title="Выберите дату"
                data-params=\'{"name":"date-divorced","table":"family"}\'
                data-title="Дата рождения">'.$row['f-date-divorced'].'</a>';
            return $res;
        }
    )
);

