<?
session_start();
$_SESSION['id'] = $res->qContent->id;
?>

<div class="row">
    <div class="col-md-4">
        <h2><?php echo $res->qContent->h1;?></h2>
    </div>
    <div class="col-md-4">
        <img id="imageThumbnail" src="<?php echo $res->qContent->imageThumbnail;?>">
    </div>
    <div class="col-md-4">
        <span class="btn btn-success fileinput-button">
            <i class="glyphicon glyphicon-plus"></i>
            <span>Select files...</span>
            <input id="fileupload" type="file" name="files[]" multiple>
        </span>
        <br>
        <br>
        <div id="progress">
            <div class="progress-bar progress-bar-success"></div>
        </div>
        <div id="files"></div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <button type="button" class="btn btn-success btn-sm sv-cont" data-cid="<?=$res->qContent->id;?>">Save & stay</button>
                <button type="button" class="btn btn-primary btn-sm sv-exit">Save & close</button>
                <div class="pull-right">
                    <button type="button" class="btn btn-default btn-sm" href="/sadmin/content/">Назад</button>
                </div>
            </div>
            <div class="panel-body">
                <div id="fullText">
                    <?php echo $res->qContent->full_text;?>
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
            url: "/sadmin/save/",
            data: {
                value: text,
                table: 'content',
                name: 'full_text',
                pk: cid
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
            url: "/sadmin/save/",
            data: {
                value: text,
                table: 'content',
                name: 'full_text',
                pk: cid
            }
        })
        .done(function(result) {
            window.location = "http://<?=$_SERVER['SERVER_NAME'];?>" + "/sadmin/content/";
        });
    });
    $('#fileupload').fileupload({
        url: '<?php echo S_CORE;?>upload/?id=<?php echo $res->qContent->id;?>',
        dataType: 'json',
        done: function (e, data) {
            $.each(data.result.files, function (index, file) {
                $.ajax({
                    type: "POST",
                    url: "/sadmin/save/",
                    data: {
                        value: file.url,
                        table: 'content',
                        name: 'image',
                        pk: <?php echo $res->qContent->id;?>
                    }
                })
                .done(function(result) {
                    $.ajax({
                        type: "POST",
                        url: "/sadmin/save/",
                        data: {
                            value: file.thumbnailUrl,
                            table: 'content',
                            name: 'imageThumbnail',
                            pk: <?php echo $res->qContent->id;?>
                        }
                    }).done(function(result) {
                        $('#imageThumbnail').attr('src',file.thumbnailUrl);
                        sCMSAletr(result, 'success');
                    });
                });
            })
        },
        progressall: function (e, data) {
            var progress = parseInt(data.loaded / data.total * 100, 10);
            $('#progress .progress-bar').css(
                'width',
                progress + '%'
            );
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>