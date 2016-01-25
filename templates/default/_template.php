<?php
require_once P_TMP.'_head.php';
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

    <?php
        require_once P_TMP.'html/'.$res->qMenuCurr->extension->fileName.'.php';
    ?>

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

<?php
require_once P_TMP.'_ender.php';
?>
