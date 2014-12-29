		<ul class="index-users scrollbar">
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li style="float:left;width:20%;" class="fade user_bg_<?= $user['id'];?>">
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