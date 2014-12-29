<section id="color-info" style="background:<?= $form['color'];?>;width:25%;" class="profile-info">
	<div class="user-data">
		<? if(!empty($form['file'])): ?>
			<img style="margin-right:10px;margin-bottom:10px;float:left;width:50px;height:50px;" src="/<?= $form['file']; ?>"/>
		<? endif; ?>
		<h1><?= $form['name']; ?></h1>
		<p style="clear:both;"><?= $form['description']; ?></p>
		<br /><br />
		<h1>Sections</h1>
		  	<table class= "table table-striped">
		  		<? foreach($formsections as $formsection): ?>
		  		<tr>
		  			<td><?= $formsection['name']; ?></td>
		  			<td>
		  				<form action="/forms/delete_section/<?= $formsection['id']; ?>" style="margin:0px;float:right;">
						<button class="btn btn-xs btn-danger">Delete</button>
						</form>
		  			</td>
		  		</tr>
		  		<? endforeach; ?>
		  	</table>
		  	<br />

		  	<?= $this->Form->create('FormSection', ['type' => 'file', 'action' =>  'add_section'.'/'.$form['id']]); ?>
		  	<?= $this->Form->input('form_id', ['type' => 'hidden', 'value' => $form['id']]); ?>
		  	<?= $this->Form->input('name', ['label' => 'Section Name']); ?>
		  	<button id="color-button" class="btn btn-primary" type="submit">Add Section</button>
		  	<?= $this->Form->end('add'); ?>
	</div>
</section>
<section class="form-preview" style="overflow-y:auto;height:100%;width:50%">
	<? foreach($formsections as $formsection): ?>
	<div style="float:left;margin:10px;padding:10px;width:90%;">
	<h4><?= $formsection['name'];?></h4>
	<? foreach($formitems as $formitem): ?>
	<? if($formitem['form_section_id'] == $formsection['id']): ?>
			<table style="margin:20px;" class="table table-striped">
				<tr>
					<td><?= $formitem['name']; ?></td>
					<td style="width:1px;">
						<form action="/forms/edit_item/<?= $formitem['id']; ?>" style="margin:0px;float:right;">
						<button class="btn btn-xs btn-info">Edit</button>
						</form>
					</td>
					<td style="width:1px;">
						<form action="/forms/delete_item/<?= $formitem['id']; ?>" style="margin:0px;float:right;">
						<button class="btn btn-xs btn-danger">Delete</button>
						</form>
					</td>
				</tr>

				<tr id="formelements">
					<td colspan="1">
						<? foreach($formelements as $formelement): ?>
							<? if($formelement['form_item_id'] == $formitem['id']): ?>
							<table style="width:100%;">
								<tr>
									<td>
									<label><?= $formelement['name']; ?></label>
		  							<?= $formelement['template']; ?>
		  							</td>
		  							<td style="width:1px;">
		  							<form action="/forms/edit_element/<?= $formelement['id']; ?>" style="margin:5px;">
										<button class="btn btn-xs btn-warning">Edit</button>
									</form>
									</td>
									</td>
									<td style="width:1px;">
		  							<form action="/forms/delete_element/<?= $formelement['id']; ?>" style="margin:5px;">
										<button class="btn btn-xs btn-danger">Delete</button>
									</form>
									</td>
								</tr>
		  					</table>
		  					<? endif; ?>
					  	<? endforeach; ?>
					</td>
					<td colspan="2">
						<?= $this->Form->create('FormElement', ['action' =>  'add_element'.'/'.$formitem['id']]); ?>
	  					<?= $this->Form->input('form_item_id', ['type' => 'hidden', 'value' => $formitem['id']]); ?>
	  					<?= $this->Form->input('name', ['label' => 'Name']); ?>
	  					<button id="color-button" class="btn btn-primary" type="submit">Add Form Element</button>
	  					<?= $this->Form->end('add'); ?>
					</td>
				</tr>
				
			</table>
	<? endif; ?>
	<? endforeach; ?>
				<?= $this->Form->create('FormItem', ['action' =>  'add_item'.'/'.$formsection['id']]); ?>
	  					<?= $this->Form->input('form_section_id', ['type' => 'hidden', 'value' => $formsection['id']]); ?>
	  					<?= $this->Form->input('name', ['label' => 'Name']); ?>
	  					<button id="color-button" class="btn btn-primary" type="submit">Add Form Item</button>
	  					<?= $this->Form->end('add'); ?>
	</div>
	<? endforeach; ?>

</section>

<div class="add-section" style="overflow-y:auto;position:fixed;top:48px;right:0px;height:auto;bottom:48px;background:rgba(0,0,0,0.5); width:25%">
	<section id="add-note">

			<?= $this->Flash->render(); ?>
	   	<div id="add-form">
	   	<h3>Edit Form</h3><br />
	    <?= $this->Form->create('Form', ['type' => 'file', 'action' =>  'edit'.'/'.$form['id']]); ?>
	            <?= $this->Form->input('name', ['value' => $form['name']]); ?>
	            <?= $this->Form->input('id', ['value' => $form['id'], 'type' => 'hidden']); ?>
	           	<?= $this->Form->input('description', ['type' => 'textarea', 'style' => 'width:100%;height:300px;', 'value' => $form['description']]); ?>
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
	           <br />
					<button id="color-button" class="btn btn-primary" style="background:<?= $form['color'];?>" type="submit">Save Form</button>
			
	    <?= $this->Form->end(); ?>
	    </div>
	</section>
</div>

<script src="http://netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.js"></script>
<script src="/js/jquery.simplecolorpicker.js"></script>

<script>
$(document).ready(function() {
	//Initiate Color Picker on select[name="color"]
	$('select[name="color"]').simplecolorpicker({theme: 'glyphicons'});

	//Set default color selection
	$('select[name="color"]').simplecolorpicker("selectColor", "<?= $form['color'];?>");

	//Change the info panel background when color is changed
  	$('select[name="color"]').on('change', function() {
    $('#color-info').css('background-color', $('select[name="color"]').val());
    $('#color-button').css('background-color', $('select[name="color"]').val());
  	});
});
</script>