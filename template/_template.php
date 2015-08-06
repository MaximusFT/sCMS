<?php
require_once P_TMP."_head.php";
?>
    <nav class="navbar navbar-default" role="navigation">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo S_URLh;?>"><?php echo S_URLName;?></a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php
                    foreach (json_decode(json_encode($res->qMenus->mainmenu), true) as $menus) {
                        echo '<li'.(($res->qMenuCurr->alias == $menus['alias'])?' class="active"':'').'><a href="'.$menus['path'].'">'.$menus['title'].'</a></li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php echo funPos('module', 'after-nav');?>

    <div class="container">
        <div class="page-header">
            <?php if ($res->qCont->catid == 1) {?>
            <div id="addInfo" class="pull-right">
                <span class="label"><i class="glyphicon glyphicon-eye-open"></i> <a><?php echo $res->qCont->hits;?></a></span>
                <span class="label"><i class="glyphicon glyphicon-comment"></i> <a href="#Comments"><?php echo $res->qCommCount;?></a></span>
            </div>
            <?}?>
            <h1><?php echo $res->qCont->h1;?><?php echo ((!empty($res->qCont->h1Small))?' <small>'.$res->qCont->h1Small.'</small>':'');?></h1>
            <?php echo ((!empty($res->qCont->introText))?'<p class="well well-sm text-primary">'.$res->qCont->introText.'</p>':'');?>
            
            <?php echo funPos('module', 'page-header-bottom');?>

        <?php echo funPos('module', 'breadcrumb');?>
        </div>
    </div>
    
    <div class="container">
        
        <?php echo funPos('module', 'container-top');?>
        
        <div class="row">
            <?php if ($res->qMenuCurr->extension->params->aside == 'left') include P_TMP."aside.php";?>
            <div class="col-sm-8 col-md-9">
                
                <?php echo funPos('module', 'before-content-1');?>
                <?php echo funPos('module', 'before-content-2');?>

                <?include $res->fileName;?>

                <?php echo funPos('module', 'after-content-1');?>
                <?php echo funPos('module', 'after-content-2');?>
            </div>
            <?php if ($res->qMenuCurr->extension->params->aside == 'right') include P_TMP."aside.php";?>
        </div>
        
        <?php echo funPos('module', 'container-bottom');?>

    </div>
    
    <?php echo funPos('module', 'after-container');?>
    
    <footer>
        <div class="container">
            <div id="copyright" class="row">
                <div class="col-md-4">
                    <?php echo funPos('module', 'footer-pos-left');?>
                    <ul class="list-unstyled">
                        <?php
                        foreach (json_decode(json_encode($res->qMenus->footermenu), true) as $menus) {
                            echo '<li'.(($res->qMenuCurr->alias == $menus['alias'])?' class="active"':'').'><a href="'.$menus['path'].'">'.$menus['title'].'</a></li>';
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-md-4">
                    <?php echo funPos('module', 'footer-pos-center');?>
                    <p class="text-center text-primary"><?php echo S_URLName;?></p>
                </div>
                <div class="col-md-4">
                    <?php echo funPos('module', 'footer-pos-right');?>
                    <a class="pull-right" href="#">Back to top</a>
                </div>
            </div>
        </div>
    </footer>
    
    <?php echo funPos('module', 'after-footer');?>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <?php /* Подключается по необходимости
	
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.pack.js"></script>
    */?>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
    <script src="/js/plugins.js"></script>
    <script src="/js/main.js"></script>
</body>
</html>
