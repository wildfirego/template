<?php
    if (!(($_SESSION['user_id'] && $_SESSION['wildfire_dashboard_access']) || $userless_install)) {
        header ('Location: /user/login');
        die();
    }
?>

<!doctype html>
<html lang="<?php echo $types['webapp']['lang']; ?>">
<head>
	<meta charset="utf-8">
	<meta name="robots" content="noindex, nofollow">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo 'Wildfire Dashboard'.(isset($types['webapp']['headmeta_title'])?' &raquo; '.$types['webapp']['headmeta_title']:''); ?></title>
	<meta name="description" content="Content management dashboard interface<?php echo (isset($types['webapp']['headmeta_title'])?' for '.$types['webapp']['headmeta_title']:''); ?>">
	<link rel="stylesheet" href="https://use.typekit.net/xkh7dxd.css">
	<link href="<?php echo BASE_URL; ?>/assets/css/admin/bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>/assets/css/admin/wildfire.css" rel="stylesheet">
	<link href="/plugins/fontawesome/css/all.min.css" rel="stylesheet">
	<link href="/plugins/datatables/datatables.min.css" rel="stylesheet">
	<link href="<?php echo BASE_URL; ?>/assets/css/admin/custom.css" rel="stylesheet">
</head>

<body>
<hr class="hr fixed-top" style="margin:0 !important;">
<?php
if ($menus['main']['logo']['name']) {
	$admin_menus['admin_menu']['logo']=$menus['main']['logo'];
	$admin_menus['admin_menu']['logo']['src']='';
	$admin_menus['admin_menu']['logo']['name']='<span class="fas fa-angle-double-left"></span>&nbsp;'.$menus['main']['logo']['name'];
}
echo $theme->get_navbar_menu($admin_menus['admin_menu'], array('navbar'=>'navbar-expand-md navbar-light bg-primary mb-4 pt-1 pb-0', 'ul'=>'navbar-nav ml-auto mr-0', 'li'=>'nav-item', 'a'=>'nav-link text-white', 'toggler'=>'navbar-toggler text-white'), '<span class="fas fa-bars"></span>', ''); ?>