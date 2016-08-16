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
        'dt' => 'addInfoRowDT',
        'formatter' => function( $d, $row, $table, $tmpl ) {
            $res = '<div class="row">
    <div class="col-sm-4">
            <h4>Контактная информация</h4>
            <dl>
                <dt for="phone-mobile">Телефон Основной</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"phone-home","table":"'.$table.'"}\'
                    data-title="Телефон Основной">'.$row['phone-home'].'</a></dd>
                <dt for="phone-home">Телефон Домашний</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"phone-mobile","table":"'.$table.'"}\'
                    data-title="Телефон Домашний">'.$row['phone-mobile'].'</a></dd>
                <dt for="phone-second">Телефон Дополнительный</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"phone-second","table":"'.$table.'"}\'
                    data-title="Телефон Дополнительный">'.$row['phone-second'].'</a></dd>
                <dt for="email">E-mail</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"email","table":"'.$table.'"}\'
                    data-title="E-mail">'.$row['email'].'</a></dd>
                <dt for="skype">Skype</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"skype","table":"'.$table.'"}\'
                    data-title="Skype">'.$row['skype'].'</a></dd>
            </dl>
            <hr>
            <h4>Информация о работе</h4>
            <dl>
                <dt for="is-working">
                    <label>
                        <input class="jedCheck" type="checkbox" data-params="people|is-working|'.$row['id'].'"'.(($row['is-working'] == true)?' checked="checked"':'').'> Работает?
                    </label>
                </dt>
                <dt for="work-speciality">Профессия</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"work-speciality","table":"'.$table.'"}\'
                    data-title="Профессия">'.$row['work-speciality'].'</a></dd>
            </dl>
            <hr>
            <h4>Пасспортные данные</h4>
            <dl>
                <dt for="pass-serial">Серия</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"pass-serial","table":"'.$table.'"}\'
                    data-title="Серия">'.$row['pass-serial'].'</a></dd>
                <dt for="pass-number">Номер</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"pass-number","table":"'.$table.'"}\'
                    data-title="Номер">'.$row['pass-number'].'</a></dd>
                <dt for="pass-who">Кем выдан?</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"pass-who","table":"'.$table.'"}\'
                    data-title="Кем выдан?">'.$row['pass-who'].'</a></dd>
                <dt for="pass-date">Дата выдачи</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="date"
                    data-value="'.$row['pass-date'].'"
                    data-placement="right"
                    data-format="yyyy-mm-dd"
                    data-viewformat="yyyy-mm-dd"
                    data-title="Выберите дату"
                    data-params=\'{"name":"pass-date","table":"'.$table.'"}\'
                    data-title="Дата рождения">'.$row['pass-date'].'</a></dd>
            </dl>
            <hr>
            <h4>Идентификационный номер</h4>
            <dl>
                <dt for="id-number">ИД номер</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"id-number","table":"'.$table.'"}\'
                    data-title="ИД номер">'.$row['id-number'].'</a></dd>
            </dl>
    </div>
    <div class="col-sm-4">
            <h4>Адрес проживания</h4>
            <dl id="address">
                <dt for="address-country">Страна</dt>
                <dd><a href="#" class="aCountry"
                    data-pk="'.$row['id'].'"
                    data-type="typeaheadjs"
                    data-params=\'{"name":"address-country","table":"'.$table.'"}\'
                    data-title="Страна">'.$row['address-country'].'</a></dd>
                <dt for="address-city">Город</dt>
                <dd><a href="#" class="aPlace"
                    data-pk="'.$row['id'].'"
                    data-type="typeaheadjs"
                    data-params=\'{"name":"address-city","table":"'.$table.'"}\'
                    data-title="Город">'.$row['address-city'].'</a></dd>
                <dt for="address-street">Улица</dt>
                <dd><a href="#" class="aStreet"
                    data-pk="'.$row['id'].'"
                    data-type="typeaheadjs"
                    data-params=\'{"name":"address-street","table":"'.$table.'"}\'
                    data-title="Улица">'.$row['address-street'].'</a></dd>
                <dt for="address-house">Дом</dt>
                <dd><a href="#" class="aHouse xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"address-house","table":"'.$table.'"}\'
                    data-title="Дом">'.$row['address-house'].'</a></dd>
                <dt for="address-flat">Квартира</dt>
                <dd><a href="#" class="aFlat xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"address-flat","table":"'.$table.'"}\'
                    data-title="Квартира">'.$row['address-flat'].'</a></dd>
                <dt for="address-flat">Комната</dt>
                <dd><a href="#" class="aRoom xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"address-room","table":"'.$table.'"}\'
                    data-title="Комната">'.$row['address-room'].'</a></dd>
            </dl>
            <hr>
            <h4>Адрес регистрации
                <a id="addToReg" data-params="'.$row['id'].'" class="btn btn-xs btn-success pull-right">Копировать</a>
            </h4>
            <dl id="regAddress">
                <dt for="reg-country">Страна</dt>
                <dd><a href="#" class="aCountry"
                    data-pk="'.$row['id'].'"
                    data-type="typeaheadjs"
                    data-params=\'{"name":"reg-country","table":"'.$table.'"}\'
                    data-title="Страна">'.$row['reg-country'].'</a></dd>
                <dt for="reg-city">Город</dt>
                <dd><a href="#" class="aPlace"
                    data-pk="'.$row['id'].'"
                    data-type="typeaheadjs"
                    data-params=\'{"name":"reg-city","table":"'.$table.'"}\'
                    data-title="Город">'.$row['reg-city'].'</a></dd>
                <dt for="reg-street">Улица</dt>
                <dd><a href="#" class="aStreet"
                    data-pk="'.$row['id'].'"
                    data-type="typeaheadjs"
                    data-params=\'{"name":"reg-street","table":"'.$table.'"}\'
                    data-title="Улица">'.$row['reg-street'].'</a></dd>
                <dt for="reg-house">Дом</dt>
                <dd><a href="#" class="aHouse xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"reg-house","table":"'.$table.'"}\'
                    data-title="Дом">'.$row['reg-house'].'</a></dd>
                <dt for="reg-flat">Квартира</dt>
                <dd><a href="#" class="aFlat xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"reg-flat","table":"'.$table.'"}\'
                    data-title="Квартира">'.$row['reg-flat'].'</a></dd>
                <dt for="address-flat">Комната</dt>
                <dd><a href="#" class="aRoom xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"reg-room","table":"'.$table.'"}\'
                    data-title="Комната">'.$row['reg-room'].'</a></dd>
            </dl>
    </div>
    <div class="col-sm-4">
            <h4>О родителях</h4>
            <dl>
                <dt for="mother-id">Мама</dt>
                <dd><a href="#" class="aMother"
                    data-pk="'.$row['id'].'"
                    data-type="typeaheadjs"
                    data-params=\'{"name":"mother-id","table":"'.$table.'"}\'
                    data-title="Мама">'.$row['mother-name'].'</a></dd>
                <dt for="father-id">Папа</dt>
                <dd><a href="#" class="aFather"
                    data-pk="'.$row['id'].'"
                    data-type="typeaheadjs"
                    data-params=\'{"name":"father-id","table":"'.$table.'"}\'
                    data-title="Папа">'.$row['father-name'].'</a></dd>
                <dt for="is-young">
                    <label>
                        <input class="jedCheck" type="checkbox" data-params="people|is-young|'.$row['id'].'"'.(($row['is-young'] == true)?' checked="checked"':'').'> Родитель?
                    </label>
                </dt>
                <dd></dd>
            </dl>
            <hr>
            <h4>Учреждения: Детский сад</h4>
            <dl>
                <dt for="kindergarten-id">№ Детского сада</dt>
                <dd><a href="#" class="aKinder"
                    data-pk="'.$row['id'].'"
                    data-type="typeaheadjs"
                    data-params=\'{"name":"kindergarten-id","table":"'.$table.'"}\'
                    data-title="№ Детского сада">'.$row['kindergarten-name'].'</a></dd>
            </dl>
            <hr>
            <h4>Учреждения: Школа</h4>
            <dl>
                <dt for="school-id">№ Школы</dt>
                <dd><a href="#" class="aSchool"
                    data-pk="'.$row['id'].'"
                    data-type="typeaheadjs"
                    data-params=\'{"name":"school-id","table":"'.$table.'"}\'
                    data-title="№ Школы">'.$row['school-name'].'</a></dd>
                <dt for="school-class">Класс</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"school-class","table":"'.$table.'"}\'
                    data-title="Класс">'.$row['school-class'].'</a></dd>
                <dt for="school-date-receipt">Дата поступления</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="date"
                    data-value="'.$row['school-date-receipt'].'"
                    data-placement="left"
                    data-format="yyyy-mm-dd"
                    data-viewformat="yyyy-mm-dd"
                    data-title="Выберите дату"
                    data-params=\'{"name":"school-date-receipt","table":"'.$table.'"}\'
                    data-title="Дата поступления">'.$row['school-date-receipt'].'</a></dd>
                <dt for="school-date-end">Дата окончания</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="date"
                    data-value="'.$row['school-date-end'].'"
                    data-placement="left"
                    data-format="yyyy-mm-dd"
                    data-viewformat="yyyy-mm-dd"
                    data-title="Выберите дату"
                    data-params=\'{"name":"school-date-end","table":"'.$table.'"}\'
                    data-title="Дата окончания">'.$row['school-date-end'].'</a></dd>
            </dl>
            <hr>
            <h4>Учреждения: высшее образование</h4>
            <dl>
                <dt for="academy-id">№ Учреждения</dt>
                <dd><a href="#" class="aAcademy"
                    data-pk="'.$row['id'].'"
                    data-type="typeaheadjs"
                    data-params=\'{"name":"academy-id","table":"'.$table.'"}\'
                    data-title="№ Учреждения">'.$row['academy-name'].'</a></dd>
                <dt for="academy-speciality">Специальность</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"academy-speciality","table":"'.$table.'"}\'
                    data-title="Специальность">'.$row['academy-speciality'].'</a></dd>
                <dt for="academy-course">Курс</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"academy-course","table":"'.$table.'"}\'
                    data-title="Курс">'.$row['academy-course'].'</a></dd>
                <dt for="academy-date-receipt">Дата поступления</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="date"
                    data-value="'.$row['academy-date-receipt'].'"
                    data-placement="left"
                    data-format="yyyy-mm-dd"
                    data-viewformat="yyyy-mm-dd"
                    data-title="Выберите дату"
                    data-params=\'{"name":"academy-date-receipt","table":"'.$table.'"}\'
                    data-title="Дата поступления">'.$row['academy-date-receipt'].'</a></dd>
                <dt for="academy-date-end">Дата окончания</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="date"
                    data-value="'.$row['academy-date-end'].'"
                    data-placement="left"
                    data-format="yyyy-mm-dd"
                    data-viewformat="yyyy-mm-dd"
                    data-title="Выберите дату"
                    data-params=\'{"name":"academy-date-end","table":"'.$table.'"}\'
                    data-title="Дата окончания">'.$row['academy-date-end'].'</a></dd>
            </dl>
    </div>
