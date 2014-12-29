
	<section id="chat">
	<div>
	<ul id="messages" class="chat-messages">
	</ul>
	</div>
	</section>
		<section id="chatusers">
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
	<section id="chatinput" class="user_bg_nohover_<?= $authUser['id'];?>">
	<form>
		<div id="chatbuttons">
			<button>Attach File</button>
			<button>Internal Link</button>
			<button style="font-weight:bold;">B</button>
			<button style="font-style:italic;">I</button>
			<button style="font-style:underline;">U</button>
			<button type="submit" method="POST" style="float:right;">Send</button>
		</div>
		<div id="chattextarea">
		<textarea ng-bind="message"></textarea>
		</div>
	</form>
	</section>
