<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>sCMS Admin Panel</title>
    <meta name="viewport" content="width=device-width">

    <script src="https://code.jquery.com/jquery-2.2.0.js"></script>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

    <link href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.bootstrap.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/colreorder/1.3.1/css/colReorder.bootstrap.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker3.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-beta.2/css/select2.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap.css" rel="stylesheet"/>
    <link href="<?php echo A_URLh;?>css/jquery.jgrowl.min.css" rel="stylesheet">

    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.bootstrap.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.colVis.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/locales/bootstrap-datepicker.ru.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-beta.2/js/select2.min.js"></script>
    <script src="<?php echo S_A_JS;?>vendor/typeahead.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/inputs-ext/typeaheadjs/typeaheadjs.js"></script>
    <script src="<?php echo S_A_JS;?>vendor/bloodhound.js"></script>
    <script src="<?php echo S_A_JS;?>vendor/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo S_A_JS;?>vendor/bootstrap-datetimepicker.ru.js"></script>

    <script src="<?php echo S_A_JS;?>vendor/jquery.tabletojson.min.js"></script>
    <script src="<?php echo S_A_JS;?>vendor/jquery.jgrowl.min.js"></script>

    <script src="<?php echo S_A_JS;?>tinymce/tinymce.min.js"></script>

    <script src="<?php echo S_A_JS;?>plugins.js"></script>
    <script src="<?php echo S_A_JS;?>main.js"></script>

    <link href="<?php echo A_URLh;?>css/style.css" rel="stylesheet">
    <link href="<?php echo A_URLh;?>css/editor.css" rel="stylesheet">
</head>
<body class="admin">
    <nav class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?=S_URLh;?>"><?=S_URLName;?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <?=($match['name'] == 'sadmin')?'<li class="active">':'<li>';?><a href="<?=A_URLh;?>">Главная</a></li>
                    <?=($match['name'] == 'menu')?'<li class="active">':'<li>';?><a href="<?=A_URLh;?>menu/">Меню</a></li>
                    <?=($match['name'] == 'content')?'<li class="active">':'<li>';?><a href="<?=A_URLh;?>content/">Материалы</a></li>
                    <?=($match['name'] == 'comments')?'<li class="active">':'<li>';?><a href="<?=A_URLh;?>comments/">Комментарии</a></li>
                    <?=($match['name'] == 'askings')?'<li class="active">':'<li>';?><a href="<?=A_URLh;?>askings/">Вопросы с сайта</a></li>
                    <?=($match['name'] == 'subscribers')?'<li class="active">':'<li>';?><a href="<?=A_URLh;?>subscribers/">Подписчики</a></li>
                    <?=($match['name'] == 'module')?'<li class="active">':'<li>';?><a href="<?=A_URLh;?>module/">Модули</a></li>
                    <?=($match['name'] == 'extension')?'<li class="active">':'<li>';?><a href="<?=A_URLh;?>extension/">Расширения</a></li>

                    <?=($match['name'] == 'peoples')?'<li class="active">':'<li>';?><a href="<?=A_URLh;?>people/">Люди</a></li>
                    <?=($match['name'] == 'families')?'<li class="active">':'<li>';?><a href="<?=A_URLh;?>family/">Семьи</a></li>
                    <?=(($match['name'] == 'prints') || ($match['name'] == 'print'))?'<li class="active">':'<li>';?><a href="<?=A_URLh;?>print/">Печать</a></li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li><a href="/sadmin/template/media/dialog.php?type=0&lang=ru_RU&popup=0&crossdomain=0&field_id=&relative_url=0&akey=key&fldr=" target="_blank">Media</a></li>
                </ul>
            </div>
        </div>
    </nav>