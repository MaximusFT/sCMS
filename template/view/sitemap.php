<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <h2>Записи</h2>
            <ul class="list-unstyled">
                <?php
                foreach(json_decode(json_encode($res->qListContent), true) as $r) {
                ?>
                <li><a href="<?=$r['path'];?>"><?=$r['content_h1'];?></a></li>
                <?php }?>
            </ul>
        </div>
    </div>
</div>
