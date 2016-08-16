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

/*
echo '<pre>';
echo $modRes['params']['snipetContent'];
echo '<hr>';
echo textToDB($modRes['params']['snipetContent']);
echo '</pre>';
echo '<hr>';
*/

echo '
<dl>
    <dt><small>Содержимое снипета</small></dt>
    <dd>
        <a href="#" class="xeditParamsSnippet"
            data-pk="'.$modRes['id'].'"
            data-mode="inline"
            data-type="textarea"
            data-value="'.$modRes['params']['snipetContent'].'"
            data-params=\'{"name":"snipetContent","table":"module"}\'
            data-title="Содержимое снипета">'.$modRes['params']['snipetContent'].'</a>
    </dd>
</dl>
';
?>
<script>
    $(function() {
        $('.xeditParamsSnippet').editable({
            url: '<?php echo A_URLh;?>save/params/snippet/',
            success: function(response, newValue) { xjGrowl(response, newValue) }
        })
    });
</script>