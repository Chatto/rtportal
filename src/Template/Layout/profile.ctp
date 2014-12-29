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

$cakeDescription = 'Rising Tide Portal';
?>
<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset(); ?>
	<title>
		<?= $cakeDescription; ?>:
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
		echo $this->Html->css('notes');
		echo $this->Html->css('board');
		echo $this->Html->css('forms');
		echo $this->Html->css('team');
		echo $this->Html->css('jquery.simplecolorpicker');
		echo $this->Html->css('jquery.simplecolorpicker-regularfont');
		echo $this->Html->css('jquery.simplecolorpicker-glyphicons');
		echo $this->Html->css('jquery.simplecolorpicker-fontawesome');
		echo $this->Html->css('jquery.fileupload');
		echo $this->Html->css('jquery.fileupload.ui');
		echo $this->Html->css('bootstrap-datetimepicker.min');
		echo $this->Html->css('responsive');

		//JS Includes
		//echo $this->Html->script('jqClock.min');
		echo $this->Html->script('jquery.min');
		echo $this->Html->script('jquerycolor.min');
		//echo $this->Html->script('angular.min');
		echo $this->Html->script('board');
		echo $this->Html->script('chat');
		echo $this->Html->script('profile');
		//echo $this->Html->script('App');
	?>

	<!-- User Colors -->

	<? if(!empty($user)): ?>
		<style>
				.user_text_<?= $user['id'];?>
				{
					color:<?= $user['color'];?>;
				}
				.user_bg_<?= $user['id'];?>
				{
					background:<?= $this->Color->hextorgba($user['color'],0.3);?>;
				}
				.user_bg_<?= $user['id'];?>:hover
				{
					background:<?= $this->Color->hextorgba($user['color'],0.6);?>;
				}
				.user_bg_nohover_<?= $user['id'];?>
				{
					background:<?= $this->Color->hextorgba($user['color'],0.3);?>;
				}

		</style>
	<? endif; ?> 

	<?
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<? if(!empty($user['background'])): ?>
	<style>
		body{
			background:<?= $user['color']; ?> url("<?= '/'.$user['background']; ?>");
			background-size: cover;
			background-position: center center;
			background-origin: center center;
		}
	</style>
	<? endif; ?>
</head>
<body>	
		<header class="user_bg_nohover_<?= $user['id'];?>">
			<nav>
				<ul>
					<li class="menu-item"><a class="fade" href='/dashboard'><span class="icon"><img src="/img/theme/icons/dashboard.svg" /></span><span class="menu-text">Dashboard</span></a></li>
					<li class="menu-item"><a class="fade" href='/planner'><span class="icon"><img src="/img/theme/icons/planner.svg" /></span><span class="menu-text">Planner</span></a></li>
					<li class="menu-item"><a class="fade" href='/calendar'><span class="icon"><img src="/img/theme/icons/calendar.svg" /></span><span class="menu-text">Calendar</span></a></li>
					<li class="menu-item"><a class="fade" href='/boards'><span class="icon"><img src="/img/theme/icons/board.svg" /></span><span class="menu-text">Board</span></a></li>
					<li class="menu-item"><a class="fade" href='/chat'><span class="icon"><img src="/img/theme/icons/chat.svg" /></span><span class="menu-text">Chat</span></a></li>
					<li class="menu-item"><a class="fade" href='/wiki'><span class="icon"><img src="/img/theme/icons/wiki.svg" /></span><span class="menu-text">Wiki</span></a></li>
					<li class="menu-item"><a class="fade" href='/media'><span class="icon"><img src="/img/theme/icons/files.svg" /></span><span class="menu-text">Files</span></a></li>
					<li class="menu-item"><a class="fade" href='/pages/guide'><span class="icon"><img src="/img/theme/icons/guide.svg" /></span><span class="menu-text">Guide</span></a></li>
					<li class="menu-item"><a class="fade" href='/users/admin_index'><span class="icon"><img src="/img/theme/icons/apps.svg" /></span><span class="menu-text">Admin</span></a></li>
				</ul>
			</nav>
		</header>
		<div class="flash-message">
			<?= $this->Flash->render(); ?>
		</div>
		<main class="scrollbar">
			<?= $this->fetch('content'); ?>
		</main>
		<footer class="user_bg_nohover_<?= $user['id'];?>">

			<nav>
				<ul>
					<li class="user-panel menu-item">
						<?= $this->Html->image('../' . $authUser['avatar']); ?>
						<div class="user-info">
							<div><?= $authUser['display_name']; ?></div>
							<div class="user_text_<?= $authUser['id'];?>"><?= $userTime; ?></div>
						</div>
						<div class="user-logout">
							<div><a href='/users/logout'><span class="icon"><img src="/img/theme/icons/logout.svg" /><span class="menu-text">Logout</span></a></span>
						</span>
					</li>
					<li class="menu-item"><a class="fade" href='/users/profile/<?= $authUser['id'];?>'><span class="icon"><img src="/img/theme/icons/profile.svg" /></span><span class="menu-text">My Profile</span></a></li>
					<li class="menu-item"><a class="fade" href='/tasks'><span class="icon"><img src="/img/theme/icons/tasks.svg" /></span><span class="menu-text">My Tasks</span></a></li>
					<li class="menu-item"><a class="fade" href='/inbox'><span class="icon"><img src="/img/theme/icons/inbox-read.svg" /></span><span class="menu-text">My Inbox</span></a></li>
					<li class="menu-item"><a class="fade" href='/post'><span class="icon"><img src="/img/theme/icons/posts.svg" /></span><span class="menu-text">My Posts</span></a></li>
					<li class="menu-item"><a class="fade" href='/pages'><span class="icon"><img src="/img/theme/icons/pages.svg" /></span><span class="menu-text">My Pages</span></a></li>
					<li class="menu-item"><a class="fade" href='/files'><span class="icon"><img src="/img/theme/icons/files.svg" /></span><span class="menu-text">My Files</span></a></li>
				</ul>
			</nav>
		</footer>
			<?= $this->Html->script('chat'); ?>
</body>
	<? if(!empty($user)): ?>
		<script>
		$( document ).ready(function() {
			$('.user_bg_nohover_<?= $user->id;?>').blurjs({
				source: 'body',
				radius: 16,
				overlay: '<?= $this->Color->hextorgba($user->color,0.3);?>'
			})
		});
		</script>
	<? endif; ?>

</html>
