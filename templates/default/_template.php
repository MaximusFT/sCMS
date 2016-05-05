<?php
require_once P_TEMP.'_head.php';
?>

    <div id="top" class="hidden"><?php echo funPos('module', 'tech');?></div>
    <nav class="navbar navbar-default" role="navigation">
        <div id="top-for" class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo S_URLh;?>"><?php echo S_URLName;?></a>
            </div>
            <div class="navbar-collapse collapse" id="navbar-collapse">
                <ul class="nav navbar-nav">
                    <?php echo funPos('module', 'nav-top');?>
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <?php echo funPos('module', 'nav-top-right');?>
                    <?php
                    // Временное решение ))))
                    if (IS_LANG === true) {
                    ?>
                    <li><a href="<?php echo menuLinkBuilder('inverse');?>"><?php echo USER_LANG_INV;?></a></li>
                    <?
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>

    <?php echo funPos('module', 'after-nav');?>

    <?php
        require_once $res->extensionCurrent->fileName;
        // include_once $res->extensionCurrent->fileName;
    ?>

    <?php echo funPos('module', 'after-container');?>

    <footer>
        <div class="container">
            <div id="copyright" class="row">
                <div class="col-md-4">
                    <?php echo funPos('module', 'footer-pos-left');?>
                    <p class="text-center text-muted">Powered by <a href="https://github.com/MaximusFT/sCMS">sCMS</a></p>
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

<div id="top-link">
    <a href="#top" id="top-link-a"><span id="topicon"></span><span id="text">наверх</span></a>
</div>

<?php
require_once P_TEMP.'_ender.php';
?>
