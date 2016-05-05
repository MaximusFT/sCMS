<?php
/**
 * @package     sCMS.Extension
 * @subpackage  ext_menu
 *
 * @copyright   Copyright (C) 2005-2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * $db - global variable to use MySQL
 * $rd - global variable to use TimeFormat
 * $modRes - main variable with all fields in curr Module
 * $articleRes - main variable with all Articles
 * $categoryTypeRes - main variable with all CategoryType
 */

defined('ISsCMS') or die;

if ($modRes['view'] == 'default') {
    echo '
    <dl>
        <dt><small>Выбрать список меню</small></dt>
        <dd>
            <a href="#" class="xeditParams"
                data-pk="'.$modRes['id'].'"
                data-type="select"
                data-value="'.$modRes['params']['menutype'].'"
                data-source="/sadmin/get/group/simple/menutype/title/"
                data-params=\'{"name":"menutype","table":"module"}\'
                data-title="Список категорий">'.$modRes['params']['_menutype_title'].'</a>
        </dd>
        <dt><small>Выводить только первый уровень</small></dt>
        <dd>
            <a href="#" class="xeditParams"
                data-pk="'.$modRes['id'].'"
                data-type="checklist"
                data-value="'.$modRes['params']['oneLevel'].'"
                data-source=\'{"1":"true"}\'
                data-emptytext="\'false\'"
                data-params=\'{"name":"oneLevel","table":"module"}\'
                data-title="Первый уровень"></a>
        </dd>
    </dl>
    ';
} elseif ($modRes['view'] == 'category') {
    echo '
    <dl>
        <dt><small>Выбрать список категорий</small></dt>
        <dd>
            <a href="#" class="xeditParams"
                data-pk="'.$modRes['id'].'"
                data-type="select"
                data-value="'.$modRes['params']['categorytype'].'"
                data-source="/sadmin/get/group/simple/categorytype/title/"
                data-params=\'{"name":"categorytype","table":"module"}\'
                data-title="Список категорий">'.$modRes['params']['_categorytype_title'].'</a>
        </dd>
    </dl>
    ';
}
?>
<script>
    $(function() {
        $('.xeditParams').editable({
            url: '/sadmin/save/params/',
            success: function(response, newValue) { xjGrowl(response, newValue) }
        })
    });
</script>