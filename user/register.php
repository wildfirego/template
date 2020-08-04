<?php
include_once ('../config-init.php');
include_once (ABSOLUTE_PATH.'/user/header.php');

if ($_POST['email'] && $_POST['password']) {
	$q=$sql->executeSQL("SELECT `id` FROM `data` WHERE `content`->'$.email'='".$_POST['email']."' && `content`->'$.password'='".md5($_POST['password'])."' && `content`->'$.type'='user'");
	if ($q[0]['id']) {
		$user=$dash->get_content($q[0]['id']);
		$roleslug=$user['role_slug'];

		//for admin and crew (staff)
		if ($types['user']['roles'][$roleslug]['role']=='admin' || $types['user']['roles'][$roleslug]['role']=='crew') {
			$_SESSION['user_id']=$user['user_id'];
			$_SESSION['email']=$user['email'];
			$_SESSION['user']=$user;
			$_SESSION['wildfire_dashboard_access']=1;
			header('Location: /admin');
		}

		//for members
		else if ($types['user']['roles'][$roleslug]['role']=='member') {
			$_SESSION['user_id']=$user['user_id'];
			$_SESSION['email']=$user['email'];
			$_SESSION['user']=$user;
			$_SESSION['wildfire_dashboard_access']=0;
			header('Location: /user');
		}

		//for visitors and anybody else
		else 
			header('Location: /');
	}
}

if (($types['webapp']['dashboard_theme']??false) && file_exists(THEME_PATH.'/user-register.php')):
	include_once (THEME_PATH.'/user-register.php');
else: ?>

<form class="form-user" method="post" action="/user/register"><h2><?php echo $menus['main']['logo']['name']; ?></h2>
	<h4 class="my-3 font-weight-normal"><span class="fas fa-lock"></span>&nbsp;Register</h4>

	<?php
	$type='user';
	$role = $types['user']['roles'][$_GET[role]];
	if ($role['slug'])
		echo '<input type="hidden" name="role_slug" value="'.$role['slug'].'">';
	include ('../admin/form.php');
	?>

	<div class="checkbox my-1 small"><label><input type="checkbox" class="my-0" value="remember-me"> I agree with the terms and conditions</label></div>
	<button type="submit" class="btn btn-sm btn-primary btn-block my-1">Register</button>
	<a class="btn btn-sm btn-outline-primary btn-block my-1" href="/user/login">Sign in</a>
	<p class="text-muted small my-2"><a href="/user/forgot-password"><span class="fas fa-key"></span>&nbsp;Forgot password?</a></p>
	<p class="text-muted small my-5"><?php echo '<a href="'.BASE_URL.'"><span class="fas fa-angle-double-left"></span>&nbsp;'.$menus['main']['logo']['name'].'</a>'; ?></p>
	<p class="text-muted small my-5">&copy; <?php echo (date('Y')=='2020'?date('Y'):'2020 - '.date('Y')); ?> Wildfire</p>
</form>

<?php endif; ?>

<?php include_once (ABSOLUTE_PATH.'/user/footer.php'); ?>