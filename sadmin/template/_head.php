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
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <link href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.9/css/weather-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="<?php echo A_URLh;?>css/bootstrap.css" rel="stylesheet">

    <?/*

    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.9/css/weather-icons-wind.min.css" rel="stylesheet">
    */?>
    <?/*
    <link href="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.17.0/css/blueimp-gallery.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.17.0/css/blueimp-gallery-indicator.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.17.0/css/blueimp-gallery-video.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    */?>

    <link href="https://cdn.datatables.net/1.10.11/css/dataTables.bootstrap.min.css" rel="stylesheet" />

    <?/*
    <link href="https://cdn.datatables.net/buttons/1.1.2/css/buttons.bootstrap.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/colreorder/1.3.1/css/colReorder.bootstrap.css" rel="stylesheet" />
    */?>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/css/datepicker3.min.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-beta.2/css/select2.min.css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/inputs-ext/typeaheadjs/lib/typeahead.js-bootstrap.css" rel="stylesheet"/>

    <link href="<?php echo A_URLh;?>css/jquery.jgrowl.min.css" rel="stylesheet">
    <link href="<?php echo A_URLh;?>css/editor.css" rel="stylesheet">
    <link href="<?php echo A_URLh;?>css/app.css" rel="stylesheet">
    <link href="<?php echo A_URLh;?>css/style.css" rel="stylesheet">

    <?/*
    <script src="https://maps.google.com/maps/api/js"></script>
    */?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>

    <script src="https://code.jquery.com/jquery-2.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.11/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.11/js/dataTables.bootstrap.min.js" type="text/javascript"></script>

    <?/*
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.bootstrap.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.colVis.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.1.2/js/buttons.print.js"></script>
    */?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.1/js/locales/bootstrap-datepicker.ru.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/bootstrap3-editable/js/bootstrap-editable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0-beta.2/js/select2.min.js"></script>

    <?/*
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.17.0/js/blueimp-helper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.17.0/js/blueimp-gallery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.17.0/js/blueimp-gallery-fullscreen.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.17.0/js/blueimp-gallery-indicator.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.17.0/js/blueimp-gallery-video.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.17.0/js/blueimp-gallery-youtube.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-gallery/2.17.0/js/jquery.blueimp-gallery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-steps/1.1.0/jquery.steps.min.js"></script>
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.2.0/min/dropzone.min.js"></script>
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.2.5/cropper.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cropper/2.2.5/cropper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-Knob/1.2.13/jquery.knob.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-filestyle/1.2.1/bootstrap-filestyle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqBootstrapValidation/1.3.7/jqBootstrapValidation.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    */?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/screenfull.js/3.0.0/screenfull.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/locale/ru.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flot/0.8.3/jquery.flot.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flot.tooltip/0.8.5/jquery.flot.tooltip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.7/jquery.slimscroll.min.js"></script>
    <script src="<?php echo S_A_JS;?>vendor/jquery.nestable.js"></script>

    <script src="<?php echo S_A_JS;?>vendor/typeahead.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.1/inputs-ext/typeaheadjs/typeaheadjs.js"></script>
    <script src="<?php echo S_A_JS;?>vendor/bloodhound.js"></script>
    <script src="<?php echo S_A_JS;?>vendor/bootstrap-datetimepicker.min.js"></script>
    <script src="<?php echo S_A_JS;?>vendor/bootstrap-datetimepicker.ru.js"></script>
    <script src="<?php echo S_A_JS;?>tinymce/tinymce.min.js"></script>
    <script src="<?php echo S_A_JS;?>vendor/jquery.tabletojson.min.js"></script>
    <script src="<?php echo S_A_JS;?>vendor/jquery.jgrowl.min.js"></script>

    <script src="<?php echo S_A_JS;?>plugins.js"></script>
    <script src="<?php echo S_A_JS;?>main.js"></script>
