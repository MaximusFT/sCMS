    <div class="container">
        <div class="page-header">
            <h1>Все ваши Из категории - Надо постаивть языковую переменную</h1>

            <?php echo funPos('module', 'page-header-bottom');?>

        <?php echo funPos('module', 'breadcrumb');?>
        </div>
    </div>

    <div class="container">

        <?php echo funPos('module', 'container-top');?>

        <div class="row">
            <?php if ($res->extensionCurrent->params->aside == 'left') include P_TEMP.'aside.php';?>
            <div class="col-sm-8 col-md-9">

                <?php echo funPos('module', 'before-content-1');?>
                <?php echo funPos('module', 'before-content-2');?>

                <article>
                    <?php
                    foreach(json_decode(json_encode($res->articleList), true) as $r) {
                        $countArticles++;

                        $cBackground = randStr(3, '0123456789ABCDEF');
                        $cText = inverseHex($cBackground);
                    ?>
                    <div class="media">
                        <a class="media-left" href="<?php echo linkBuilder($r['alias']);?>" title="<?=$r['h1'];?>">
                        <?/*
                        <img class="media-object" src="/images/<?=$r['alias'];?>-1-small.jpg" alt="<?=$r['h1'];?>">
                        */?>
                        <img class="media-object" src="http://imgholder.ru/180x160/<?php echo $cBackground;?>/<?php echo $cText;?>" alt="<?php echo $r['content_h1'];?>">
                        </a>
                        <div class="media-body">
                            <h2 class="media-heading"><a href="<?php echo linkBuilder($r['alias']);?>" title="<?=$r['h1'];?>"><?=$r['h1'];?></a></h2>
                            <p><?=$r['h1Description'];?></p>
                        </div>
                    </div>
                    <?php
                    }
                    ?>

                    <div id="articleMore" class="row">
                        <div class="col-md-6 col-md-offset-3">
                            <a href="#" class="btn btn-block btn-success">Показать все записи о мозолях</a>
                        </div>
                    </div>
                </article>

                <?php echo funPos('module', 'after-content-1');?>
                <?php echo funPos('module', 'after-content-2');?>
            </div>
            <?php if ($res->extensionCurrent->params->aside == 'right') include P_TEMP.'aside.php';?>
        </div>

        <?php echo funPos('module', 'container-bottom');?>

    </div>