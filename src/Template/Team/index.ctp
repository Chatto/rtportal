<section class="team-section" style="height:50%;overflow-y:auto;">
<h4 id="team-table">My Team</h4>
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
				<strong>Manager</strong>
			</td>
			<td>
				<strong>Phase</strong>
			</td>
		</tr>
	</thead>
	<tbody>
		<? foreach($team as $member): ?>
			<tr>
				<td>
				<?= $member['full_name']; ?>
				</td>
				<td>
				<?= $member['department']; ?>
				</td>
				<td>
				<?= $member->manager_name; ?>
				</td>
				<td>
				<img src="/img/theme/icons/phases/<?= $member['phase']; ?>.svg" style="width:60px;height:20px;"/>
				</td>
			</tr>
		<? endforeach; ?>
	</tbody>
</table>
</section>
<section class="form-section" style="width:33.33%;height:50%;overflow-y:auto;">
<h4 id="coaching-input">Employee Sheets</h4>
<table class="table table-striped table-hover">
	<thead>
		<tr style="background:rgba(0,0,0,0.5);">
			<td>
				<strong>Name</strong>
			</td>
			<td>
				<strong>Year</strong>
			</td>
			<td>
				<strong>Status</strong>
			</td>
			<td colspan="3">
				<strong>Action</strong>
			</td>
		</tr>
	</thead>
	<tbody>
		<? foreach($sheets as $sheet): ?>
		<? if($sheet['name'] == 'Employee Sheet'): ?>
			<tr>

				<td>
				<?= $sheet->employee_name; ?>
				</td>
				<td>
				<small><?= $this->Time->format($sheet['created'], 'Y'); ?></small>
				</td>
				<td>
					<? if($sheet['submitted']): ?>
						<small>Submitted</small>
					<? endif; ?>
					<? if($sheet['approved']): ?>
						<small>Approved</small>
					<? endif; ?>
					<? if(($sheet['submitted'] == false) && ($sheet['approved'] == false)): ?>
						<small>Started</small>
					<? endif; ?>
				</td>
				<? if($sheet['submitted']): ?>
					<td style="width:1px;">
						<form action="/forms/view_sheet/<?= $sheet['id'];?>" target="_blank" style="margin:0px;">
							<button class="btn btn-xs btn-info" style="color:#FFF;" type="submit">View</button>
						</form>
					</td>
					<td style="width:1px;">
						<form action="/forms/approve_sheet/<?= $sheet['id']; ?>" style="margin:0px;">
							<button class="btn btn-xs btn-success" type="submit">Approve</button>
						</form>
					</td>
					<td style="width:1px;">
						<form action="/forms/reject_sheet/<?= $sheet['id']; ?>" style="margin:0px;">
							<button class="btn btn-xs btn-danger" type="submit">Reject</button>
						</form>
					</td>
				<? elseif($sheet['approved']): ?>
					<td colspan="3" style="width:1px;">
						<form action="/forms/view_sheet/<?= $sheet['id'];?>" target="_blank" style="margin:0px;">
							<button class="btn btn-xs btn-info" style="color:#FFF;" type="submit">View</button>
						</form>
					</td>
				<? else: ?>
					<td colspan="3"></td>
				<? endif; ?>
			</tr>
		<? endif; ?>
		<? endforeach; ?>
	</tbody>
</table>
</section>

