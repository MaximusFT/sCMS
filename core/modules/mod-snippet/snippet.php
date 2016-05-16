<?php
/**
 * @package     sCMS.Module
 * @subpackage  mod_snippet
 *
 * @copyright   Copyright (C) 2005-2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * $res - global variable
 * $db - global variable to use MySQL
 * $rd - global variable to use TimeFormat
 * $modRes - main variable with all params by Module
 */

defined('ISsCMS') or die;

$resCont['full_text'] = str_replace("{{".$modRes['position']."}}", htmlspecialchars_decode($modRes['params']['snipetContent']), $resCont['full_text']);

// include $modPathView;
?>