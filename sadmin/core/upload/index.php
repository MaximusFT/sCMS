<?php
/*
 * jQuery File Upload Plugin PHP Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

error_reporting(E_ALL | E_STRICT);
define('GT_ID', $_GET['id']);
// echo GT_ID;
$GLOBALS["GT_ID"] = GT_ID;
require('UploadHandler.php');
$upload_handler = new UploadHandler();