</div>';
            return $res;
        }
    ),
    array('db' => 'mother-id', 'dt' => 'mother-id'),
    array('db' => 'mother-name', 'dt' => 'mother-name'),
    array('db' => 'father-id', 'dt' => 'father-id'),
    array('db' => 'father-name', 'dt' => 'father-name'),
    array('db' => 'is-young', 'dt' => 'is-young'),

    array('db' => 'address-country', 'dt' => 'address-country'),
    array('db' => 'address-city', 'dt' => 'address-city'),
    array('db' => 'address-street', 'dt' => 'address-street'),
    array('db' => 'address-house', 'dt' => 'address-house'),
    array('db' => 'address-flat', 'dt' => 'address-flat'),
    array('db' => 'address-room', 'dt' => 'address-room'),

    array('db' => 'reg-country', 'dt' => 'reg-country'),
    array('db' => 'reg-city', 'dt' => 'reg-city'),
    array('db' => 'reg-street', 'dt' => 'reg-street'),
    array('db' => 'reg-house', 'dt' => 'reg-house'),
    array('db' => 'reg-flat', 'dt' => 'reg-flat'),
    array('db' => 'reg-room', 'dt' => 'reg-room'),

    array('db' => 'phone-home', 'dt' => 'phone-home'),
    array('db' => 'phone-mobile', 'dt' => 'phone-mobile'),
    array('db' => 'phone-second', 'dt' => 'phone-second'),
    array('db' => 'email', 'dt' => 'email'),
    array('db' => 'skype', 'dt' => 'skype'),

    array('db' => 'kindergarten-id', 'dt' => 'kindergarten-id'),
    array('db' => 'kindergarten-name', 'dt' => 'kindergarten-name'),

    array('db' => 'school-id', 'dt' => 'school-id'),
    array('db' => 'school-name', 'dt' => 'school-name'),
    array('db' => 'school-class', 'dt' => 'school-class'),
    array('db' => 'school-date-receipt', 'dt' => 'school-date-receipt'),
    array('db' => 'school-date-end', 'dt' => 'school-date-end'),

    array('db' => 'academy-id', 'dt' => 'academy-id'),
    array('db' => 'academy-name', 'dt' => 'academy-name'),
    array('db' => 'academy-speciality', 'dt' => 'academy-speciality'),
    array('db' => 'academy-course', 'dt' => 'academy-course'),
    array('db' => 'academy-date-receipt', 'dt' => 'academy-date-receipt'),
    array('db' => 'academy-date-end', 'dt' => 'academy-date-end'),

    array('db' => 'pass-serial', 'dt' => 'pass-serial'),
    array('db' => 'pass-number', 'dt' => 'pass-number'),
    array('db' => 'pass-who', 'dt' => 'pass-who'),
    array('db' => 'pass-date', 'dt' => 'pass-date'),
    array('db' => 'pass-scan', 'dt' => 'pass-scan'),

    array('db' => 'id-number', 'dt' => 'id-number'),
    array('db' => 'id-number-scan', 'dt' => 'id-number-scan'),

    array('db' => 'is-working', 'dt' => 'is-working'),
    array('db' => 'work-speciality', 'dt' => 'work-speciality'),
    
    array('db' => 'name-l', 'dt' => 'name-l',
        'formatter' => function( $d, $row, $table ) {
            $res = '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"name-l","table":"'.$table.'"}\'
                    data-title="Фамилия">'.$d.'</a>';
            if (!empty($row['name-l-old'])) $res .= ' -
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"name-l-old","table":"'.$table.'"}\'
                    data-title="Фамилия прошлая">'.$row['name-l-old'].'</a>';
            return $res;
        }
    ),
    array('db' => 'name-l-old', 'dt' => 'name-l-old'),
    array('db' => 'name-f', 'dt' => 'name-f',
        'formatter' => function( $d, $row, $table ) {
            $res = '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"name-f","table":"'.$table.'"}\'
                    data-title="Имя">'.$d.'</a>';
            return $res;
        }
    ),
    array('db' => 'name-s', 'dt' => 'name-s',
        'formatter' => function( $d, $row, $table ) {
            return '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-params=\'{"name":"name-s","table":"'.$table.'"}\'
                    data-title="Отчество">'.$d.'</a>';
        }
    ),
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
            $res = $row['phone-home'].', '.$row['phone-mobile'].', '.$row['phone-second'];
            return $res;
        }
    ),
    array('db' => 'sex', 'dt' => 'sex',
        'formatter' => function( $d, $row, $table ) {
            $dval = ($d == 1)?'Муж':'Жен';
            return '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="select"
                    data-value="'.$d.'"
                    data-source="'.A_URLh.'get/group/static/sex/"
                    data-params=\'{"name":"sex","table":"'.$table.'"}\'
                    data-title="Пол">'.$dval.'</a>';
        }
    ),
    array('db' => 'date-birdth', 'dt' => 'date-birdth',
        'formatter' => function( $d, $row, $table ) {
            return '
            <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="date"
                    data-value="'.$d.'"
                    data-placement="right"
                    data-format="yyyy-mm-dd"
                    data-viewformat="yyyy-mm-dd"
                    data-title="Выберите дату"
                    data-params=\'{"name":"date-birdth","table":"'.$table.'"}\'
                    data-title="Дата рождения">'.$d.'</a>';
        }
    )
);
