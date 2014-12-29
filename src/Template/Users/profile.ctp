<section class="profile-info" style="background:<?= $this->Color->hextorgba($user['color'],0.3);?>;">
<?= $this->Flash->render(); ?>
<div class="profile-avatar" style="background:url('/<?= $user['avatar'];?>');background-size:cover;background-position:center center;background-origin:center center;" alt="<?= $user['display_name'];?> Avatar">
	</div>
	<div id="profile-view" class="user-data">

		<? if(($user['id'] == $authUser['id']) || $authUser['is_admin']): ?>
			<button class="btn btn-sm btn-warning" onclick="showEdit()">Edit Profile</button>
		<? endif; ?>
		<h1><?= $this->element('user_status',['user' => $user]); ?> <?= $user['display_name']; ?></h1>
		<h3 style="color:<?= $user['color'];?>"><?= $user['user_title']; ?></h3>
		<h4>Info</h4>
		<table>
			<tr>
				<td>
					Joined:
				</td>
				<td style="color:<?= $this->Color->hextorgba($user['color']);?>;">
					<?= ucfirst($this->Time->timeAgoinWords($user['join_date']));?>
				</td>
			</tr>
			<tr>
				<td>
					Last online:
				</td>
				<td style="color:<?= $this->Color->hextorgba($user['color']);?>;">
					<?= ucfirst($this->Time->timeAgoinWords($user['last_login']));?>
				</td>
			</tr>
			<tr>
				<td>
					Email:
				</td>
				<td style="color:<?= $this->Color->hextorgba($user['color']);?>;">
					<a style="color:<?= $this->Color->hextorgba($user['color']);?>;" href="mailto:<?= $user['email'];?>">
						<?= $user['email'];?>
					</a>
				</td>
			</tr>
		</table>
	</div>
	<div id="profile-edit" style="padding:10px;">
	<?= $this->Form->create('User', ['type' => 'file', 'action' => 'edit_profile/'.$user['id']]);?>
	<div class="form">
		<h3>Edit Profile <button class="btn btn-sm btn-info" style="float:right;" type="submit">Save User</button></h3>
	            <?= $this->Form->input('display_name', ['value' => $user['display_name']]); ?>
	            <?= $this->Form->input('username', ['value' => $user['username']]); ?>
	            <?= $this->Form->input('user_title', ['value' => $user['user_title']]); ?>
	            <?= $this->Form->input('id', ['value' => $user['id'], 'type' => 'hidden']); ?>
	           	<?= $this->Form->input('email', ['type' => 'email', 'value' => $user['email']]); ?>
	            <?= $this->Form->input('employee_number', ['value' => $user['employee_number']]); ?>
	            <?= $this->Form->input('position', ['value' => $user['position']]); ?>
	            <?= $this->Form->input('department', ['value' => $user['department']]); ?>
           		<?= $this->Form->input('location', ['value' => $user['location']]) ?>
            	<?= $this->Form->input('timezone', ['options' => $timezoneTable, 'default' => $user['timezone']]); ?>
           		<?= $this->Form->input('bio', ['value' => $user['bio'], 'type' => 'textarea']) ?>
    
	     	   <br />
	           <?//= $this->Form->input('start_date', ['type' => 'date']); ?>
	           <? if(!$user['activated']): ?>
	           <?= $this->Form->checkbox('registration_sent'); ?><small> Send Registration Email</small><br />
	           <br />
	           <? else: ?>
	           <div style="display:none;">
	           <?= $this->Form->checkbox('registration_sent'); ?><small> Send Registration Email</small><br />
	           </div>
	      		<? endif; ?>
	           <br />
				<? $colorArray = [
				'Red' => '#FF0000',
				'Orange' => '#FFA500',
				'Yellow' => '#FFFF00',
				'Green' => '#00FF00',
				'Cyan' => '#00FFFF',
				'Blue' => '#0000FF',
				'Indigo' => '#4B0082',
				'Violet' => '#EE82EE',];
				?>

	           	<select name="color">
	           		<? foreach($colorArray as $color => $value): ?>
						<option value="<?= $value;?>"<? if($value == $user['color']):?> selected="selected"<? endif; ?>><?= $color; ?></option>
					<? endforeach; ?>
				</select>
				<br/>

				<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.js"></script>
				<script src="/js/jquery.simplecolorpicker.js"></script>
	          	<?= $this->Form->input('avatar', ['type' => 'file']); ?><br />
	          	<?= $this->Form->input('background', ['type' => 'file']); ?><br />
	 			<?= $this->Form->end() ?>
    	</div>
	</div>
