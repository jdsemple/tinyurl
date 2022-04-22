<?php
/**********************************************************
 *  Copyright (c) 2022, Jim Semple, Semple Ventures       *
 *  https://www.sempleventures.com/                       *
 **********************************************************/
?>
<?php
// uncomment to turn on PHP errors (**** NOT 4 PRODUCTION *****)
//error_reporting(E_ALL); ini_set('display_errors', 1);

function form($field) {
	if (isset($_POST[$field])) return $_POST[$field];
	if (isset($_GET[$field])) return $_GET[$field];
	if (!empty($_GET) && $field == '') return $_GET;
	return null;
}
?>
