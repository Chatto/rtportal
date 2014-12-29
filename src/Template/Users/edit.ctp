<section class="profile-info">
	<div class="user-data">
		<h1><img src="/img/theme/icons/phases/<?= $user['phase']; ?>.svg" style="width:60px;height:20px;margin-right:20px;"/><?= $user['display_name']; ?></h1>
		<h4>Info</h4>
		<table>
			<tr>
				<td>
					Username:
				</td>
				<td style="color:<?= $this->Color->hextorgba($user['color']);?>;">
					<?= $user['username'];?>
				</td>
			</tr>
			<tr>
				<td>
					Employee #:
				</td>
				<td style="color:<?= $this->Color->hextorgba($user['color']);?>;">
					<?= $user['employee_number'];?>
				</td>
			</tr>
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

			<tr>
				<td>
					Department:
				</td>
				<td style="color:<?= $this->Color->hextorgba($user['color']);?>;">
					<?= $user['department'];?>
				</td>
			</tr>

			<tr>
				<td>
					Position:
				</td>
				<td style="color:<?= $this->Color->hextorgba($user['color']);?>;">
					<?= $user['position'];?>
				</td>
			</tr>

			<tr>
				<td>
					Manager:
				</td>
				<td style="color:<?= $this->Color->hextorgba($user['color']);?>;">
					<? if($user->manager_id != ''): ?>
					<?= $user->manager_name; ?>
					<? else: ?>
					--
					<? endif; ?>
				</td>
			</tr>
		</table>
	</div>
</section>
<div class="add-section" style="overflow-y:auto;">
	<section id="add-note">

			<?= $this->Flash->render(); ?>
	   	<div id="add-form">
	   	<h3>Edit Employee</h3><br />
	    <?= $this->Form->create('User', ['action' =>  'edit'.'/'.$user['id']]); ?>
	            <?= $this->Form->input('display_name', ['value' => $user['display_name']]); ?>
	            <?= $this->Form->input('id', ['value' => $user['id'], 'type' => 'hidden']); ?>
	           	<?= $this->Form->input('email', ['type' => 'email', 'value' => $user['email']]); ?>
	            <?= $this->Form->input('employee_number', ['value' => $user['employee_number']]); ?>
	            <?= $this->Form->input('position', ['value' => $user['position']]); ?>
	            <?= $this->Form->input('department', ['value' => $user['department']]); ?>
	            <label>Manager</label>
	            <select name="manager_id">
	            	<option value="none">--</option>
	            	<? foreach($managers as $manager): ?>
	            	<option value="<?= $manager['id'];?>"><?= $manager['display_name']; ?></option>
	            	<? endforeach; ?>
	            </select>
	            <br />
	        	
	            <?//= $this->Form->input('join_date', ['type' => 'date']); ?>

	           <?= $this->Form->checkbox('is_admin', ['checked' => $user['is_admin']]); ?> <small> Employee is Administrator</small><br />
	           <?= $this->Form->checkbox('is_manager', ['checked' => $user['is_manager']]); ?> <small> Employee is Manager</small><br />
	           <? if(!$user['activated']): ?>
	           <?= $this->Form->checkbox('registration_sent'); ?><small> Send Registration Email</small><br />
	           <br />
	           <? else: ?>
	           <div style="display:none;">
	           <?= $this->Form->checkbox('registration_sent'); ?><small> Send Registration Email</small><br />
	           </div>
	      		<? endif; ?>
	           <br />
					<button class="btn btn-primary" type="submit">Save Employee</button>
			
	    <?= $this->Form->end() ?>
	    </div>
	</section>
</div>