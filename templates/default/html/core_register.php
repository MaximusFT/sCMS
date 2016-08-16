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
<form method="post" action="/serv/register/">
  <label>Username:</label>
  <input type="text" name="Username" />

  <label>Password:</label>
  <input type="password" name="Password" />

  <label>Re-enter Password:</label>
  <input type="password" name="Password2" />

  <label>Email: </label>
  <input type="email" name="Email" />

  <label>Group: </label>
  <select name="GroupID">
    <option value="1">User</option>
    <option value="2">Developer</option>
    <option value="3">Designer</option>
  </select>

  <input type="submit" value="Register" />
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
