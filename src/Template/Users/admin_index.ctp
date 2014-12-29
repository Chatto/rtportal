<section class="team-section scrollbar" style="width:70%;overflow-y:auto;">
<h4 id="team-table">Employee Directory</h4>
<table class="table table-striped table-hover">
	<thead>
		<tr style="background:rgba(0,0,0,0.5);">
			<td>
				<strong>Name</strong>
			</td>
			<td>
				<strong>Department</strong>
			</td>
			<td>
				<strong>Position</strong>
			</td>
			<td>
				<strong>Phase</strong>
			</td>
			<td>
				<strong>Manager</strong>
			</td>
			<td>
				<strong>Activation</strong>
			</td>
			<td colspan="2">
				<strong>Edit/Delete</strong>
			</td>
		</tr>
	</thead>
	<tbody>
		<? foreach($users as $user): ?>
			<tr>
				<td>
				<? if($user['is_admin']): ?>
					<img src="/img/theme/icons/admin/admin.svg" style="width:20px;height:20px;float:left;margin-right:5px;" />
				<? endif; ?>
				<? if($user['is_manager']): ?>
					<img src="/img/theme/icons/admin/manager.svg" style="width:20px;height:20px;float:left;margin-right:5px;" />
				<? endif; ?>
				<?= $user['display_name']; ?>
				</td>
				<td>
				<?= $user['department']; ?>
				</td>
				<td>
				<?= $user['position']; ?>
				</td>
				<td>
				<img src="/img/theme/icons/phases/<?= $user['phase']; ?>.svg" style="width:60px;height:20px;"/>
				</td>
				<td>
					<? if($user->manager_id != ''): ?>
					<?= $user->manager_name; ?>
					<? else: ?>
					--
					<? endif; ?>
				</td>
				<td>
				<? if($user['activated']): ?>
					<small style="color:#0F0;">Activated!</small>
				<? else: ?>
					<small style="color:#3DF;">Pending...</small>
				<? endif; ?>
				</td>
				<td style="width:1px;">
					<form action="/users/edit/<?= $user['id']; ?>" style="margin:0px;float:right;">
					<button class="btn btn-xs btn-info">Edit</button>
					</form>
				</td>
				<td style="width:1px;">
					<form action="/users/delete/<?= $user['id']; ?>" style="margin:0px;float:right;">
						<button class="btn btn-xs btn-danger">Delete</button>
					</form>
				</td>
			</tr>
		<? endforeach; ?>
	</tbody>
</table>
</section>

<div class="add-section user_bg_nohover_<?= $authUser['id']; ?>">
	<section id="add-note">

			<?= $this->Flash->render(); ?>
	   	<div id="add-form">
	   	<h3>New Employee</h3><br />
	    <?= $this->Form->create('User', ['action' =>  'add']); ?>
	            <?= $this->Form->input('display_name', ['placeholder' => 'John Smith']); ?>
	           	<?= $this->Form->input('email', ['type' => 'email']); ?>
	            <?= $this->Form->input('employee_number', ['placeholder' => '1283980283']); ?>
	            <?= $this->Form->input('position', ['placeholder' => 'Systems Manager']); ?>
	            <?= $this->Form->input('department', ['placeholder' => 'Engineering']); ?>
	            <label>Manager</label>
	            <select name="manager_id">
	            	<option value="none">--</option>
	            	<? foreach($managers as $manager): ?>
	            	<option value="<?= $manager['id'];?>"><?= $manager['display_name']; ?></option>
	            	<? endforeach; ?>
	            </select>
	            <br />
	        	
	            <?//= $this->Form->input('start_date', ['type' => 'date']); ?>

	           <?= $this->Form->checkbox('is_admin'); ?> <small> Administrator</small><br />
	           <?= $this->Form->checkbox('is_manager'); ?> <small> Manager</small><br />
	           <?= $this->Form->checkbox('registration_sent'); ?><small> Send Registration Email</small><br />
	           <br />
	           <br />
				 <form action="/users/add" style="margin:0px;float:right;">
					<button class="btn btn-primary" type="submit">Add Employee</button>
				</form>
	    <?= $this->Form->end() ?>
	    </div>
	</section>
</div>