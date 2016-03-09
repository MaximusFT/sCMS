<?php
$qRMore = $db->select("content", array(
    "readmore"
), array(
    "id" => $res->contentCurrent->id
));
if ($qRMore['0']['readmore'] != '') {
?>
<div id="readmore" class="well well-sm">
    <h5><?php echo $qRes[$key]['title'];?></h5>
    <div class="row">
        <?php
        $qRMore = explode(",", $qRMore['0']['readmore']);
        foreach ($qRMore as $value) {
            $qMore = $db->select("content", array(
                "alias",
                "h1"
            ), array(
                "id" => $value
            ));
        ?>
        <div class="col-md-6">
            <div class="media">
                <a class="pull-left" href="/<?php echo $qMore['0']['alias'];?>/" title="<?php echo $qMore['0']['h1'];?>">
                    <?php /* Раскомментировать после просмотра демо данных

                    <img class="media-object img-thumbnail" src="/images/<?php echo $qMore['0']['alias'];?>-1-small-rm.jpg" alt="<?php echo $qMore['0']['h1'];?>">
                    */?>
                    <img class="media-object img-thumbnail" src="http://imgholder.ru/120x80/" alt="<?php echo $qMore['0']['h1'];?>">
                </a>
                <div class="media-body">
                    <a href="/<?php echo $qMore['0']['alias'];?>/" title="<?php echo $qMore['0']['h1'];?>"><?php echo $qMore['0']['h1'];?></a>
                </div>
            </div>
        </div>
        <?php }?>
    </div>
</div>
<?php }?>
