    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $qRes[$key]['title'];?></h3>
        </div>
        <div class="panel-body small"><?php echo $qRes[$key]['description'];?></div>
        <ul class="list-group">
            <?php
            foreach ($qRes[$key]['params']['links'] as $qkey => $qval) {
                $qAsideUseful = $db->get('link', '*', array(
                    'id' => $qval
                ));
            ?>
            <li class="list-group-item"><a href="<?php echo $qAsideUseful['url'];?>" title="<?php echo $qAsideUseful['title'];?>" ><?php echo $qAsideUseful['title'];?></a></li>
            <?php }?>
        </ul>
    </div>
    <hr>