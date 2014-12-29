<!-- List Notes -->
<div class="note-section">
	<section style="height:100%;overflow-y:auto;">
	<h4 id="note-header">My Notes</h4>
	<? if(!empty($notes)): ?>
	<table class="table table-striped table-hover">
		<thead>
			<tr style="background:rgba(0,0,0,0.5);">
				<td>
					<strong>Subject</strong>
				</td>
				<td>
					<strong>Created</strong>
				</td>
				<td>
					<strong>Attachment</strong>
				</td>
				<td colspan="2">
					<strong>Edit/Delete</strong>
				</td>
			</tr>
		</thead>
		<tbody style="height:auto;">
			<? foreach($notes as $note): ?>
				<tr id="note-link-<?= $note['id'];?>" onClick="showOne(<?= $note['id']; ?>);">
					<td>
					<?= $note['subject']; ?>
					</td>
					<td>
					<small><?= $this->Time->timeAgoinWords($note['created']); ?></small>
					</td>
					<td>
						<? if(!empty($note['file'])): ?>
						<form action="<?= $note['file']; ?>" style="margin:0px;">
							<button class="btn btn-xs btn-info" type="submit">Attachment</button>
						</form>
						<? else: ?>
							--
						<? endif; ?>
					</td>
					<td style="width:1px;">
						<form action="/notes/edit/<?= $note['id']; ?>" style="margin:0px;float:right;">
						<button class="btn btn-xs btn-warning">Edit</button>
						</form>
					</td>
					<td style="width:1px;">
						<form action="/notes/delete/<?= $note['id']; ?>" style="margin:0px;float:right;">
							<button class="btn btn-xs btn-danger" type="submit">Delete</button>
						</form>
					</td>
				</tr>
				<tr style="display:none;"></tr>
				<tr class="hide note-content" id="content-id-<?= $note['id']; ?>">
					<td colspan="5" style="background:#444;">
					<p><small><?= $note['content']; ?></small></p>
					</td>
				</tr>
			<? endforeach; ?>
		</tbody>
	</table>
	<? endif; ?>
	<?  ?>
	<? if(!$notes): ?>
		<h1 style="width:300px;height:40px;position:absolute;top:1px;right:30%;left:0px;bottom:0px;margin:auto;color:rgba(0,0,0,0.5);">You have no notes yet</h1>
	<? endif; ?>
	</section>
</div>

<!-- Add Notes -->
<div class="add-section">
	<section id="add-note">

			<?= $this->Flash->render(); ?>
	   	<div id="add-form">
	   	<h3>New Note</h3><br />
	    <?= $this->Form->create('Note', ['type' => 'file']) ?>

	            <?= $this->Form->input('subject', ['placeholder' => 'Subject']) ?>

	            <?= $this->Form->input('content',
	            	['placeholder' => 'Write your note content here.', 'type' => 'textarea', 'style' => 'width:100%;height:300px;']) ?>

	            <?= $this->Form->input('file', ['type' => 'file']) ?><br />
				 <form action="/notes/add" style="margin:0px;float:right;">
					<button class="btn btn-primary" type="submit">New Note</button>
				</form>
	    <?= $this->Form->end() ?>
	    </div>
	</section>
</div>