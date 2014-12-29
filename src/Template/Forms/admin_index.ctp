<!-- List Notes -->

<div class="note-section">
	<section style="height:100%;overflow-y:auto;">
	<h4 id="note-header">Forms</h4>
	<? if(!empty($forms)): ?>
	<table class="table">
		<thead>
			<tr style="background:rgba(0,0,0,0.5);">
				<td>
					<strong>Name</strong>
				</td>
				<td>
					<strong>Color</strong>
				</td>
				<td colspan="2">
					<strong>Edit/Delete</strong>
				</td>
			</tr>
		</thead>
		<tbody style="height:auto;">
			<? foreach($forms as $form): ?>
				<tr style="background:<?= $this->Color->hextorgba($form['color'], 0.8); ?>;" id="note-link-<?= $form['id'];?>" onClick="showOne(<?= $form['id']; ?>);">
					<td>
					<?= $form['name']; ?>
					</td>
					<td>
						<div style="width:20px;height:20px;background:<?= $form['color']; ?>;"></div>
					</td>
					<td style="width:1px;">
						<form action="/forms/edit/<?= $form['id']; ?>" style="margin:0px;float:right;">
						<button class="btn btn-xs btn-warning">Edit</button>
						</form>
					</td>
					<td style="width:1px;">
						<form action="/forms/delete/<?= $form['id']; ?>" style="margin:0px;float:right;">
							<button class="btn btn-xs btn-danger" type="submit">Delete</button>
						</form>
					</td>
				</tr>
				
				<tr style="background:<?= $this->Color->hextorgba($form['color'], 0.8); ?>;" class="hide note-content nohover" id="content-id-<?= $form['id']; ?>">
					<td colspan="5">
					<? if(!empty($form['file'])): ?>
						<img style="margin-right:20px;float:left;width:100px;height:100px;" src="/<?= $form['file']; ?>"/>
					<? endif; ?>
					<p><small><?= $form['description']; ?></small></p>
					<table style="clear:both;width:100%;" class="table table-hover">
				<? foreach($form['children'] as $child): ?>
					<tr style="background:<?= $this->Color->hextorgba($child['color'], 0.8); ?>;" id="note-link-<?= $child['id'];?>" onClick="showOne(<?= $child['id']; ?>);">
						<td>
						<?= $child['name']; ?>
						</td>
						<td>
							<div style="width:20px;height:20px;background:<?= $child['color']; ?>;"></div>
						</td>
						<td style="width:1px;">
							<form action="/forms/edit/<?= $child['id']; ?>" style="margin:0px;float:right;">
							<button class="btn btn-xs btn-warning">Edit</button>
							</form>
						</td>
						<td style="width:1px;">
							<form action="/forms/delete/<?= $child['id']; ?>" style="margin:0px;float:right;">
								<button class="btn btn-xs btn-danger" type="submit">Delete</button>
							</form>
						</td>
					</tr>
					<tr style="background:<?= $this->Color->hextorgba($child['color'], 0.8); ?>;" class="hide note-content" id="content-id-<?= $child['id']; ?>">
						<td colspan="5" class="nohover">
						<? if(!empty($child['file'])): ?>
							<img style="margin-right:20px;float:left;width:100px;height:100px;" src="/<?= $child['file']; ?>"/>
						<? endif; ?>
						<p><small><?= $child['description']; ?></small></p>
						</td>
					</tr>

					<? endforeach; ?>
					</table>
					</td>
				</tr>
			<? endforeach; ?>
		</tbody>
	</table>
	<? endif; ?>
	
</section>
</div>
<!-- Start Process -->
<div class="add-section user_bg_nohover_<?= $authUser['id']; ?>">
	<section id="add-note">

			<?= $this->Flash->render(); ?>
	   	<div id="add-form">
	   	<h3>New Form</h3><br />
	    <?= $this->Form->create('Form', ['type' => 'file']) ?>

	            <?= $this->Form->input('name', ['placeholder' => 'Form name']) ?>
	            <?= $this->Form->input('parent_id', ['options' => $formlist]); ?>

	            <?= $this->Form->input('description',
	            	['placeholder' => 'Write your note content here.', 'type' => 'textarea', 'style' => 'width:100%;height:300px;']) ?>
						<select name="color">
							<option value="#7bd148">Green</option>
							<option value="#5484ed">Bold blue</option>
							<option value="#a4bdfc">Blue</option>
							<option value="#5bc0de">Turquoise</option>
							<option value="#7ae7bf">Light green</option>
							<option value="#5cb85c">Bold green</option>
							<option value="#f0ad4e">Yellow</option>
							<option value="#ffb878">Orange</option>
							<option value="#ff887c">Red</option>
							<option value="#dc2127">Bold red</option>
							<option value="#dbadff">Purple</option>
							<option value="#e1e1e1">Gray</option>
						</select>
	            	<?= $this->Form->input('file', ['type' => 'file']) ?><br />
					<button class="btn btn-primary" type="submit">New Form</button>
	    <?= $this->Form->end() ?>
	    </div>
	</section>
</div>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.js"></script>
<script src="/js/jquery.simplecolorpicker.js"></script>

<script>
$(document).ready(function() {
	$('select[name="color"]').simplecolorpicker({theme: 'glyphicons'});
});
</script>