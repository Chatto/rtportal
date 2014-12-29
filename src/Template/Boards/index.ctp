<!-- List boards -->
<div class="board-section">
	<section style="height:100%;overflow-y:auto;">
	<h4 id="board-header">My boards</h4>
	<? if(!empty($boards)): ?>
	<table class="table table-striped table-hover">
		<thead>
			<tr style="background:rgba(0,0,0,0.5);">
				<td>
					<strong>Board</strong>
				</td>
				<td>
					<strong>Posts</strong>
				</td>
				<td>
					<strong>New</strong>
				</td>
				<td colspan="2">
					<strong>Edit/Delete</strong>
				</td>
			</tr>
		</thead>
		<tbody style="height:auto;">
			<? foreach($boards as $board): ?>
				<tr id="board-link-<?= $board['id'];?>" onClick="showOne(<?= $board['id']; ?>);">
					<td>
					
						<? if(!empty($board['file'])): ?>
							<img width="24px" height="24px" style"float:left;width:18px;height:18px;" src="/<?= $board['file']; ?>"></img>
						<? else: ?>
							--
						<? endif; ?>
					<?= $board['subject']; ?>
					
					</td>
					<td style="text-align:middle;line-height:24px;verticle-align:middle;">
					<small><?= $this->Time->timeAgoinWords($board['created']); ?></small>
					</td>
					<td>
					</td>
					<td style="width:1px;">
						<button class="btn btn-xs btn-warning">Edit</button>
					</td>
					<td style="width:1px;">
						<form action="/boards/delete/<?= $board['id']; ?>" style="margin:0px;float:right;">
							<button class="btn btn-xs btn-danger" type="submit">Delete</button>
						</form>
					</td>
				</tr>
				<tr style="display:none;"></tr>
				<tr class="hide board-content" id="content-id-<?= $board['id']; ?>">
					<td colspan="5" style="background:rgba(0,0,0,0.5);">
					<p><small><?= $board['content']; ?></small></p>
					</td>
				</tr>
			<? endforeach; ?>
		</tbody>
	</table>
	<? endif; ?>
	<?  ?>
	<? if(!$boards): ?>
		<h1 style="width:300px;height:40px;position:absolute;top:1px;right:30%;left:0px;bottom:0px;margin:auto;color:rgba(0,0,0,0.5);">You have no boards yet</h1>
	<? endif; ?>
	</section>
</div>

<!-- Add boards -->
<div class="add-section user_bg_nohover_<?= $authUser['id']; ?>">
	<section id="add-board">

			<?= $this->Flash->render(); ?>
	   	<div id="add-form">
	   	<h3>New board</h3><br />
	    <?= $this->Form->create('Board', ['type' => 'file']) ?>

	            <?= $this->Form->input('subject', ['placeholder' => 'Subject']) ?>

	            <?= $this->Form->input('content',
	            	['placeholder' => 'Write your board content here.', 'type' => 'textarea', 'style' => 'width:100%;height:300px;']) ?>

	            <?= $this->Form->input('file', ['type' => 'file']) ?><br />
				 <form action="/boards/add" style="margin:0px;float:right;">
					<button class="btn btn-primary" type="submit">New board</button>
				</form>
	    <?= $this->Form->end() ?>
	    </div>
	</section>
</div>