<?php
$siteMap = '<?xml version="1.0" encoding="UTF-8"?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
 
http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">'."\r\n";
$siteMap .= '
<url>
    <loc>'.S_URLh.'</loc>
    <lastmod>'.date("Y-m-d\TH:i:s+02:00").'</lastmod>
    <changefreq>weekly</changefreq>
    <priority>1.00</priority>
</url>'."\r\n";

foreach(json_decode(json_encode($res->qListContent), true) as $r) {
    $siteMap .= '<url>'."\r\n";
    $siteMap .= '<loc>'.S_URLs.$r["path"].'</loc>'."\r\n";
    $siteMap .= '<changefreq>weekly</changefreq>'."\r\n";
    $siteMap .= '<priority>0.50</priority>'."\r\n";
    $siteMap .= '</url>'."\r\n";
}
$siteMap .= '</urlset>';
echo $siteMap;