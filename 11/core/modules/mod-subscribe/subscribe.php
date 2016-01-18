    <div class="panel panel-primary">
        <div class="panel-heading">
            <h3 class="panel-title"><?php echo $qRes[$key]['title'];?></h3>
        </div>
        <div class="panel-body">
            <form id="subscribeForm" action="<?php echo S_URLs;?>/subscribe/" method="post" role="form" >
                <div class="input-group">
                    <input type="email" class="form-control" name="sEmail" placeholder="example@email.com" requared>
                    <input name="sParams" type="hidden" value="<?php echo S_URLs.$_SERVER['REQUEST_URI'];?>|<?php echo $res->qCont->id;?>">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Go!</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

