<?
$columns = array(
    array(
        'db' => 'id',
        'dt' => 'DT_RowId',
        'formatter' => function( $d, $row, $table ) {
            return 'row_'.$d;
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
    array('db' => 'h1', 'dt' => 'h1',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"h1","table":"'.$table.'"}\'
                    data-title="Заголовок">'.$d.'</a>';
        }
    ),
    array('db' => 'h1Small', 'dt' => 'h1Small',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"h1Small","table":"'.$table.'"}\'
                    data-title="Заголовок">'.$d.'</a>';
        }
    ),
    array('db' => 'alias', 'dt' => 'alias',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"alias","table":"'.$table.'"}\'
                    data-title="Заголовок">'.$d.'</a>';
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
    array('db' => 'hits', 'dt' => 'hits',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"hits","table":"'.$table.'"}\'
                    data-title="Заголовок">'.$d.'</a>';
        }
    ),
    array('db' => 'image', 'dt' => 'image',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"image","table":"'.$table.'"}\'
                    data-title="Заголовок">'.$d.'</a>';
        }
    ),
    array('db' => 'urls', 'dt' => 'urls',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-value="'.$d.'"
                    data-params=\'{"name":"urls","table":"'.$table.'"}\'
                    data-title="Заголовок">'.$d.'</a>';
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
    array('db' => 'category_id', 'dt' => 'category_id',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="select"
                    data-value="'.$d.'"
                    data-source="/sadmin/get/group/simple/category/title/"
                    data-params=\'{"name":"category_id","table":"'.$table.'"}\'
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
    array('db' => 'favorite', 'dt' => 'favorite',
        'formatter' => function( $d, $row, $table ) {
            return '
                <a href="#" class="xeditcheck"
                    data-pk="'.$row['id'].'"
                    data-type="checklist"
                    data-value="'.$d.'"
                    data-source=\'{"1":"true"}\'
                    data-emptytext="\'false\'"
                    data-params=\'{"name":"favorite","table":"'.$table.'"}\'
                    data-title="Public"></a>    ';
        }
    ),

    array('db' => 'h1Description', 'dt' => 'h1Description'),
    array('db' => 'introText', 'dt' => 'introText'),
    array('db' => 'metaTitle', 'dt' => 'metaTitle'),
    array('db' => 'metaKeywords', 'dt' => 'metaKeywords'),
    array('db' => 'metaDescription', 'dt' => 'metaDescription'),
    array('db' => 'metaOgTitle', 'dt' => 'metaOgTitle'),
    array('db' => 'metaOgType', 'dt' => 'metaOgType'),
    array('db' => 'metaOgSiteName', 'dt' => 'metaOgSiteName'),
    array('db' => 'metaOgDescription', 'dt' => 'metaOgDescription'),
    array('db' => 'metaOgSection', 'dt' => 'metaOgSection'),
    array('db' => 'metaOgTag', 'dt' => 'metaOgTag'),
    array('db' => 'metaData', 'dt' => 'metaData'),
    array('db' => 'created', 'dt' => 'created'),
    array('db' => 'publish_down', 'dt' => 'publish_down'),
    array('db' => 'publish_up', 'dt' => 'publish_up'),

    array(
        'db' => 'id',
        'dt' => 'addInfoRowDT',
        'formatter' => function( $d, $row, $table, $tmpl ) {
            $res = '
    <div class="row">
        <div class="col-sm-7">
            <h4>Additional information</h4>
            <dl>
                <dt for="h1Description">h1Description</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="textarea"
                    data-mode="inline"
                    data-params=\'{"name":"h1Description","table":"'.$table.'"}\'
                    data-title="Телефон Основной">'.$row['h1Description'].'</a></dd>

                <dt for="introText">introText</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="textarea"
                    data-mode="inline"
                    data-params=\'{"name":"introText","table":"'.$table.'"}\'
                    data-title="Телефон Основной">'.$row['introText'].'</a></dd>
            </dl>
        </div>
        <div class="col-sm-2">
            <h4>Date</h4>
            <dl>
                <dt for="created">Date of create</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="date"
                    data-value="'.$row['created'].'"
                    data-placement="left"
                    data-format="yyyy-mm-dd"
                    data-viewformat="yyyy-mm-dd"
                    data-title="Выберите дату"
                    data-params=\'{"name":"created","table":"'.$table.'"}\'
                    data-title="Дата рождения">'.$row['created'].'</a></dd>

                <dt for="publish_up">Date of publish up</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="date"
                    data-value="'.$row['publish_up'].'"
                    data-placement="left"
                    data-format="yyyy-mm-dd"
                    data-viewformat="yyyy-mm-dd"
                    data-title="Выберите дату"
                    data-params=\'{"name":"publish_up","table":"'.$table.'"}\'
                    data-title="Дата рождения">'.$row['publish_up'].'</a></dd>

                <dt for="publish_down">Date of publish down</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="date"
                    data-value="'.$row['publish_down'].'"
                    data-placement="left"
                    data-format="yyyy-mm-dd"
                    data-viewformat="yyyy-mm-dd"
                    data-title="Выберите дату"
                    data-params=\'{"name":"publish_down","table":"'.$table.'"}\'
                    data-title="Дата рождения">'.$row['publish_down'].'</a></dd>
            </dl>
            <h4>Meta tags</h4>
            <dl>
                <dt for="metaTitle">metaTitle</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-placement="right"
                    data-params=\'{"name":"metaTitle","table":"'.$table.'"}\'
                    data-title="Телефон Основной">'.$row['metaTitle'].'</a></dd>

                <dt for="metaKeywords">metaKeywords</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-placement="right"
                    data-params=\'{"name":"metaKeywords","table":"'.$table.'"}\'
                    data-title="Телефон Основной">'.$row['metaKeywords'].'</a></dd>

                <dt for="metaDescription">metaDescription</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-placement="right"
                    data-params=\'{"name":"metaDescription","table":"'.$table.'"}\'
                    data-title="Телефон Основной">'.$row['metaDescription'].'</a></dd>
            </dl>
        </div>
        <div class="col-sm-3">
            <h4>MetaOg tags</h4>
            <dl>
                <dt for="metaOgTitle">metaOgTitle</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-placement="left"
                    data-params=\'{"name":"metaOgTitle","table":"'.$table.'"}\'
                    data-title="Телефон Основной">'.$row['metaOgTitle'].'</a></dd>

                <dt for="metaOgType">metaOgType</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-placement="left"
                    data-params=\'{"name":"metaOgType","table":"'.$table.'"}\'
                    data-title="Телефон Основной">'.$row['metaOgType'].'</a></dd>

                <dt for="metaOgSiteName">metaOgSiteName</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-placement="left"
                    data-params=\'{"name":"metaOgSiteName","table":"'.$table.'"}\'
                    data-title="Телефон Основной">'.$row['metaOgSiteName'].'</a></dd>

                <dt for="metaOgDescription">metaOgDescription</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-placement="left"
                    data-params=\'{"name":"metaOgDescription","table":"'.$table.'"}\'
                    data-title="Телефон Основной">'.$row['metaOgDescription'].'</a></dd>

                <dt for="metaOgSection">metaOgSection</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-placement="left"
                    data-params=\'{"name":"metaOgSection","table":"'.$table.'"}\'
                    data-title="Телефон Основной">'.$row['metaOgSection'].'</a></dd>

                <dt for="metaOgTag">metaOgTag</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-placement="left"
                    data-params=\'{"name":"metaOgTag","table":"'.$table.'"}\'
                    data-title="Телефон Основной">'.$row['metaOgTag'].'</a></dd>

                <dt for="metaData">metaData</dt>
                <dd><a href="#" class="xedit"
                    data-pk="'.$row['id'].'"
                    data-type="text"
                    data-placement="left"
                    data-params=\'{"name":"metaData","table":"'.$table.'"}\'
                    data-title="Телефон Основной">'.$row['metaData'].'</a></dd>
            </dl>
        </div>
    </div>';
            return $res;
        }
    ),
    array(
        'db' => 'id',
        'dt' => 'editFull',
        'formatter' => function( $d, $row, $table, $tmpl ) {
            $res = '
                <a class="btn btn-xs btn-primary articleEdit" href="/sadmin/content/'.$d.'/">
                    <span class="fa fa-edit"></span>
                </a>
                <a href="#" class="btn btn-info btn-xs"
                    data-id="'.$row['id'].'"
                    data-toggle="modal"
                    data-target="#xModalContentParams"
                    data-title="Параметры"><i class="fa fa-list-ul"></i></a>
            ';
            return $res;
        }
    )
);

/*
                <dt for="address-country">Страна</dt>
                <dd><a href="#" class="aCountry"
                    data-pk="'.$row['id'].'"
                    data-type="typeaheadjs"
                    data-params=\'{"name":"address-country","table":"'.$table.'"}\'
                    data-title="Страна">'.$row['address-country'].'</a></dd>
                <dd><a href="#" class="aPlace"
                    data-pk="'.$row['id'].'"
                    data-type="typeaheadjs"
                    data-params=\'{"name":"address-city","table":"'.$table.'"}\'
                    data-title="Город">'.$row['address-city'].'</a></dd>
*/