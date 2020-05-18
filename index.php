<?php
include_once ('config-init.php');

if ($type && $slug) {
	$typedata=$types[$type];
	$postdata=$dash::get_content(array('type'=>$type, 'slug'=>$slug));
	$postdata_modified=$postdata;

	$append_phrase='';
	if ($types[$type]['headmeta_title_append']) {
		foreach ($types[$type]['headmeta_title_append'] as $appendit) {
			$key=$appendit['type']; $value=$appendit['slug'];
			$append_phrase.=' '.$types[$type]['headmeta_title_glue'].' '.$types[$key][$value];
		}
	}
	$prepend_phrase='';
	if ($types[$type]['headmeta_title_prepend']) {
		foreach ($types[$type]['headmeta_title_prepend'] as $prependit) {
			$key=$prependit['type']; $value=$prependit['slug'];
			$prepend_phrase.=$types[$key][$value].' '.$types[$type]['headmeta_title_glue'].' ';
		}
	}
	$postdata_modified[$headmeta_title]=$prepend_phrase.$postdata[$headmeta_title].$append_phrase;

	if (file_exists(THEME_PATH.'/single-'.$postdata['id'].'.php'))
		include_once (THEME_PATH.'/single-'.$postdata['id'].'.php');
	else if (file_exists(THEME_PATH.'/single-'.$type.'.php'))
		include_once (THEME_PATH.'/single-'.$type.'.php');
	else
		include_once (THEME_PATH.'/single.php');
}
elseif ($type && !$slug) {
	$typedata=$types[$type];
	$postids=$dash::get_all_ids($type);

	if (file_exists(THEME_PATH.'/archive-'.$type.'.php'))
		include_once (THEME_PATH.'/archive-'.$type.'.php');
	else
		include_once (THEME_PATH.'/archive.php');
}
else {
	include_once (THEME_PATH.'/index.php');
}
?>