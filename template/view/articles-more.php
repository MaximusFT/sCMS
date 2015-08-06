<?php
foreach(json_decode(json_encode($res->qListContent), true) as $r) {
?>
<div class="thumbnail item">
    <a href="<?php echo $r['path'];?>" title="<?php echo $r['title'];?>"><img class="img-rounded" src="/images/<?php echo $r['alias'];?>-1-small.jpg" alt="<?php echo $r['title'];?>"></a>
    <div class="caption">
        <h2><a href="<?php echo $r['path'];?>" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></a></h2>
        <p><?php echo $r['content_h1Description'];?></p>
    </div>
</div>
<?php }?>