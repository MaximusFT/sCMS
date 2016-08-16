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
        <div class="btn-group pull-right2">
            <a class="btn btn-primary" href="account/update">Update Information</a>
            <a class="btn btn-primary" href="account/update/password">Change Password</a>
        </div>
        <table class="table">
            <?php foreach ($res->user->toArray() as $name => $value): ?>
                <tr>
                    <th><?php echo $name ?></th>
                    <td><?php echo $value ?></td>
                </tr>
            <?php endforeach; ?>
        </table>

                    <?php echo $res->contentCurrent->full_text;?>
                </article>

                <?php echo funPos('module', 'after-content-1');?>
                <?php echo funPos('module', 'after-content-2');?>
            </div>
            <?php if ($res->categoryCurrent->params->aside == 'right') include P_TEMP.'aside.php';?>
        </div>

        <?php echo funPos('module', 'container-bottom');?>

    </div>