</section>
<section class="user-columns">
	<section class="profile-section">
		<h3 class="orange">Current Tasks</h3>
		<ul class="dashboard-users scrollbar">
			<? foreach($projects as $project): ?>
			<a href="/projects/view/<?= $project['id']; ?>">
				<li class="fade" >
					<div style="background:url('<?= '../'.$user['avatar'];?>');background-size:cover;" alt="<?= $user['full_name'];?> Avatar">
					</div>
					<span><?= $project['title'];?></span>
					<small>
					<? if($project['User']['status'] == "online"): ?>
							<img class="badge" src="/img/theme/icons/statuses/online.svg" alt="online"/>
						<? elseif($project['User']['status'] == "away"): ?>
							<img class="badge" src="/img/theme/icons/statuses/away.svg" alt="away"/>
						<? elseif($project['User']['status'] == "busy"): ?>
							<img class="badge" src="/img/theme/icons/statuses/busy.svg" alt="busy"/>
						<? elseif($project['User']['status'] == "offline"): ?>
							<img class="badge" src="/img/theme/icons/statuses/offline.svg" alt="offline"/>
					<? endif; ?>
					<?= $project['User']['full_name'];?></small>
					<small>
						<?=
						$this->Time->format(
						$project['created'],
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

	<section class="profile-section">
		<h3 class="red">Upcoming Tasks</h3>
		<ul class="dashboard-users scrollbar">
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade" >
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['full_name'];?> Avatar">
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
					<?= $user['full_name'];?></span>
					<small><?= $serverTime->nice($user['timezone'], 'en_US'); ?></small> 
					<small><?= $user['location'];?></small>
				</li>
			</a>
			<? endforeach; ?>
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade" >
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['full_name'];?> Avatar">
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
					<?= $user['full_name'];?></span>
					<small><?= $serverTime->nice($user['timezone'], 'en_US'); ?></small> 
					<small><?= $user['location'];?></small>
				</li>
			</a>
			<? endforeach; ?>
		</ul>
	</section>

	<section class="profile-section">
		<h3 class="violet">Forum Activity</h3>
		<ul class="dashboard-users scrollbar">
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade" >
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['full_name'];?> Avatar">
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
					<?= $user['full_name'];?></span>
					<small><?= $serverTime->nice($user['timezone'], 'en_US'); ?></small> 
					<small><?= $user['location'];?></small>
				</li>
			</a>
			<? endforeach; ?>
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade" >
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['full_name'];?> Avatar">
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
					<?= $user['full_name'];?></span>
					<small><?= $serverTime->nice($user['timezone'], 'en_US'); ?></small> 
					<small><?= $user['location'];?></small>
				</li>
			</a>
			<? endforeach; ?>
		</ul>
	</section>

	<section class="profile-section">
		<h3 class="teal">Wiki Activity</h3>
		<ul class="dashboard-users scrollbar">
			<? foreach($users as $user): ?>
			<a href="/users/profile/<?= $user['id']; ?>">
				<li class="fade" >
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['full_name'];?> Avatar">
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
					<?= $user['full_name'];?></span>
					<small><?= $serverTime->nice($user['timezone'], 'en_US'); ?></small> 
					<small><?= $user['location'];?></small>
				</li>
			</a>
			<? endforeach; ?>
			<? foreach($users as $user): ?>
			<a href="#file-item">
				<li class="fade" >
					<div style="background:url('../<?= $user['avatar'];?>');background-size:cover;" alt="<?= $user['full_name'];?> Avatar">
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
					<?= $user['full_name'];?></span>
					<small><?= $serverTime->nice($user['timezone'], 'en_US'); ?></small> 
					<small><?= $user['location'];?></small>
				</li>
			</a>
			<? endforeach; ?>
		</ul>
	</section>
</section>