
<section style="display:inline;width:25%;background:rgba(0,0,0.0.5);float:right;">
<?= $this->Flash->render(); ?>
	<table class="table table-striped">
		<tr>
			<td><strong>Entity Name: </strong></td>
			<td><?= $sheet['name']; ?></td>
		</tr>
		<tr>
			<td><strong>Authors: </strong></td>
			<td>
				<ul>
				<? foreach($form['users'] as $author): ?>
				<li><?= $author['full_name']; ?></li>
				<? endforeach; ?>
				</ul>
			</td>
		</tr>
		<tr>
			<td colspan="2"><form action="/forms/view_sheet/<?= $sheet['id'];?>" target="_blank" style="margin:0px;">
					<button class="btn btn-info" style="color:#FFF;" type="submit">Preview & Print</button>
				</form>
			</td>
		</tr>
	</table>
</section>
<section class="form-preview" style="overflow-y:auto;height:100%;width:75%;">
	<? foreach($formsections as $formsection): ?>
	<div style="margin:0px;padding:10px;width:90%;">
	<h4><?= $formsection['name'];?></h4>
	<? foreach($formitems as $formitem): ?>
	<? if($formitem['form_section_id'] == $formsection['id']): ?>
	<a name="<?= $formitem['name']; ?>"></a>
			<table style="margin:20px;" class="table table-striped">
				<tr>
					<td><?= $formitem['name']; ?></td>
				</tr>

				<tr id="formelements">
					<td colspan="1">
							<div style="width:50%;float:right;">
							<? foreach($formelements as $formelement): ?>
								<? if($formelement['form_item_id'] == $formitem['id']): ?>
										<form action="/forms/add_sheetitem/<?= $sheet['id']; ?>/<?= $formitem['id']; ?>" method="POST" style="width:100%;margin:10px;" enctype="multipart/form-data">
										<?= $formelement['template'];?>
										<?= $this->Form->input('formelement_id', ['type' => 'hidden', 'value' => $formelement['id']]); ?>
										<button class="btn" style="color:#FFF;background:<?= $form['color']; ?>;" type="submit">Add <?= $formelement['name']; ?></button>
										</form>
		  							
		  						<? endif; ?>
					  		<? endforeach; ?>
					  		</div>
					  		<div style="width:50%;float:left;">
									<? foreach($sheetitems as $sheetitem): ?>
									<? if($sheetitem['form_items_id'] == $formitem['id']): ?>
										<?= $sheetitem['content'] ?>
									<? endif; ?>
									<? endforeach; ?>
							</div>
								
					</td>
				</tr>
				
			</table>
	<? endif; ?>
	<? endforeach; ?>
	</div>
	<? endforeach; ?>
</section>
