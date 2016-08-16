<div class="row">
    <div class="col-md-12">
        <h2>Подписчики</h2>
        <table class="table table-condensed table-hover">
            <tr class="active">
                <th></th>
                <th><span data-toggle="tooltip" title="Активировать">A</span></th>
                <th>Страница</th>
                <th>email</th>
                <th width="1%"><span class="glyphicon glyphicon-trash"></span></th>
            </tr>
    <?
    foreach(json_decode(json_encode($res->qContent), true) as $r) {
    ?>
        <tr>
            <td><?=$r['id'];?></td>
            <td><input class="jedCheck" type="checkbox" data-params="comment|active|<?=$r['id'];?>"<?=(($r['active'] == true)?' checked="checked"':'');?>></td>
            <td><?=$r['h1'];?></td>
            <td class="edit_row" data-params="comment|email|<?=$r['id'];?>"><?=$r['email'];?></td>
            <td>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">
                        <input type="checkbox" value="Del">
                    </span>
                    <span class="input-group-btn">
                        <a href="<?php echo A_URLh;?>ajax/_row-del.php" class="btn btn-danger RowDel" data-params="id=<?=$r['id'];?>"><span class="glyphicon glyphicon-trash"></span></a>
                    </span>
                </div>
            </td>
        </tr>
    <?
    }
    ?>
        </table>
    </div>
</div>