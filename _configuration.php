<?php
define('P_BASE', 			__DIR__);
define('P_ROOT',        	implode(DIRECTORY_SEPARATOR, explode(DIRECTORY_SEPARATOR, P_BASE)));
define('P_SITE',        	P_ROOT . '/');
define('P_TMP',        		P_ROOT . '/template/');
define('P_CFG',				P_ROOT . '/template/cfg/');
define('P_VIEW',        	P_ROOT . '/template/view/');
define('P_MOD',     		P_ROOT . '/template/modules/');

define('A_ROOT',			P_ROOT . '/sadmin');
define('A_TMP',     		A_ROOT . '/template/');
define('A_CFG',				A_ROOT . '/template/cfg/');
define('A_VIEW',     		A_ROOT . '/template/view/');
define('A_MOD',     		A_ROOT . '/template/modules/');

define('S_URLName',			'Your_Site.com');
define('S_URL',				'your_site.com');
define('S_URLs',			'http://'.S_URL);
define('S_URLh',			'http://'.S_URL.'/');
define('A_URLh',			'http://'.S_URL.'/sadmin/');
define('S_A_JS',			'http://'.S_URL.'/sadmin/js/');

define('ADVIS', 			false);

define('SQL_db', 			'your_db_name');
define('SQL_name', 			'your_db_user');
define('SQL_pass', 			'your_db_pass');
define('SQL_array', 			array(
	'user' => SQL_name,
	'pass' => SQL_pass,
	'db'   => SQL_db,
	'host' => 'localhost'
));

require_once P_CFG.'medoo.min.php';
$db = new medoo();
require_once P_CFG.'altorouter.php';
require_once P_CFG.'function.php';
require_once P_CFG.'dateout.php';
$rd = new DateOut();

/**
 * Закоментировать после запуска сайта
 * @var string
 */
$metaAdd = '<meta name="robots" content="index, follow" />';


$metaOgUrl = S_URLh
	.((isset($pageLink) && !empty($pageLink))?$pageLink.'/':'')
	.((isset($spageLink) && !empty($spageLink))?$spageLink.'/':'')
	.((isset($sspageLink) && !empty($sspageLink))?$sspageLink.'/':'');
$metaOgImage = S_URLh.'images/';
$metaOgLocale = 'ru_RU';