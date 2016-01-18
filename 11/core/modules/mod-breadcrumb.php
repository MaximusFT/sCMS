<?php
if (isset($page) && !empty($page)){
	if (isset($spage) && !empty($spage)){
		$sp = true;
		if (isset($sspage) && !empty($sspage)){
			$ssp = true;
			if (isset($ssspage) && !empty($ssspage)){
				$sssp = true;
			}
			$ssbread = '<li'
				.(($sssp == true)?'':' class="active"')
				.'>'
				.(($sssp == true && $ssspageFalse == true)?'<a title="'.$spageName.'" href="/'.$page.'/'.$spage.'/'.$sspage.'/">':'')
				.$sspageName
				.(($sssp == true && $ssspageFalse == true)?'</a>':'')
				.'</li>';
		}
		$sbread = '<li'
			.(($ssp == true)?'':' class="active"')
			.'>'
			.(($ssp == true  && $sspageFalse == true)?'<a title="'.$spageName.'" href="/'.$page.'/'.$spage.'/">':'')
			.$spageName
			.(($ssp == true && $sspageFalse == true)?'</a>':'')
			.'</li>';
	}
	$bread = '<li'
		.(($sp == true)?'':' class="active"')
		.'>'
		.(($sp == true && $spageFalse == true)?'<a title="'.$spageName.'" href="/'.$page.'/">':'')
		.$pageName
		.(($sp == true && $spageFalse == true)?'</a>':'')
		.'</li>';
}
$breadcrumb = $bread.$sbread.$ssbread;
?>
<ol class="breadcrumb">
    <li><a href="/" title="Главная страница"><?php echo S_URLName;?></a></li><?=$breadcrumb;?>
</ol>
