<div class="row">
    <div class="col-md-6">
        <h3>Получить переменные сайта в CSV</h3>
        <a href="/sadmin/content/mysql-to-csv/" class="btn btn-success">mysql-to-csv</a>
    </div>
    <div class="col-md-6">
        <h3>Загрузить переменные сайта базу</h3>
        <form role="form" class="form-inline" enctype="multipart/form-data" action="/sadmin/content/csv-to-mysql/" method="post">
            <div class="form-group">
                <label for="csvfile">Выберите файл</label>
                <input type="file" name="csvfile">
            </div>
            <button class="btn btn-primary" type="submit">Загрузить</button>
        </form>
    </div>
</div>

<hr>

<div class="row">
    <div class="col-md-12">
        <h2>Страницы сайта
            <a class="btn btn-success pull-right"
                id="RowAdd"
                data-params="content|"
                href="/sadmin/ajax/_row-add.php">Добавить статью</a>
        </h2>
        <table class="table table-condensed table-hover table-bordered">
            <tr class="active">
                <th></th>
                <th>h1</th>
                <th><span data-toggle="tooltip" title="Опубликовать">Pub</span></th>
                <th><span data-toggle="tooltip" title="Избранное">Fav</span></th>
                <th><span data-toggle="tooltip" title="Иконки простомтра и комментариев">Icon</span></th>
                <th><span data-toggle="tooltip" title="Alias">Alias</span></th>
                <th>fileName</th>
                <th>readmore</th>
                <th width="1%"><span data-toggle="tooltip" title="Дата публикации">Дата</span></th>
                <th>hits</th>
                <th width="1%" class="text-center"><span class="glyphicon glyphicon-edit"></span></th>
                <th width="1%" class="text-center"><span class="glyphicon glyphicon-trash"></span></th>
            </tr>
    <?
    foreach(json_decode(json_encode($res->qContent), true) as $r) {
    ?>
        <tr>
            <td><?=$r['id'];?></td>
            <td class="edit_row" data-params="content|h1|<?=$r['id'];?>"><?=$r['h1'];?></td>
            <td><input class="jedCheck" type="checkbox" data-params="content|published|<?=$r['id'];?>"<?=(($r['published'] == true)?' checked="checked"':'');?>></td>
            <td><input class="jedCheck" type="checkbox" data-params="content|favorite|<?=$r['id'];?>"<?=(($r['favorite'] == true)?' checked="checked"':'');?>></td>
            <td><input class="jedCheck" type="checkbox" data-params="content|catid|<?=$r['id'];?>"<?=(($r['catid'] == true)?' checked="checked"':'');?>></td>
            <td>
                <span class="edit_row" data-params="content|alias|<?=$r['id'];?>"><?=$r['alias'];?></span>
                <a class="btn btn-sm btn-primary pull-right ToTranslit"
                    data-id="<?=$r['id'];?>"
                    data-toggle="tooltip" title="Перевести в транслит из h1"
                    data-params="content|h1|alias|<?=$r['alias'];?>">
                        <span class="fa fa-undo"></span></a>
            </td>
            <td class="edit_row" data-params="content|fileName|<?=$r['id'];?>"><?=$r['fileName'];?></td>
            <td class="edit_row" data-params="content|readmore|<?=$r['id'];?>"><?=$r['readmore'];?></td>
            <td><div class="input-group input-group-sm date form_datetime"
                    data-date="<?=$r['publish_up'];?>"
                    data-date-format="dd.mm.yyyy HH:ii"
                    data-link-field="dtp_input1">
                    <input type="hidden" id="dtp_input1" value="" />
                    <input class="form-control" size="16" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span></div>
            </td>
            <td><?=$r['hits'];?></td>
            <td>
                <div class="input-group input-group-sm">
                  <a class="btn btn-sm btn-primary contentEdit"
                    data-id="<?=$r['id'];?>"
                    data-params=""
                    data-toggle="modal"
                    data-target="#modalContentEdit">
                        <span class="glyphicon glyphicon-edit"></span></a>
                   <span class="input-group-btn">
                                        <a class="btn btn-sm btn-primary articleEdit"
                    data-id="<?=$r['id'];?>"
                    data-params=""
                    data-toggle="modal"
                    data-target="#modalContentBodyEdit">
                        <span class="glyphicon glyphicon-pencil"></span></a>
                    </span>
                </div>
            </td>
            <td>
                <div class="input-group input-group-sm">
                    <span class="input-group-addon">
                        <input type="checkbox" value="Del">
                    </span>
                    <span class="input-group-btn">
                        <a href="/sadmin/ajax/_row-del.php" class="btn btn-danger RowDel" data-params="id=<?=$r['id'];?>"><span class="glyphicon glyphicon-trash"></span></a>
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
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary">Сохранить</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit Article Body -->
<div class="modal fade bs-example-modal-lg" id="modalContentBodyEdit" tabindex="-1" role="dialog" aria-labelledby="articleEdit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
        <!-- -->
<div class="small-padding">
  <div class="hero-unit">
  <div class="pull-right">
  </div>
    <h2>Редактирование содержимого страницы</h2>
    <hr/>
    
    <div id="alerts"></div>
    <div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
          <ul class="dropdown-menu">
          </ul>
        </div>
      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
          <ul class="dropdown-menu">
          <li><a data-edit="fontSize 5"><font size="5">Большой</font></a></li>
          <li><a data-edit="fontSize 3"><font size="3">Средний</font></a></li>
          <li><a data-edit="fontSize 1"><font size="1">Маленький</font></a></li>
          </ul>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
        <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
        <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
        <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="fa fa-list-ul"></i></a>
        <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="fa fa-list-ol"></i></a>
        <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="fa fa-indent"></i></a>
        <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="fa fa-outdent"></i></a>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
        <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
        <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
        <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
      </div>
      <div class="btn-group">
          <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="fa fa-link"></i></a>
            <div class="dropdown-menu input-append">
                <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
                <button class="btn" type="button">Add</button>
        </div>
        <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="fa fa-cut"></i></a>

      </div>
      
      <div class="btn-group">
        <a class="btn" id="pictureBtn" ><i class="fa fa-file-image-o"></i><input type="file" class="file-button" id="file" data-id=""  data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" /></a>
              <!--<div id="fileuploader">Upload</div>-->
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
        <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
        <a class="btn" data-edit="html" title="Clear Formatting"><i class="glyphicon glyphicon-pencil"></i></a>
      </div>
      <!--<input type="text" data-edit="inserttext" id="voiceBtn" x-webkit-speech="">-->
    </div>
    <div id="editor" data-params="content|full_text" data-cid=""></div>
  </div>
</div>
            <div class="editor-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary btnWSave" data-htmlx="true">Сохранить</button>
            </div> <!-- -->
    </div>
  </div>
</div>

<link href="http://hayageek.github.io/jQuery-Upload-File/4.0.10/uploadfile.css" rel="stylesheet">

<script>

document.addEventListener("DOMContentLoaded", function(){

  $(function(){
    function initToolbarBootstrapBindings() {
      var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 
            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
            'Times New Roman', 'Verdana'],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
      $.each(fonts, function (idx, fontName) {
          fontTarget.append($('<li><a data-edit="fontName ' + fontName +'" style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
      });
      $('a[title]').tooltip({container:'body'});
        $('.dropdown-menu input').click(function() {return false;})
            .change(function () {$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');})
        .keydown('esc', function () {this.value='';$(this).change();});
    };
    function showErrorAlert (reason, detail) {
        var msg='';
        if (reason==='unsupported-file-type') { msg = "формат не поддерживается " +detail; }
        else {
            console.log("Ошибка загрузки изображения", reason, detail);
        }
        $('<div class="alert  alert-danger"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
         '<strong>Ошибка загрузки изображения:</strong> '+msg+' </div>').prependTo('#alerts');
    };
    initToolbarBootstrapBindings();  
    $('#editor').wysiwyg({ fileUploadError: showErrorAlert} );
    window.prettyPrint && prettyPrint();
  });

});
</script>