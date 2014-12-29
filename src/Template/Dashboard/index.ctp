	<section class="dash-section">
		<h3 class="green">Users Online</h3>
		<ul class="dashboard-users scrollbar">
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade user_bg_<?= $user['id'];?>">
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['display_name'];?> Avatar">
					</div>
					<span>
						<?// $this->element('user_status',['user' => $user]); ?>
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
			<a href="#">
				<li id="board-link-<?= $announcement['id'];?>" onClick="showAnnouncement(<?= $announcement['id']; ?>);" class="fade user_bg_<?= $announcement['user_id'];?>" >
					<div style="background:url('<?= '/'.$announcement['user']['avatar'];?>');background-size:cover;" alt="<?= $announcement['Users']['display_name'];?> Avatar">
					<? if($announcement['user']['status'] == "online"): ?>
							<img class="badge" src="/img/theme/icons/statuses/online.svg" alt="online"/>
						<? elseif($announcement['user']['status'] == "away"): ?>
							<img class="badge" src="/img/theme/icons/statuses/away.svg" alt="away"/>
						<? elseif($announcement['user']['status'] == "busy"): ?>
							<img class="badge" src="/img/theme/icons/statuses/busy.svg" alt="busy"/>
						<? elseif($announcement['user']['status'] == "offline"): ?>
							<img class="badge" src="/img/theme/icons/statuses/offline.svg" alt="offline"/>
					<? endif; ?>
					</div>
					<span><?= $announcement['title'];?></span>
					<small style:"text-align:right;" class="user_text_<?= $announcement['user']['id'];?>">by <?= $announcement['user']['display_name'];?></small>
					<span style="float:right;color:<?= $announcement['user']['color'];?>;padding-right:10px;">
						<?=
						$this->Time->timeAgoInWords(
						$announcement['created']
						);
						?>
					</span> 
					
				</li>
				<li class="hide board-content" style="height:auto;width:100%;padding:10px;background:rgba(0,0,0,0.25);" id="announcement-id-<?= $announcement['id']; ?>">
					<?= $announcement['content']; ?>
					
					<? if($authUser['id'] == $announcement['user']['id']): ?>
					<hr />
						<button class="btn btn-xs btn-warning" style="color:#FFF;" type="submit">Edit</button>
						<button class="btn btn-xs btn-danger" style="color:#FFF;" type="submit">Delete</button>
					<? endif; ?>
				</li>
				
			</a>
			<? endforeach; ?>
		</ul>
	</section>


	<section class="dash-section">
		<h3 class="violet">Board Feed</h3>
		<ul class="dashboard-users scrollbar">
			<? foreach($boardfeed as $activity): ?>
			<a href="<?= $activity['link']; ?>">
				<li class="fade user_bg_<?= $activity['user']['id'];?>">
					<div style="background:url('../<?= $activity['user']['avatar'];?>');background-size:cover;" alt="<?= $activity['user']['display_name'];?> Avatar">
					</div>
					<small style:"text-align:right;">
						<span class="user_text_<?= $activity['user']['id'];?>"><?= $activity['user']['display_name'];?></span>
						<span><?= $activity['entry'];?></span>
					</small>
					<span><?= $activity['title'];?></span>
					<span style="float:right;color:<?= $activity['user']['color'];?>;padding-right:10px;">
						<?=
						$this->Time->timeAgoInWords(
						$activity['created']
						);
						?>
					</span> 
				</li>
			</a>
			<? endforeach; ?>
		</ul>
	</section>


	<section class="dash-section">
		<h3 class="teal">Wiki Feed</h3>
		<ul class="dashboard-users scrollbar">
			<? foreach($wikifeed as $activity): ?>
			<a href="<?= $activity['link']; ?>">
				<li class="fade user_bg_<?= $activity['user']['id'];?>">
					<div style="background:url('../<?= $activity['user']['avatar'];?>');background-size:cover;" alt="<?= $activity['user']['display_name'];?> Avatar">
					</div>
					<small style:"text-align:right;">
						<span class="user_text_<?= $activity['user']['id'];?>"><?= $activity['user']['display_name'];?></span>
						<span><?= $activity['entry'];?></span>
					</small>
					<span><?= $activity['title'];?></span>
					<span style="float:right;color:<?= $activity['user']['color'];?>;padding-right:10px;">
						<?=
						$this->Time->timeAgoInWords(
						$activity['created']
						);
						?>
					</span> 
				</li>
			</a>
			<? endforeach; ?>
		</ul>