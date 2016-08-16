    <div class="container">
        <div class="page-header">
            <h1><?php echo $res->contentCurrent->h1;?><?php echo ((!empty($res->contentCurrent->h1Small))?' <small>'.$res->contentCurrent->h1Small.'</small>':'');?></h1>
            <?php echo funPos('module', 'page-header-bottom');?>
        	<?php echo funPos('module', 'breadcrumb');?>
        </div>
    </div>

    <div class="container">

        <?php echo funPos('module', 'container-top');?>

        <div class="row">
            <?php if ($res->categoryCurrent->params->aside == 'left' || !isset($res->categoryCurrent->params->aside)) include P_TEMP.'aside.php';?>
            <div class="col-sm-8 col-md-9">

                <?php echo funPos('module', 'before-content-1');?>
                <?php echo funPos('module', 'before-content-2');?>

                <article>
        <form method="post" action="/serv/forgot/">
            <p>Enter the email associated with your account</p>

            <div class="form-group">
                <input name="Email" type="text" required autofocus class="form-control" placeholder="Email Address">
            </div>

            <div class="form-group text-center">
                <button type="submit" class="btn btn-primary">Reset Password</button>
                <br/>
                <a href="login">Login</a>
            </div>
        </form>

                    <?php echo $res->contentCurrent->full_text;?>
                </article>

                <?php echo funPos('module', 'after-content-1');?>
                <?php echo funPos('module', 'after-content-2');?>
            </div>
            <?php if ($res->categoryCurrent->params->aside == 'right') include P_TEMP.'aside.php';?>
        </div>

        <?php echo funPos('module', 'container-bottom');?>

    </div>
