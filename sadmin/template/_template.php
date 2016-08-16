<?php
require_once A_TEMP."_head.php";
?>
<div id="app" class="app">
    <!-- aside -->
    <div id="aside" class="app-aside modal fade nav-dropdown">
        <!-- fluid app aside -->
        <div class="left navside dark dk" layout="column">
            <div class="navbar no-radius">
                <!-- brand -->
                <a href="<?=S_URLh;?>" class="navbar-brand">
                    <span class="hidden-folded inline">sCMS - Admin</span>
                </a>
                <!-- / brand -->
            </div>
            <div flex class="hide-scroll">
                <nav class="scroll nav-light">
                    <ul class="nav" ui-nav id="mainMenu" data-match-now="<?=$match['name'];?>">
                        <li class="nav-header hidden-folded">
                            <small class="text-muted">Main</small>
                        </li>
                        <li><a data-pjax-reload>
                                <span class="nav-icon"><i class="fa fa-refresh"></i></span>
                                <span class="nav-text">Reload</span>
                            </a>
                        </li>
                        <li><a href="<?=A_URLh;?>" data-match-name="sadmin" title="Главная">
                                <span class="nav-icon"><i class="fa fa-dashboard"></i></span>
                                <span class="nav-text">Главная</span>
                            </a>
                        </li>
                        <li><a href="<?=A_URLh;?>menu/" data-match-name="menu" title="Меню">
                                <span class="nav-icon"><i class="fa fa-bars"></i></span>
                                <span class="nav-text">Меню</span>
                            </a>
                        </li>
                        <li><a href="<?=A_URLh;?>category/" data-match-name="category" title="Категории">
                                <span class="nav-icon"><i class="fa fa-folder-open-o"></i></span>
                                <span class="nav-text">Категории</span>
                            </a>
                        </li>
                        <li><a href="<?=A_URLh;?>content/" data-match-name="content" title="Материалы">
                                <span class="nav-icon"><i class="fa fa-files-o"></i></span>
                                <span class="nav-text">Материалы</span>
                            </a>
                        </li>
                        <li><a href="<?=A_URLh;?>module/" data-match-name="module" title="Модули">
                                <span class="nav-icon"><i class="fa fa-archive"></i></span>
                                <span class="nav-text">Модули</span>
                            </a>
                        </li>

                        <li class="nav-header hidden-folded">
                            <small class="text-muted">Addons</small>
                        </li>
                        <li><a href="<?php echo A_URLh;?>template/media/dialog.php?type=0&lang=ru_RU&popup=0&crossdomain=0&field_id=&relative_url=0&akey=key&fldr=" target="_blank">
                            <span class="nav-icon"><i class="fa fa-picture-o"></i></span>
                            <span class="nav-text">Media</span>
                        	</a></li>
                        <li>
                        	<a href="<?=A_URLh;?>extension/" data-match-name="extension" title="Расширения">
                                <span class="nav-icon"><i class="fa fa-cogs"></i></span>
                                <span class="nav-text">Расширения</span>
                            </a>
                        </li>

                        <li class="nav-header hidden-folded">
                            <small class="text-muted">Неподключенные</small>
                        </li>
                        <li><a href="<?=A_URLh;?>comments/" data-match-name="comments" title="Комментарии">
                                <span class="nav-icon"><i class="fa fa-comments-o"></i></span>
                                <span class="nav-text">Комментарии</span>
                            </a>
                        </li>
                        <li><a href="<?=A_URLh;?>subscribers/" data-match-name="subscribers" title="Подписчики">
                                <span class="nav-icon"><i class="fa fa-envelope"></i></span>
                                <span class="nav-text">Подписчики</span>
                            </a>
                        </li>
                        <li><a>
                                <span class="nav-caret"><i class="fa fa-caret-down"></i></span>
                                <span class="nav-icon"><i class="fa fa-plus"></i></span>
                                <span class="nav-text">Layouts</span>
                            </a>
                            <ul class="nav-sub">
                                <li><a href="headers.html"><span class="nav-text">Header</span></a></li>
                                <li><a href="asides.html"><span class="nav-text">Aside</span></a></li>
                                <li><a href="footers.html"><span class="nav-text">Footer</span></a></li>
                            </ul>
                        </li>

                        <li class="nav-header hidden-folded">
                            <small class="text-muted">Help</small>
                        </li>
                        <li class="hidden-folded">
                            <a href="#">
                                <span class="nav-text">Documents</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
    <!-- / -->

    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">


        <!-- Header -->
        <div class="app-header white box-shadow">
            <div class="navbar">
                <!-- Open side - Naviation on mobile -->
                <a data-toggle="modal" data-target="#aside" class="navbar-item pull-left hidden-lg-up"><i class="fa fa-bars"></i></a>
                <!-- / -->

                <!-- Page title - Bind to $state's title -->
                <div class="navbar-item pull-left h5 b-r m-r p-r" id="pageTitle">Menu Types</div>

                <!-- navbar collapse -->
                <div class="collapse navbar-toggleable-sm" id="collapse">
                    <!-- <div ui-include="'../views/blocks/navbar.form.right.html'"></div> -->
                    <!-- link and dropdown -->
					<?/*
					*/?>
					<ul class="nav navbar-nav nav-active-border b-primary">
					    <li class="nav-item" data-addition="menu">
					    	<a class="nav-link" data-toggle="modal" data-target="#modalMenuAdd">
				    			<i class="fa fa-fw fa-plus text-muted"></i> <span>Добавить меню</span>
				    		</a>
				    	</li>
					    <li class="nav-item" data-addition="category">
					    	<a class="nav-link" data-toggle="modal" data-target="#modalСategoryAdd">
				    			<i class="fa fa-fw fa-plus text-muted"></i> <span>Добавить категорию</span>
				    		</a>
				    	</li>
					    <li class="nav-item" data-addition="content">
					    	<a class="nav-link" id="addArticle">
				    			<i class="fa fa-fw fa-plus text-muted"></i> <span>Добавить статью</span>
				    		</a>
				    	</li>
					    <li class="nav-item" data-addition="module">
					    	<a class="nav-link" data-toggle="modal" data-target="#modalModuleAdd">
				    			<i class="fa fa-fw fa-plus text-muted"></i> <span>Добавить Модуль</span>
				    		</a>
				    	</li>
					    <li class="nav-item" data-addition="extension">
					    	<a class="nav-link" id="addExtension">
				    			<i class="fa fa-fw fa-plus text-muted"></i> <span>addExtension</span>
				    		</a>
				    	</li>
                    </ul>
                    <!-- / -->
                </div>
                <!-- / navbar collapse -->
            </div>
        </div>

        <!-- Footer -->
        <div class="app-footer">
            <div class="p-a text-xs">
                <div class="pull-right text-muted">
                    &copy; Copyright <strong>sCMS</strong> <span class="hidden-xs-down">- simpleCMS</span>
                    <a ui-scroll-to="content"><i class="fa fa-long-arrow-up p-x-sm"></i></a>
                </div>
                <div class="nav">
                    <a class="nav-link" href="https://github.com/MaximusFT/sCMS">gitHub</a>
                </div>
            </div>
        </div>


        <!-- Content -->
        <!-- <div ui-view class="app-body" id="appGo"> -->
        <div ui-view class="app-body" id="view"></div>

        <?/*
        <div class="nav-active-border b-warn top box">
            <div class="nav nav-md">
                <a class="nav-link active"> Подключенные Офферы</a>
                <a class="nav-link">Неподключенные Офферы</a>
                <a class="nav-link">Все Офферы</a>
                <a class="nav-link"> Приостановленные Офферы</a>
                <a class="nav-link">Coming Soon Офферы</a>
            </div>
        </div>
        */?>

    </div>
</div>

<?php
require_once A_TEMP."_ender.php";
?>