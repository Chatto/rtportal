<!-- List Notes -->
<div class="note-section">
	<section style="height:100%;overflow-y:auto;">
	<h4 id="note-header">My Files</h4>
	<? if(!empty($files)): ?>
	<table class="table table-striped table-hover">
		<thead>
			<tr style="background:rgba(0,0,0,0.5);">
				<td>
					<strong>Name</strong>
				</td>
				<td>
					<strong>User</strong>
				</td>
				<td>
					<strong>Created</strong>
				</td>
				<td>
					<strong>Attachment</strong>
				</td>
				<td colspan="2">
					<strong>versions/Delete</strong>
				</td>
			</tr>
		</thead>
		<tbody style="height:auto;">
			<? foreach($files as $file): ?>
				<tr id="note-link-<?= $file['id'];?>" onClick="showOne(<?= $file['id']; ?>);">
					<td>
					<?= $file['name']; ?>
					</td>
					<td>
					<?= $file['user']['display_name']; ?>
					</td>
					<td>
					<small><?= $this->Time->timeAgoinWords($file['created']); ?></small>
					</td>
					<td>
						<? if(!empty($file['file'])): ?>
						<form action="<?= $file['file']; ?>" style="margin:0px;">
							<button class="btn btn-xs btn-info" type="submit">Attachment</button>
						</form>
						<? else: ?>
							--
						<? endif; ?>
					</td>
					<td style="width:1px;">
						<button class="btn btn-xs btn-warning">Edit</button>
					</td>
					<td style="width:1px;">
						<form action="/files/delete/<?= $file['id']; ?>" style="margin:0px;float:right;">
							<button class="btn btn-xs btn-danger" type="submit">Delete</button>
						</form>
					</td>
				</tr>
				<tr style="display:none;"></tr>
				<tr class="hide note-content" id="content-id-<?= $file['id']; ?>">
					<td colspan="5" style="background:rgba(0,0,0,0.5);">
					<p><small><?= $file['description']; ?></small></p>
					</td>
				</tr>
			<? endforeach; ?>
		</tbody>
	</table>
	<? endif; ?>
	<?  ?>
	<? if(!$files): ?>
		<h1 style="width:300px;height:40px;position:absolute;top:1px;right:30%;left:0px;bottom:0px;margin:auto;color:rgba(0,0,0,0.5);">You have no files yet</h1>
	<? endif; ?>
	</section>
</div>

<!-- Add Notes -->
<div class="add-section user_bg_nohover_<?= $authUser['id'];?>">
	<section id="add-note">

			<?= $this->Flash->render(); ?>
	   	<div id="add-form">
	   	<h3>New File</h3><br />
	    <?= $this->Form->create('File', ['type' => 'file']) ?>

	            <?= $this->Form->input('name', ['placeholder' => 'Name']) ?>

	            <?= $this->Form->input('description',
	            	['placeholder' => 'Write your note content here.', 'type' => 'textarea', 'style' => 'width:100%;height:300px;']) ?>

	            <?= $this->Form->input('file', ['type' => 'file']) ?><br />
				 <form action="/files/add" style="margin:0px;float:right;">
					<button class="btn btn-primary" type="submit">Upload File</button>
				</form>
	    <?= $this->Form->end() ?>
	    </div>
	</section>
</div>