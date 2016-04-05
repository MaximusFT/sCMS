<div class="panel panel-primary" id="commColapse">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#commColapse" href="#colOne"><?php echo $qRes[$key]['title'];?></a>
        </h4>
    </div>
    <div id="colOne" class="panel-collapse collapse">
        <div class="panel-body">
            <form class="" id="commentForm" action="<?php echo S_URLs;?>/comment/" method="post" role="form" >
                <input name="qParams" type="hidden" value="<?php echo S_URLs.$_SERVER['REQUEST_URI'];?>|<?php echo $res->contentCurrent->id;?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qName" class="control-label">Имя</label>
                            <input type="text" class="form-control" name="qName" placeholder="Имя" requared>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="qEmail" class="control-label">Email</label>
                            <input type="email" class="form-control" name="qEmail" placeholder="Email" requared>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="qQuestion" class="control-label">Ваш комментарий</label>
                            <textarea class="form-control" rows="3" name="qQuestion" placeholder="Ваш комментарий" requared></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success">Отправить</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
if ($res->qCommCount > 0) {
?>
<div id="Comments" class="panel panel-info">
    <div class="panel-heading"><h4 class="panel-title"><?php echo $qRes[$key]['description'];?></h4></div>
    <div class="panel-body">
        <?php
        foreach ($res->qComm as $cVal) {
            $cAvatarBack = randStr(3, '0123456789ABCDEF');
            $cAvatar = inverseHex($cAvatarBack);
        ?>
        <div class="media">
            <a class="pull-left" href="#">
                <img class="media-object" src="http://placehold.it/64/<?php echo $cAvatarBack;?>/<?php echo $cAvatar;?>/&text=<?php echo translit(mb_substr($cVal->name,0,1,"UTF-8"));?>" style="width: 64px; height: 64px;">
            </a>
            <div class="media-body">
                <h4 class="media-heading"><?php echo $cVal->name;?> <small><time><?php echo $rd->qdate($cVal->timecreate, 4);?></time></small></h4>
                <?php echo ((isset($cVal->title) && !empty($cVal->title))?'<h5>'.$cVal->title.'</h5>':'');?>
                <p><?php echo $cVal->comment;?></p>
            </div>
        </div>
        <?php }?>
    </div>
</div>
<?php }?>
