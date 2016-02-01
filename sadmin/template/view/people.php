<div class="row">
    <div class="col-md-4">
        <h2>Все люди</h2>
    </div>
    <div class="col-md-4">
        <a href="add/" class="btn btn-success">Добавить</a>
    </div>
    <div class="col-md-4"></div>
</div>
<div class="row">
    <div class="col-md-12">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th></th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Пол</th>
                    <th>Год рождения</th>
                </tr>
            </thead>
    <?
    /*
            <tbody>
    foreach(json_decode(json_encode($res->qContent), true) as $r) {
    ?>
        <tr>
            <td><a href="#" class="xedit"
                    data-pk="<?=$r['id'];?>"
                    data-type="text"
                    data-params="{'name':'name-l','table':'people'}"
                    data-title="Фамилия"><?=$r['name-l'];?></a></td>
            <td><a href="#" class="xedit"
                    data-pk="<?=$r['id'];?>"
                    data-type="text"
                    data-params="{'name':'name-f','table':'people'}"
                    data-title="Имя"><?=$r['name-f'];?></a></td>
            <td><a href="#" class="xedit"
                    data-pk="<?=$r['id'];?>"
                    data-type="date"
                    data-params="{'name':'date-birdth','table':'people'}"
                    data-title="Дата рождения"><?=$r['date-birdth'];?></a></td>
        </tr>
    <?
    }
            </tbody>
    */
    ?>
            <tfoot>
                <tr>
                    <th></th>
                    <th>Фамилия</th>
                    <th>Имя</th>
                    <th>Пол</th>
                    <th>Год рождения</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<!-- Modal for Edit Page -->
<div class="modal fade" id="modalContentEdit" tabindex="-1" role="dialog" aria-labelledby="contentEdit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="contentEdit">Редактировать страницу</h4>
            </div>
            <div class="modal-body" id="ajaxContent" data-contentid=""></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>