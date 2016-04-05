<div class="panel panel-primary">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo $modRes['title'];?> <span class="badge pull-right" data-toggle="tooltip" data-placement="left" title="Самые просматриваемые статьи за 90 дней">i</span></h3>
    </div>
    <div class="panel-body small"><?php echo $modRes['description'];?></div>
    <ul class="list-group">
        <?php
        foreach ($modPopularArticle as $modVal) {
        ?>
        <li class="list-group-item">
            <span class="badge"><?php echo $modVal['hits'];?></span>
            <a href="<?php echo menuLinkBuilder('article', $modVal['id']);?>" title="<?php echo $modVal['h1'];?>"><?php echo $modVal['h1'];?></a>
        </li>
        <?php }?>
    </ul>
</div>
<hr>