<!-- Coaching Worksheets -->
<section class="form-section" style="width:33.33%;height:50%">
<h4 id="coaching-worksheet">Coaching Sheet</h4>
<table class="table table-striped table-hover">
	<thead>
		<tr style="background:rgba(0,0,0,0.5);">
			<td>
				<strong>Name</strong>
			</td>
			<td>
				<strong>Year</strong>
			</td>
			<td>
				<strong>Status</strong>
			</td>
			<td colspan="3">
				<strong>Action</strong>
			</td>
		</tr>
	</thead>
	<tbody>
		<? foreach($sheets as $sheet): ?>
		<? if($sheet['name'] == 'Coaching Sheet'): ?>
			<tr>

				<td>
				<?= $sheet->employee_name; ?>
				</td>
				<td>
				<small><?= $this->Time->format($sheet['created'], 'Y'); ?></small>
				</td>
				<td>
					<? if($sheet['submitted']): ?>
						<small>Submitted</small>
					<? endif; ?>
					<? if($sheet['approved']): ?>
						<small>Approved</small>
					<? endif; ?>
					<? if(($sheet['submitted'] == false) && ($sheet['approved'] == false)): ?>
						<small>Started</small>
					<? endif; ?>
				</td>
				<? if($sheet['submitted']): ?>
					<td colspan="3" style="width:1px;">
						<form action="/forms/view_sheet/<?= $sheet['id'];?>" target="_blank" style="margin:0px;">
							<button class="btn btn-xs btn-info" style="color:#FFF;" type="submit">View</button>
						</form>
					</td>
				<? elseif($sheet['approved']): ?>
					<td colspan="3"style="width:1px;">
						<form action="/forms/view_sheet/<?= $sheet['id'];?>" target="_blank" style="margin:0px;">
							<button class="btn btn-xs btn-info" style="color:#FFF;" type="submit">View</button>
						</form>
					</td>
				<? else: ?>
					<td colspan="3" style="width:1px;">
						<form action="/forms/edit_sheet/<?= $sheet['id'];?>" style="margin:0px;">
							<button class="btn btn-xs btn-warning" style="color:#FFF;" type="submit">Edit</button>
						</form>
					</td>
				<? endif; ?>
			</tr>
		<? endif; ?>
		<? endforeach; ?>
	</tbody>
</table>
</section>

<!-- Development Plans -->
<section class="form-section" style="width:33.33%;height:50%">
<h4 id="development-plan">Development Sheets</h4>
<table class="table table-striped table-hover">
	<thead>
		<tr style="background:rgba(0,0,0,0.5);">
			<td>
				<strong>Name</strong>
			</td>
			<td>
				<strong>Year</strong>
			</td>
			<td>
				<strong>Status</strong>
			</td>
			<td colspan="3">
				<strong>Action</strong>
			</td>
		</tr>
	</thead>
	<tbody>
		<? foreach($sheets as $sheet): ?>
		<? if($sheet['name'] == 'Development Sheet'): ?>
			<tr>

				<td>
				<?= $sheet->employee_name; ?>
				</td>
				<td>
				<small><?= $this->Time->format($sheet['created'], 'Y'); ?></small>
				</td>
				<td>
					<? if($sheet['submitted']): ?>
						<small>Submitted</small>
					<? endif; ?>
					<? if($sheet['approved']): ?>
						<small>Approved</small>
					<? endif; ?>
					<? if(($sheet['submitted'] == false) && ($sheet['approved'] == false)): ?>
						<small>Started</small>
					<? endif; ?>
				</td>
				<? if($sheet['submitted']): ?>
					<td style="width:1px;">
						<form action="/forms/view_sheet/<?= $sheet['id'];?>" target="_blank" style="margin:0px;">
							<button class="btn btn-xs btn-info" style="color:#FFF;" type="submit">View</button>
						</form>
					</td>
					<td style="width:1px;">
						<form action="/forms/approve_sheet/<?= $sheet['id']; ?>" style="margin:0px;">
							<button class="btn btn-xs btn-success" type="submit">Approve</button>
						</form>
					</td>
					<td style="width:1px;">
						<form action="/forms/reject_sheet/<?= $sheet['id']; ?>" style="margin:0px;">
							<button class="btn btn-xs btn-danger" type="submit">Reject</button>
						</form>
					</td>
				<? elseif($sheet['approved']): ?>
					<td colspan="3" style="width:1px;">
						<form action="/forms/view_sheet/<?= $sheet['id'];?>" target="_blank" style="margin:0px;">
							<button class="btn btn-xs btn-info" style="color:#FFF;" type="submit">View</button>
						</form>
					</td>
				<? else: ?>
					<td colspan="3"></td>
				<? endif; ?>
			</tr>
		<? endif; ?>
		<? endforeach; ?>
	</tbody>
</table>
</section>