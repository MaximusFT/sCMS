<div id="readmore" class="well well-sm">
    <h5><?php echo $modRes['title'];?></h5>
    <div class="row">
        <?php
        foreach ($modReadMore as $modVal) {
        ?>
        <div class="col-md-6">
            <div class="media">
                <a class="pull-left" href="<?php echo menuLinkBuilder('article', $modVal['id']);?>" title="<?php echo $modVal['h1'];?>"><img class="media-object img-thumbnail" src="<?php echo $modVal['image'];?>" alt="<?php echo $modVal['h1'];?>"></a>
                <div class="media-body">
                    <a href="<?php echo menuLinkBuilder('article', $modVal['id']);?>" title="<?php echo $modVal['h1'];?>"><?php echo $modVal['h1'];?></a>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>