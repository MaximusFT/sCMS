<h2>Страницы</h2>
<ul class="list-group">
    <?php
    foreach(json_decode(json_encode($res->qListContent), true) as $r) {
    ?>
    <li class="list-group-item"><a href="<?php echo $r['path'];?>" title="<?php echo $r['content_h1'];?>"><?php echo $r['content_h1'];?></a></li>
    <?php }?>
</ul>