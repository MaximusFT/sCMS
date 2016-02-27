<?
//var_dump($res);
session_start();
$_SESSION['id'] = $res->qContent[0]->id;
?>

<hr>

<div class="row">
    <div class="col-md-6 col-sm-4"><h2><?php echo $res->qContent[0]->h1;?></h2></div>
    <div class="col-md-6  col-sm-8 text-right"> 
        <button type="button" class="btn btn-warning btn-lg" href="/sadmin/content/">Назад</button>
        <button type="button" class="btn btn-default btn-lg sv-cont" data-params="content|full_text" data-cid="<?=$res->qContent[0]->id;?>">Сохранить и продолжить</button>
        <button type="button" class="btn btn-primary btn-lg sv-exit">Сохранить и закрыть</button>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div id="fullText" data-><?php echo $res->qContent[0]->full_text;?></div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    tinymce.init({
        selector: '#fullText',
        height: 500,
        theme: 'modern',
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools jbimages'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | code jbimages',
        image_advtab: true,
        templates: [{
            title: 'Test template 1',
            content: 'Test 1'
        }, {
            title: 'Test template 2',
            content: 'Test 2'
        }],
        content_css: [
            'http://fast.fonts.net/cssapi/e6dc9b99-64fe-4292-ad98-6974f93cd2a2.css',
            'http://www.tinymce.com/css/codepen.min.css'
        ],
        relative_urls: false
    });


    $('.sv-cont').on('click', function(event) {
        event.preventDefault();
        var $this = $(this),
            params = $('.sv-cont').data('params'),
            htmlx = $('.sv-cont').data('htmlx'),
            cid = $('.sv-cont').data('cid'),
            text = $('iframe').contents().find('body').html();
        if (htmlx === false) {
            text = $('iframe').contents().find('body').text();
        };
        $.ajax({
            type: "POST",
            url: "/sadmin/ajax/save-to-db-full.php",
            data: {
                value: text,
                params: params,
                id: cid
            }
        })
        .done(function(result) {
            $.jGrowl('Запись успешно изменена.' /*'Новое значение поля = '+result*/ , {
                theme: 'lightness',
                header: "Состояние запроса:",
                life: 1500
            })
        });
    });
    $('.sv-exit').on('click', function(event) {
        event.preventDefault();
        var $this = $(this),
            params = $('.sv-cont').data('params'),
            htmlx = $('.sv-cont').data('htmlx'),
            cid = $('.sv-cont').data('cid'),
            text = $('iframe').contents().find('body').html();

        if (htmlx === false) {
            text = $('iframe').contents().find('body').text();
        };
        $.ajax({
            type: "POST",
            url: "/sadmin/ajax/save-to-db-full.php",
            data: {
                value: text,
                params: params,
                id: cid
            }
        })
        .done(function(result) {
            window.location = "http://<?=$_SERVER['SERVER_NAME'];?>" + "/sadmin/content/";
        });
    });
});
</script>