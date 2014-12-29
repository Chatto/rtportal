<section class="form-preview" style="overflow-y:auto;overflow-x:none;height:auto;width:100%;">
	<table class="table table-striped">
		<tr>
			<td style="background:<?= $form['color']; ?>"><h1><?= $sheet['name']; ?></h1></td>
		</tr>
		<tr>
			<td><strong>Prepared by: </strong><?= $author['full_name']; ?></td>
		</tr>
		<tr>
			<td><strong>Prepared for: </strong><?= $foruser['full_name']; ?></td>
		</tr>
	</table>
	<? foreach($formsections as $formsection): ?>
	<div style="float:left;margin:0px;padding:10px;width:95%;">
	<h2><?= $formsection['name'];?></h2>
	<? foreach($formitems as $formitem): ?>
	<? if($formitem['form_section_id'] == $formsection['id']): ?>
	<h3><a name="<?= $formitem['name']; ?>"></a></h3>
			<table style="margin:20px;" class="table table-striped">
				<tr>
					<td colspan="2"><h4><?= $formitem['name']; ?></h4></td>
				</tr>

				<tr id="formelements">
					<td colspan="1">
							<div style="width:100%;float:right;">
							<? foreach($formelements as $formelement): ?>
								<? if($formelement['form_item_id'] == $formitem['id']): ?>
										<? if($formelement['name'] == 'Files'): ?>
										<table class="table table-striped">
											<? foreach($files as $file): ?>
												<tr>
													<td>
														<? if(in_array($file['type'], ['image/jpg', 'image/jpeg', 'image/png', 'image/gif', 'image/svg+xml'])): ?>
														<img style="width:48px;height:48px;" src="/<?= $file['url'];?>" />
														<? endif; ?>
													<td><a href="/<?= $file['url']; ?>" target="_blank"><?= $file['name']; ?></a></td>
													<td><?= $file['size']; ?> bytes</td>


											<? endforeach; ?>
										</table>
										<? endif; ?>
		  							
		  						<? endif; ?>
					  		<? endforeach; ?>
					  		</div>
					  		<div style="width:100%;float:left;font-size:10pt;background:#CCC;">
									<? foreach($sheetitems as $sheetitem): ?>
									<? if($sheetitem['form_items_id'] == $formitem['id']): ?>
										<div style="margin:10px;"><?= $sheetitem['content'] ?></div>
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
