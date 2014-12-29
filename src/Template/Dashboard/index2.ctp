	<section class="dash-section">
		<h3 class="green">Users Online</h3>
		<ul class="dashboard-users scrollbar">
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade user_bg_<?= $user['id'];?>">
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['display_name'];?> Avatar">
					</div>
					<span>
						<?= $this->element('user_status',['user' => $user]); ?>
						<?= $user['display_name'];?>
					</span>
					<small style:"text-align:right;" class="user_text_<?= $user['id'];?>"><?= $user['location'];?></small>
					<span style="text-align:right;padding-right:10px" class="user_text_<?= $user['id'];?>"><?= $serverTime->i18nFormat('E h:mm a', $user['timezone'], 'en_US'); ?></span>
				</li>
			</a>
			<? endforeach; ?>
		</ul>
	</section>

	<section class="dash-section">
		<h3 class="orange">Announcements</h3>
		<ul class="dashboard-users scrollbar">
			<? foreach($announcements as $announcement): ?>
			<a href="/announcements/view/<?= $announcement['id']; ?>">
				<li class="fade" >
					<div style="background:url('<?= '../'.$announcement['user']['avatar'];?>');background-size:cover;" alt="<?= $announcement['user']['display_name'];?> Avatar">
					</div>
					<span><?= $announcement['title'];?></span>
					<small>
					<? if($announcement['User']['status'] == "online"): ?>
							<img class="badge" src="/img/theme/icons/statuses/online.svg" alt="online"/>
						<? elseif($announcement['User']['status'] == "away"): ?>
							<img class="badge" src="/img/theme/icons/statuses/away.svg" alt="away"/>
						<? elseif($announcement['User']['status'] == "busy"): ?>
							<img class="badge" src="/img/theme/icons/statuses/busy.svg" alt="busy"/>
						<? elseif($announcement['User']['status'] == "offline"): ?>
							<img class="badge" src="/img/theme/icons/statuses/offline.svg" alt="offline"/>
					<? endif; ?>
					<?= $announcement['User']['display_name'];?></small>
					<small>
						<?=
						$this->Time->format(
						$announcement['created'],
						'F jS, Y h:i A',
						null,
						$user['User']['time_zone']
						);
						?>
					</small> 
					
				</li>
			</a>
			<? endforeach; ?>
		</ul>
	</section>

	<section class="dash-section">
		<h3 class="red">Upcoming Tasks</h3>
		<ul class="dashboard-users scrollbar">
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade" >
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['display_name'];?> Avatar">
					</div>
						
					<span>
					<? if($user['status'] == "online"): ?>
							<img class="badge" src="/img/theme/icons/statuses/online.svg" alt="online"/>
						<? elseif($user['status'] == "away"): ?>
							<img class="badge" src="/img/theme/icons/statuses/away.svg" alt="away"/>
						<? elseif($user['status'] == "busy"): ?>
							<img class="badge" src="/img/theme/icons/statuses/busy.svg" alt="busy"/>
						<? elseif($user['status'] == "offline"): ?>
							<img class="badge" src="/img/theme/icons/statuses/offline.svg" alt="offline"/>
						<? endif; ?>
					<?= $user['display_name'];?></span>
					<small><?= $serverTime->nice($user['timezone'], 'en_US'); ?></small> 
					<small><?= $user['location'];?></small>
				</li>
			</a>
			<? endforeach; ?>
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade" >
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['display_name'];?> Avatar">
					</div>
						
					<span>
					<? if($user['status'] == "online"): ?>
							<img class="badge" src="/img/theme/icons/statuses/online.svg" alt="online"/>
						<? elseif($user['status'] == "away"): ?>
							<img class="badge" src="/img/theme/icons/statuses/away.svg" alt="away"/>
						<? elseif($user['status'] == "busy"): ?>
							<img class="badge" src="/img/theme/icons/statuses/busy.svg" alt="busy"/>
						<? elseif($user['status'] == "offline"): ?>
							<img class="badge" src="/img/theme/icons/statuses/offline.svg" alt="offline"/>
						<? endif; ?>
					<?= $user['display_name'];?></span>
					<small><?= $serverTime->nice($user['timezone'], 'en_US'); ?></small> 
					<small><?= $user['location'];?></small>
				</li>
			</a>
			<? endforeach; ?>
		</ul>
	</section>

	<section class="dash-section">
		<h3 class="teal">Forum Activity</h3>
		<ul class="dashboard-users scrollbar">
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade" >
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['display_name'];?> Avatar">
					</div>
						
					<span>
					<? if($user['status'] == "online"): ?>
							<img class="badge" src="/img/theme/icons/statuses/online.svg" alt="online"/>
						<? elseif($user['status'] == "away"): ?>
							<img class="badge" src="/img/theme/icons/statuses/away.svg" alt="away"/>
						<? elseif($user['status'] == "busy"): ?>
							<img class="badge" src="/img/theme/icons/statuses/busy.svg" alt="busy"/>
						<? elseif($user['status'] == "offline"): ?>
							<img class="badge" src="/img/theme/icons/statuses/offline.svg" alt="offline"/>
						<? endif; ?>
					<?= $user['display_name'];?></span>
					<small><?= $serverTime->nice($user['timezone'], 'en_US'); ?></small> 
					<small><?= $user['location'];?></small>
				</li>
			</a>
			<? endforeach; ?>
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade" >
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['display_name'];?> Avatar">
					</div>
						
					<span>
					<? if($user['status'] == "online"): ?>
							<img class="badge" src="/img/theme/icons/statuses/online.svg" alt="online"/>
						<? elseif($user['status'] == "away"): ?>
							<img class="badge" src="/img/theme/icons/statuses/away.svg" alt="away"/>
						<? elseif($user['status'] == "busy"): ?>
							<img class="badge" src="/img/theme/icons/statuses/busy.svg" alt="busy"/>
						<? elseif($user['status'] == "offline"): ?>
							<img class="badge" src="/img/theme/icons/statuses/offline.svg" alt="offline"/>
						<? endif; ?>
					<?= $user['display_name'];?></span>
					<small><?= $serverTime->nice($user['timezone'], 'en_US'); ?></small> 
					<small><?= $user['location'];?></small>
				</li>
			</a>
			<? endforeach; ?>
		</ul>
	</section>

	<section class="dash-section">
		<h3 class="blue">Wiki Activity</h3>
		<ul class="dashboard-users scrollbar">
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade" >
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['display_name'];?> Avatar">
					</div>
						
					<span>
					<? if($user['status'] == "online"): ?>
							<img class="badge" src="/img/theme/icons/statuses/online.svg" alt="online"/>
						<? elseif($user['status'] == "away"): ?>
							<img class="badge" src="/img/theme/icons/statuses/away.svg" alt="away"/>
						<? elseif($user['status'] == "busy"): ?>
							<img class="badge" src="/img/theme/icons/statuses/busy.svg" alt="busy"/>
						<? elseif($user['status'] == "offline"): ?>
							<img class="badge" src="/img/theme/icons/statuses/offline.svg" alt="offline"/>
						<? endif; ?>
					<?= $user['display_name'];?></span>
					<small><?= $serverTime->nice($user['timezone'], 'en_US'); ?></small> 
					<small><?= $user['location'];?></small>
				</li>
			</a>
			<? endforeach; ?>
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade" >
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['display_name'];?> Avatar">
					</div>
						
					<span>
					<? if($user['status'] == "online"): ?>
							<img class="badge" src="/img/theme/icons/statuses/online.svg" alt="online"/>
						<? elseif($user['status'] == "away"): ?>
							<img class="badge" src="/img/theme/icons/statuses/away.svg" alt="away"/>
						<? elseif($user['status'] == "busy"): ?>
							<img class="badge" src="/img/theme/icons/statuses/busy.svg" alt="busy"/>
						<? elseif($user['status'] == "offline"): ?>
							<img class="badge" src="/img/theme/icons/statuses/offline.svg" alt="offline"/>
						<? endif; ?>
					<?= $user['display_name'];?></span>
					<small><?= $serverTime->nice($user['timezone'], 'en_US'); ?></small> 
					<small><?= $user['location'];?></small>
				</li>
			</a>
			<? endforeach; ?>
		</ul>
	</section>

	<section class="dash-section">
		<h3 class="violet">File Activity</h3>
		<ul class="dashboard-users scrollbar">
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade" >
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['display_name'];?> Avatar">
					</div>
						
					<span>
					<? if($user['status'] == "online"): ?>
							<img class="badge" src="/img/theme/icons/statuses/online.svg" alt="online"/>
						<? elseif($user['status'] == "away"): ?>
							<img class="badge" src="/img/theme/icons/statuses/away.svg" alt="away"/>
						<? elseif($user['status'] == "busy"): ?>
							<img class="badge" src="/img/theme/icons/statuses/busy.svg" alt="busy"/>
						<? elseif($user['status'] == "offline"): ?>
							<img class="badge" src="/img/theme/icons/statuses/offline.svg" alt="offline"/>
						<? endif; ?>
					<?= $user['display_name'];?></span>
					<small><?= $serverTime->nice($user['timezone'], 'en_US'); ?></small> 
					<small><?= $user['location'];?></small>
				</li>
			</a>
			<? endforeach; ?>
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade" >
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['display_name'];?> Avatar">
					</div>
						
					<span>
					<? if($user['status'] == "online"): ?>
							<img class="badge" src="/img/theme/icons/statuses/online.svg" alt="online"/>
						<? elseif($user['status'] == "away"): ?>
							<img class="badge" src="/img/theme/icons/statuses/away.svg" alt="away"/>
						<? elseif($user['status'] == "busy"): ?>
							<img class="badge" src="/img/theme/icons/statuses/busy.svg" alt="busy"/>
						<? elseif($user['status'] == "offline"): ?>
							<img class="badge" src="/img/theme/icons/statuses/offline.svg" alt="offline"/>
						<? endif; ?>
					<?= $user['display_name'];?></span>
					<small><?= $serverTime->nice($user['timezone'], 'en_US'); ?></small> 
					<small><?= $user['location'];?></small>
				</li>
			</a>
			<? endforeach; ?>
		</ul>
	</section>