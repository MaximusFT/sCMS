    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $qRes[$key]['title'];?> <span class="badge pull-right" data-toggle="tooltip" data-placement="left" title="Самые просматриваемые статьи за 90 дней">i</span></h3>
        </div>
        <div class="panel-body small"><?php echo $qRes[$key]['description'];?></div>
        <ul class="list-group">
            <?php
                $qAsidePopular = $db->select("content", array(
                    "alias",
                    "h1",
                    "favorite",
                    "hits"
                ), array(
                    "favorite" => 1,
                    "ORDER" => array('hits DESC'),
                    "LIMIT" => 10
                ));
            foreach ($qAsidePopular as $qkey => $qval) {
            ?>
            <li class="list-group-item">
                <span class="badge"><?php echo $qval['hits'];?></span>
                <a href="/<?php echo $qval['alias'];?>/" title="<?php echo $qval['h1'];?>"><?php echo $qval['h1'];?></a>
            </li>
            <?php }?>
        </ul>
    </div>
    <hr>