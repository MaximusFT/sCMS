<form class="form-horizontal" id="questionForm" action="<?php echo S_URLs;?>/asking/do/" method="post" role="form" >
    <input name="aParams" type="hidden" value="<?php echo S_URLs.$_SERVER['REQUEST_URI'];?>|<?php echo $res->contentCurrent->->id;?>">
    <div class="form-group">
        <label for="qName" class="col-sm-3 control-label">Имя</label>
        <div class="col-sm-9">
            <input type="text" class="form-control" name="aName" placeholder="Имя" requared>
        </div>
    </div>
    <div class="form-group">
        <label for="qEmail" class="col-sm-3 control-label">Email</label>
        <div class="col-sm-9">
            <input type="email" class="form-control" name="aEmail" placeholder="Email" requared>
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword3" class="col-sm-3 control-label">Ваш вопрос</label>
        <div class="col-sm-9">
            <textarea class="form-control" rows="3" name="aQuestion" placeholder="Ваш вопрос" requared></textarea>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <div class="checkbox">
                <label>
                    <input name="aPrint" type="checkbox"> Разместить мой вопрос и ответ в разделе "Ваши вопросы"
                </label>
            </div>
            <span class="help-block">Вопрос и ответ будут размещены без указания ваших контактных данных.</span>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-success">Задать вопрос</button>
        </div>
    </div>
</form>                
