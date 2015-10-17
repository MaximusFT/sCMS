<p>Подписывайте на наши обновления, чтобы получать полезную информацию.</p>
<?php
if (isset($_POST['email']) && !empty($_POST['email'])) {
    $fp = fopen("subscribe-users.txt", "a+");
    $mytext = $_POST['email']."|".$_POST['param']."\r\n";
    $test = fwrite($fp, $mytext);
    if ($test) echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Успех!</strong> Вы добавлены на подписку новостей</div>';
    else echo 'Ошибка добавления. Свяжитесь с администратором';
    fclose($fp);
} else { ?>
    <form id="subscribeForm" action="<?php echo S_URLs;?>/subscribe/" method="post" role="form" >
        <div class="input-group">
            <input type="email" class="form-control" name="email" placeholder="example@email.com" requared>
            <input name="param" type="hidden" value="<?php echo $match['name'];?>">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Go!</button>
            </span>
        </div>
    </form>
<?php } ?>
