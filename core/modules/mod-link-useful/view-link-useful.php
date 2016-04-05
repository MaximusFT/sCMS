<div class="panel panel-info">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $modRes['title'];?></h3>
    </div>
    <div class="panel-body small"><?php echo $modRes['description'];?></div>
    <ul class="list-group">
        <?php
        foreach ($modUsefulArticle as $modVal) {
        ?>
            <li class="list-group-item"><a href="<?php echo menuLinkBuilder('article', $modVal['id']);?>" title="<?php echo $modVal['h1'];?>" ><?php echo $modVal['h1'];?></a></li>
        <?php }?>
    </ul>
</div>
<hr>