<?
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'Rising Tide Team';
?>
<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset(); ?>
	<title>
		<?= $cakeDescription; ?>: FUCK
		<?= $this->fetch('title'); ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="HandheldFriendly" content="true">
	<?
		//CSS Includes
		echo $this->Html->meta('icon');
		echo $this->Html->css('reset');
		echo $this->Html->css('main');
		echo $this->Html->css('dashboard');
		echo $this->Html->css('dashboard_users');
		echo $this->Html->css('user_index');
		echo $this->Html->css('profile');
		echo $this->Html->css('chat');
		echo $this->Html->css('team');
		echo $this->Html->css('notes');
		echo $this->Html->css('forms');
		echo $this->Html->css('dropzone');
		echo $this->Html->css('responsive');

		//JS Includes
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('dropzone.min');
		echo $this->Html->script('notes');
		echo $this->Html->script('board');
		//echo $this->Html->script('App');
	?>


	<?
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>

</head>
<body ng-controller="MainCtrl">
		<header class="user_bg_nohover_<?= $authUser['id'];?>">
			<nav>
				<ul>
					<li class="menu-item"><a class="fade" href='/dashboard'><span class="icon"><img src="/img/theme/icons/dashboard.svg" /></span><span class="menu-text">Home</span></a></li>
					<? if($authUser['is_manager']): ?>
					<li class="menu-item"><a class="fade" href='/team/index'><span class="icon"><img src="/img/theme/icons/team.svg" /></span><span class="menu-text">Team</span></a></li>
					<? endif; ?>
					<li class="menu-item"><a class="fade" href='/notes'><span class="icon"><img src="/img/theme/icons/planner.svg" /></span><span class="menu-text">Notes</span></a></li>
					<li class="menu-item"><a class="fade" href='/forms'><span class="icon"><img src="/img/theme/icons/wiki.svg" /></span><span class="menu-text">Forms</span></a></li>
					<li class="menu-item"><a class="fade" href='/pages/guide'><span class="icon"><img src="/img/theme/icons/board.svg" /></span><span class="menu-text">Guide</span></a></li>
					<? if($authUser['is_admin']): ?>
						<li class="menu-item"><a class="fade" href='/users/admin_index'><span class="icon"><img src="/img/theme/icons/apps.svg" /></span><span class="menu-text">Administration</span></a></li>
					<? endif; ?>
				</ul>
			</nav>
		</header>
		<main class="scrollbar">
			<?= $this->fetch('content'); ?>
		</main>
		<footer class="user_bg_nohover_<?= $authUser['id'];?>">

			<nav>
				<ul>
					<li class="user-panel menu-item">
						<div class="user-info">
							<div><span style="color:#666;">Welcome back,</span></div>
							<div><?= $authUser['full_name']; ?></div>
						</div>
						<div class="user-logout">
							<div><a href='/users/logout'><span class="icon"><img src="/img/theme/icons/logout.svg" /><span class="menu-text">Logout</span></a></span>
						</span>
					</li>
					<li class="menu-item"><a class="fade" href='/users/profile/<?= $authUser['id'];?>'><span class="icon"><img src="/img/theme/icons/profile.svg" /></span><span class="menu-text">Profile</span></a></li>
					<li class="menu-item"><a class="fade" href='/tasks'><span class="icon"><img src="/img/theme/icons/tasks.svg" /></span><span class="menu-text">Feedback</span></a></li>
					<li class="menu-item"><a class="fade" href='mailto:nakamak@ab-controls.com'><span class="icon"><img src="/img/theme/icons/guide.svg" /></span><span class="menu-text">Help Desk</span></a></li>
				</ul>
			</nav>
		</footer>
			<?= $this->Html->script('chat'); ?>
</body>
</html>
