<?php
session_start();
date_default_timezone_set('Europe/Kiev');

define('DEF_LANG',			'ru');

$langDefine = true;
$langArray = ['/ru/', '/en/'];
$langArrayU = ['ru', 'en'];

$langUrl = substr($_SERVER['REQUEST_URI'], 0, 4);
$langUser = $_SESSION['myLang'];
if (in_array($langUrl, $langArray)) {
	$_SESSION['myLang'] = trim($langUrl, '/');
	$langUser = trim($langUrl, '/');
} else {
	if (in_array($langUser, $langArrayU)) {
		$langUser = $_SESSION['myLang'];
	} else {
		$_SESSION['myLang'] = DEF_LANG;
		$langUser = DEF_LANG;
	}
}
$langUserInv = ($langUser === 'ru')?'en':'ru';

define('S_HTTP',			'http');
define('S_URLName',			'Your_Site.com');
define('S_URL',				'your_site.com');
define('DEF_TEMP',			'default');

define('P_BASE', 			__DIR__);
define('P_ROOT',			implode(DIRECTORY_SEPARATOR, explode(DIRECTORY_SEPARATOR, P_BASE)));
define('P_SITE',			P_ROOT . '/');
define('P_CORE',			P_ROOT . '/core/');
define('P_MODL',			P_CORE . 'modules/');
define('P_LANG',			P_ROOT . '/language/'.$langUser.'/');
define('P_TEMP',			P_ROOT . '/templates/'.DEF_TEMP.'/');
define('P_VIEW',			P_ROOT . '/templates/'.DEF_TEMP.'/view/');
define('P_HTML',			P_ROOT . '/templates/'.DEF_TEMP.'/html/');

define('A_ROOT',			P_ROOT . '/sadmin');
define('A_CORE',			A_ROOT . '/core/');
define('A_AJAX',			A_ROOT . '/ajax/');
define('A_TEMP',     		A_ROOT . '/template/');
define('A_VIEW',     		A_ROOT . '/template/view/');

define('S_URLs',			S_HTTP . '://'.S_URL);
define('S_URLh',			S_HTTP . '://'.S_URL.'/');
define('S_TEMP',			S_URLs . '/templates/'.DEF_TEMP.'/');
define('A_URLh',			S_URLs . '/sadmin/');
define('S_A_JS',			S_URLs . '/sadmin/js/');

define('ADVIS', 			false);

define('SQL_db', 			'SQL_db');
define('SQL_name', 			'SQL_name');
define('SQL_pass', 			'SQL_pass');
$SQL_array = [
	'user' => SQL_name,
	'pass' => SQL_pass,
	'db'   => SQL_db,
	'host' => 'localhost'
];

require_once P_CORE.'medoo.min.php'; $db = new medoo();
require_once P_CORE.'altorouter.php';
require_once P_CORE.'function.php';
require_once P_CORE.'dateout.php'; $rd = new DateOut();

/**
 * Закоментировать после запуска сайта
 * @var string
 */
// $metaAdd = '<meta name="robots" content="noindex, nofollow" />';

$metaOgUrl = S_URLh
	.((isset($pageLink) && !empty($pageLink))?$pageLink.'/':'')
	.((isset($spageLink) && !empty($spageLink))?$spageLink.'/':'')
	.((isset($sspageLink) && !empty($sspageLink))?$sspageLink.'/':'');
$metaOgImage = S_URLh.'images/';
$metaOgLocale = $langUser.'_'.strtoupper($langUser);
