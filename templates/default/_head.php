<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml"><!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title><?php echo $res->contentCurrent->metaTitle;?></title>
    <meta name="description" content="<?php echo $res->contentCurrent->metaDescription;?>">
    <meta name="keywords" content="<?php echo $res->contentCurrent->metaKeywords;?>">
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, minimal-ui">
    <?php echo $metaAdd;?>

    <!-- Facebook Meta Tags -->
    <meta property="og:title" content="<?php echo $res->contentCurrent->metaOgTitle;?>" />
    <meta property="og:type" content="<?php echo $res->contentCurrent->metaOgType;?>" />
    <meta property="og:url" content="<?php echo $metaOgUrl;?>" />
    <meta property="og:image" content="<?php echo $metaOgImage;?>" />
    <meta property="og:site_name" content="<?php echo $res->contentCurrent->metaOgSiteName;?>" />
    <meta property="og:description" content="<?php echo $res->contentCurrent->metaOgDescription;?>" />
    <meta property="article:section" content="<?php echo $res->contentCurrent->metaOgSection;?>" />
    <meta property="article:tag" content="<?php echo $res->contentCurrent->metaOgTag;?>" />
    <meta property="og:locale" content="<?php echo $metaOgLocale;?>" />
<?php
if (count($_GET) > 0) {
    echo '
    <link rel="canonical" href="http://'.$_SERVER["SERVER_NAME"].substr($_SERVER["REQUEST_URI"], 0, strpos($_SERVER["REQUEST_URI"], $_SERVER["QUERY_STRING"]) - 2).'/" />'
    ;
    // <meta name="robots" content="noindex, follow">
    // header('Location: http://'.$_SERVER['HOST_NAME'].substr($_SERVER['REQUEST_URL'], 0,strpos($_SERVER['REQUEST_URI'], $_SERVER['QUERY_STRING'])- 2));
} else {
    echo $res->addToHead;
    echo '
    <link rel="canonical" href="http://'.$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"].'" />
    ';
}
?>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo S_TEMP;?>css/main.css" rel="stylesheet">

    <?php /* Google Analytics

    <script>
      (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
      (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
      m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
      })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-XXXXXXXX-1', 'auto');
      ga('send', 'pageview');
    </script>
    */?>
</head>
<body>
    <?php /* Yandex Metrika

    <!-- Yandex.Metrika counter --><script type="text/javascript">(function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter21298198 = new Ya.Metrika({id:21298198, webvisor:true, clickmap:true, trackLinks:true, accurateTrackBounce:true}); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = (d.location.protocol == "https:" ? "https:" : "http:") + "//mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks");</script><noscript><div><img src="//mc.yandex.ru/watch/21298198" style="position:absolute; left:-9999px;" alt="" /></div></noscript><!-- /Yandex.Metrika counter -->
    */?>
