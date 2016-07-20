<?
session_start();
$_SESSION['id'] = $res->qContent->id;
?>
<div class="hide" ui-load="/sadmin/js/fileupload/jquery.fileupload.css"></div>
<div class="hide" ui-load="/sadmin/js/fileupload/jquery.ui.widget.js"></div>
<div class="hide" ui-load="/sadmin/js/fileupload/jquery.iframe-transport.js"></div>
<div class="hide" ui-load="/sadmin/js/fileupload/jquery.fileupload.js"></div>

<div class="padding">
    <div class="row">
        <div class="col-md-12">

            <div class="nav-active-border b-warn top box">
                <div class="nav nav-md">
                    <a class="nav-link dark m-r-sm" href="/sadmin/content/">Назад</a>
                    <a class="nav-link sv-cont" data-cid="<?=$res->qContent->id;?>">Save&stay</a>
                    <a class="nav-link sv-exit">Save & close</a>
                </div>
            </div>

            <div class="box">
                <div class="box-header"><h2 class="ng-binding"><?php echo $res->qContent->h1;?></h2></div>
                <div class="box-divider m-a-0"></div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-9">
                            <div id="fullText"><?php echo $res->qContent->full_text;?></div>
                        </div>
                        <div class="col-md-3">
                            <progress class="progress progress-striped progress-animated" value="0" max="100"></progress>
                            <label class="file">
                                <input id="fileupload" type="file" name="files[]" multiple>
                                <span class="file-custom"></span>
                            </label>
                            <div id="files"></div>
                            <img id="imageThumbnail" class="" src="<?php echo $res->qContent->imageThumbnail;?>">
                        </div>
                    </div>
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
        apply_source_formatting : true,
        content_css: [
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
            $('progress').attr('value', progress);
        }
    }).prop('disabled', !$.support.fileInput)
        .parent().addClass($.support.fileInput ? undefined : 'disabled');
});
</script>