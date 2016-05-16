    <div class="container">
        <div class="page-header">
            <div id="addInfo" class="pull-right">
                <span class="label"><i class="glyphicon glyphicon-eye-open"></i> <a><?php echo $res->contentCurrent->hits;?></a></span>
                <span class="label"><i class="glyphicon glyphicon-comment"></i> <a href="#Comments"><?php echo $res->qCommCount;?></a></span>
            </div>
            <h1><?php echo $res->contentCurrent->h1;?><?php echo ((!empty($res->contentCurrent->h1Small))?' <small>'.$res->contentCurrent->h1Small.'</small>':'');?></h1>
            <?php echo ((!empty($res->contentCurrent->introText))?'<p class="well well-sm text-primary">'.$res->contentCurrent->introText.'</p>':'');?>

            <?php echo funPos('module', 'page-header-bottom');?>

        <?php echo funPos('module', 'breadcrumb');?>
        </div>
    </div>

    <div class="container">

        <?php echo funPos('module', 'container-top');?>

        <div class="row">
            <?php if ($res->categoryCurrent->params->aside == 'left') include P_TEMP.'aside.php';?>
            <div class="col-sm-8 col-md-9">

                <?php echo funPos('module', 'before-content-1');?>
                <?php echo funPos('module', 'before-content-2');?>

                <article>
                    <?php echo $res->contentCurrent->full_text;?>
                </article>

                <?php echo funPos('module', 'after-content-1');?>
                <?php echo funPos('module', 'after-content-2');?>
            </div>
            <?php if ($res->categoryCurrent->params->aside == 'right') include P_TEMP.'aside.php';?>
        </div>

        <?php echo funPos('module', 'container-bottom');?>

    </div>

<section>
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
</section>