</head>
<body>
<div class="app-container">
    <header class="bg-primary">
        <nav role="navigation" class="navbar topnavbar">
            <div class="navbar-header">
                <a href="<?=S_URLh;?>" class="navbar-brand"><?=S_URLName;?></a>
                <!-- Mobile buttons-->
                <div class="mobile-toggles">
                    <a href="" class="sidebar-toggle"><em class="fa fa-navicon"></em></a>
                    <a href="#nav-collapse" data-toggle="collapse" class="menu-toggle hidden-material"><em class="fa fa-ellipsis-v fa-fw"></em></a>
                </div>
            </div>
            <div id="nav-collapse" class="nav-wrapper collapse navbar-collapse">
                <ul class="nav navbar-nav hidden-material">
                    <li>
                        <!-- Button used to collapse the left sidebar. Only visible on tablet and desktops-->
                        <a href="" class="hidden-xs sidebar-toggle-off"><em class="fa fa-navicon"></em></a>
                    </li>
                    <!-- START Apps menu-->
                    <li class="dropdown"><a href="" data-toggle="dropdown" data-ripple="" class="dropdown-toggle"><em class="fa fa-th fa-fw"></em><span class="visible-xs-inline ml">Applications</span></a>
                        <!-- START Dropdown menu-->
                        <ul id="bg-white" class="dropdown-menu p wd-lg">
                            <li class="row ml0 mr0 mt mb text-center">
                                <div class="col-xs-4">
                                    <div class="pv"><a href="extras.profile.html"><span class="block mb"><em class="icon-head fa-2x text-warning"></em></span><small class="text-muted">Profile</small></a></div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="pv"><a href="mailbox.html"><span class="block mb"><em class="icon-mail fa-2x text-primary"></em></span><small class="text-muted">Mailbox</small></a></div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="pv"><a href="extras.calendar.html"><span class="block mb"><em class="fa fa-calendar fa-2x text-danger"></em></span><small class="text-muted">Calendar</small></a></div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="pv"><a href="maps.vector.html"><span class="block mb"><em class="icon-map fa-2x text-success"></em></span><small class="text-muted">Map</small></a></div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="pv"><a href="dashboard.html"><span class="block mb"><em class="icon-bar-graph-2 fa-2x text-info"></em></span><small class="text-muted">Dashboard</small></a></div>
                                </div>
                                <div class="col-xs-4">
                                    <div class="pv"><a href="extras.gallery.html"><span class="block mb"><em class="icon-image fa-2x text-muted"></em></span><small class="text-muted">Gallery</small></a></div>
                                </div>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <aside class="bg-white">
        <div class="sidebar-wrapper">
            <div data-ui-sidebar="" class="sidebar">
                <div class="sidebar-nav">
                    <ul class="nav" id="mainMenu" data-match-now="<?=$match['name'];?>">
                        <li><a href="#" id="appReload">Reload Page</a></li>
                        <!-- Iterates over all sidebar items-->
                        <li class="nav-heading"><span class="text-muted">Main Navigation</span></li>
                        <li><a href="<?=A_URLh;?>" data-match-name="sadmin" title="Главная" data-ripple=""><div class="label pull-right label-success">4</div><em class="sidebar-item-icon icon-pie-graph"></em><span>Главная</span></a></li>
                        <li><a href="<?=A_URLh;?>menu/" data-match-name="menu" title="Меню" data-ripple=""><em class="sidebar-item-icon icon-stack"></em><span>Меню</span></a></li>
                        <li><a href="<?=A_URLh;?>category/" data-match-name="category" title="Категории" data-ripple=""><em class="sidebar-item-icon icon-stack"></em><span>Категории</span></a></li>
                        <li><a href="<?=A_URLh;?>content/" data-match-name="content" title="Материалы" data-ripple=""><em class="sidebar-item-icon icon-stack"></em><span>Материалы</span></a></li>
                        <li><a href="<?=A_URLh;?>extension/" data-match-name="extension" title="Расширения" data-ripple=""><em class="sidebar-item-icon icon-stack"></em><span>Расширения</span></a></li>
                        <li><a href="<?=A_URLh;?>module/" data-match-name="module" title="Модули" data-ripple=""><em class="sidebar-item-icon icon-stack"></em><span>Модули</span></a></li>
                        <li><a href="<?=A_URLh;?>comments/" data-match-name="comments" title="Комментарии" data-ripple=""><em class="sidebar-item-icon icon-stack"></em><span>Комментарии</span></a></li>
                        <li><a href="<?=A_URLh;?>askings/" data-match-name="askings" title="Вопросы с сайта" data-ripple=""><em class="sidebar-item-icon icon-stack"></em><span>Вопросы с сайта</span></a></li>
                        <li><a href="<?=A_URLh;?>subscribers/" data-match-name="subscribers" title="Подписчики" data-ripple=""><em class="sidebar-item-icon icon-stack"></em><span>Подписчики</span></a></li>

                        <li><hr></li>
                        <li><hr></li>
                        <li class="nav-heading"><span class="text-muted">Addons</span></li>
                        <li><a href="/sadmin/template/media/dialog.php?type=0&lang=ru_RU&popup=0&crossdomain=0&field_id=&relative_url=0&akey=key&fldr=" target="_blank">Media</a></li>

                        <li><hr></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- END Sidebar-->
    </aside>
