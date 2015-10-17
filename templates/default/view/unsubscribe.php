<p>Здесь вы можете отписаться от нашей подписки</p>
<?php
if (isset($_POST['email']) && !empty($_POST['email'])) {
    $fp = fopen("unsubscribe-users.txt", "a+"); // Открываем файл в режиме записи 
    $mytext = $_POST['email']."|".$_POST['param']."\r\n"; // Исходная строка
    $test = fwrite($fp, $mytext); // Запись в файл
    if ($test) echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><strong>Успех!</strong> Вы успешно отписаны от нашей рассылки.</div>';
    else echo 'Ошибка добавления. Свяжитесь с администратором';
    fclose($fp); //Закрытие файла
} else { ?>
    <form id="unsubscribeForm" action="<?php echo S_URLs;?>/unsubscribe/" method="post" role="form" >
        <div class="input-group">
            <input type="email" class="form-control" name="email" placeholder="example@email.com" requared>
            <input name="param" type="hidden" value="<?php echo $feedParam;?>">
            <span class="input-group-btn">
                <button class="btn btn-default" type="submit">Go!</button>
            </span>
        </div>
    </form>
<? } ?>