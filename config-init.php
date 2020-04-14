<?php
session_start();
include_once('config/config-vars.php');

if (!$_SESSION['language']) $_SESSION['language']='en';

$types=json_decode(file_get_contents(THEME_PATH.'/config/types.json', true));
$menus=json_decode(file_get_contents(THEME_PATH.'/config/menus.json', true));

include_once(ABSOLUTE_PATH.'/includes/mysql.class.php');
$sql = new MySQL(DB_NAME, DB_USER, DB_PASS, DB_HOST);

include_once(ABSOLUTE_PATH.'/includes/auth.class.php');
$auth = new auth();

include_once(ABSOLUTE_PATH.'/includes/dash.class.php');
$dash = new dash();

include_once(ABSOLUTE_PATH.'/includes/theme.class.php');
$theme = new theme();

include_once(ABSOLUTE_PATH.'/includes/google.class.php');
$google = new google();

include_once(ABSOLUTE_PATH.'/includes/blueimp.class.php');

if ($_GET['ext']) {
	$ext=explode('/', $_GET['ext']);
	$type=$ext[0];
	$slug=$ext[1];
	$typedata=(array) $types->{$_GET['type']};
	$postdata=$dash::get_content(array('type'=>$type, 'slug'=>$slug)); 
}

include_once(ABSOLUTE_PATH.'/admin/functions.php');
include_once(THEME_PATH.'/functions.php');
?>