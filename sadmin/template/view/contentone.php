<?
session_start();
$_SESSION['id'] = $res->contentCurrent->ent[0]->id;
?>

<div class="row">
    <div class="col-md-12">
        <h2><?php echo $res->contentCurrent->ent[0]->h1;?></h2>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <button type="button" class="btn btn-success btn-sm sv-cont" data-params="content|full_text" data-cid="<?=$res->contentCurrent->ent[0]->id;?>">Save & stay</button>
                <button type="button" class="btn btn-primary btn-sm sv-exit">Save & close</button>
                <div class="pull-right">
                    <button type="button" class="btn btn-default btn-sm" href="/sadmin/content/">Назад</button>
                </div>
            </div>
            <div class="panel-body">
                <div id="fullText">
                    <?php echo $res->contentCurrent->ent[0]->full_text;?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(function() {
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
        apply_source_formatting : true,
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
            sCMSAletr(result, 'success');
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