<?php
/**
 * @package     sCMS.Extension
 * @subpackage  ext_link-useful
 *
 * @copyright   Copyright (C) 2005-2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * $db - global variable to use MySQL
 * $rd - global variable to use TimeFormat
 * $modRes - main variable with all params by Module
 * $articleRes - main variable with all Articles
 */

defined('ISsCMS') or die;
?>
<ul class="list-group">
    <?php
    foreach ($articleRes as $articleVal) {
        $retVal = (array_search($articleVal['id'], $modRes['params']['links']) === false || $modRes['params']['links'] === null)?'':' checked="checked"';
        echo '<li class="list-group-item"><label><input class="selectTypeVis" type="checkbox" data-name="links" data-id="'.$modRes['id'].'" name="article'.$articleVal['id'].'" value="'.$articleVal['id'].'" '.$retVal.'> '.$articleVal['h1'].' - '.$articleVal['id'].'</label></li>';
    }
    ?>
</ul>
<script>
    $(function() {
        $('.selectTypeVis').on('click', function () {
            var sfind = $(this),
                iID = parseInt(sfind.data('id')),
                iVal = parseInt(sfind.attr('value')),
                iName = sfind.data('name');
            $.ajax({
                type: 'POST',
                url: '<?php echo A_URLh;?>save/module/params/',
                data: {id: iID, value: iVal, name: iName}
            })
            .done(function(result) {
                sCMSAletr(result, 'success');
            });
        })
        $('#visibleByLang a:first').tab('show');
    });
</script>