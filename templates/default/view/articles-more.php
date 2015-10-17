<?php
foreach(json_decode(json_encode($res->qListContent), true) as $r) {
    $cBackground = randStr(3, '0123456789ABCDEF');
    $cText = inverseHex($cBackground);
?>
<div class="media">
    <a class="media-left" href="<?php echo $r['path'];?>" title="<?php echo $r['title'];?>"><img class="media-object" src="http://imgholder.ru/180x160/<?php echo $cBackground;?>/<?php echo $cText;?>" alt="<?php echo $r['title'];?>"></a>
    <div class="media-body">
        <h2><a href="<?php echo $r['path'];?>" title="<?php echo $r['title'];?>"><?php echo $r['title'];?></a></h2>
        <p><?php echo $r['content_h1Description'];?></p>
    </div>
</div>
<?php }?>