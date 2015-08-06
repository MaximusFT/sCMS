<?
if(strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') exit();

header('Content-Type: text/html; charset=utf8');
include($_SERVER['DOCUMENT_ROOT'].'/configuration.php');
?>
<a class="btn btn-success pull-right"
    id="addLink"
    data-params="link"
    href="/sadmin/ajax/_row-add.php">Добавить Ссылку</a>
<div id="showLink"></div>
<script>
    $.ajax({ url : '/sadmin/ajax/extension-link-useful-show.php', type : "post" }).then(function(result) { $('#showLink').html(result); });
    $(function() {
        $("body").on('click', '#addLink', function() {
            var $this = $(this),
                promises;
            event.preventDefault();
            promises = $.map([$this.attr('href')], function(urls) {
                return $.ajax({
                    url : urls,
                    data : {'params': $this.data('params')},
                    type : "post"
                }).then(function(result) {
                    $.jGrowl('Новая Ссылка добавлена', {theme: 'lightness',header: "Состояние запроса:",life: 1500});
                    return $.ajax({
                        url : '/sadmin/ajax/extension-link-useful-show.php', type : "post"
                    }).then(function(result) {
                        $('#showLink').html(result);
                    })
                })
            });
        });
    });
</script>