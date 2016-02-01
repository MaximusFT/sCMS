<?php
require_once A_TEMP."_head.php";
?>
    <div class="container-fluid">
        <div id="pageContent" data-file="/sadmin/template/view/<?php echo $match['name'].'.php'?>">
            <?php include $res->pageContent;?>
        </div>
    </div>
<?php
require_once A_TEMP."_ender.php";
?>