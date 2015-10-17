<article>
    <?php
    $countArticles = 0;
    foreach(json_decode(json_encode($res->qListContent), true) as $r) {
        $countArticles++;

        $cBackground = randStr(3, '0123456789ABCDEF');
        $cText = inverseHex($cBackground);
    ?>
    <div class="media">
        <a class="media-left" href="<?php echo $r['path'];?>" title="<?php echo $r['content_h1'];?>"><img class="media-object" src="http://imgholder.ru/180x160/<?php echo $cBackground;?>/<?php echo $cText;?>" alt="<?php echo $r['content_h1'];?>"></a>
        <div class="media-body">
            <h2 class="media-heading"><a href="<?php echo $r['path'];?>" title="<?php echo $r['content_h1'];?>"><?php echo $r['content_h1'];?></a></h2>
            <p><?php echo $r['content_h1Description'];?></p>
        </div>
    </div>
    <?php
    }
    if ($countArticles > 2) {
    ?>
    <div id="articleMore" class="row">
        <div class="col-md-6 col-md-offset-3">
            <a href="#" class="btn btn-block btn-success">Показать все записи на сайте</a>
        </div>
    </div>
    <?php }?>
</article>