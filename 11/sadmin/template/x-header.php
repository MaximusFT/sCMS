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
                    <li<?=($match['name'] == 'sadmin')?' class="active"':'';?>><a href="<?=A_URLh;?>">Главная</a></li>
					<li<?=($match['name'] == 'menu')?' class="active"':'';?>><a href="<?=A_URLh;?>menu/">Меню</a></li>
					<li<?=($match['name'] == 'content')?' class="active"':'';?>><a href="<?=A_URLh;?>content/">Материалы</a></li>
					<li<?=($match['name'] == 'comments')?' class="active"':'';?>><a href="<?=A_URLh;?>comments/">Комментарии</a></li>
					<li<?=($match['name'] == 'askings')?' class="active"':'';?>><a href="<?=A_URLh;?>askings/">Вопросы с сайта</a></li>
					<li<?=($match['name'] == 'subscribers')?' class="active"':'';?>><a href="<?=A_URLh;?>subscribers/">Подписчики</a></li>
					<li<?=($match['name'] == 'module')?' class="active"':'';?>><a href="<?=A_URLh;?>module/">Модули</a></li>
					<li<?=($match['name'] == 'extension')?' class="active"':'';?>><a href="<?=A_URLh;?>extension/">Расширения</a></li>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li><a href="/sadmin/template/media/dialog.php?type=0&lang=ru_RU&popup=0&crossdomain=0&field_id=&relative_url=0&akey=key&fldr=" target="_blank">Media</a></li>
                </ul>
            </div>
        </div>
    </nav>