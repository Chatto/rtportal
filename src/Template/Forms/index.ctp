<div style="width:70%;height:100%;overflow-y:auto;float:left;"><!-- Coaching Input Sheets -->
<? foreach($forms as $form): ?>
<section class="form-section" style="background:<?= $this->Color->hextorgba($form['color'],0.6);?>;width:25%%;height:50%;float:left;overflow-y:auto;padding:10px;">
<div style="position:relative; border: 1px solid red;width: 100%; height:100%;">
<div style="width:100%; max-height:200px;background:rgba(0,0,0,0.2);" class="fade">
<h4 style="background:<?= $form['color']; ?>;padding:5px;"><?= $form['name']; ?></h4>
<div style="width:100%;">
<img style="width:150px;height:150px;display:block;margin-left: auto;margin-right:auto;" src="/<?= $form['file'];?>"/>
</div>
</div>
<p><?= $form['description'];?></p>



   <div style="border:1px solid green;position: absolute; bottom: 0; width: 100%px; height: auto;">
   	<form style="position:absolute:bottom:5px;margin:0px;width:100%;" action="/forms/new_sheet/<?= $form['id']; ?>" method="POST" style="margin:0px;clear:both;">
		<?= $this->Form->input('name'); ?>
		<button class="btn btn-sm" style="color:#FFF;background:<?= $form['color'];?>;" type="submit">Add <?= $form['name'];?></button>
		
	</form>
   </div>
</div>

</section>
<? endforeach; ?>
</div>

<div style="width:30%;height:100%;overflow-y:auto;">
<section id="coaching-process" class="dash-section user_bg_nohover_<?= $authUser['id']; ?>" style="overflow-y:auto;float:right;width:100%;">
<?= $this->Flash->render(); ?>
<? foreach($forms as $form): ?>
		<div style="padding:10px;border-bottom:1px dotted <?= $authUser['color'];?>">
		<? if(!empty($form['file'])): ?>
						<img style="margin-right:20px;float:left;width:100px;height:100px;" src="/<?= $form['file']; ?>"/>
		<? endif; ?>
		<h4><?= $form['name']; ?></h4>
		<p><small><?= $form['description']; ?></small></p>
		
		</div>
<? endforeach; ?>
<? if($authUser['is_admin']): ?>
	<div style="padding:10px;">
		<strong>Form Administration Panel</strong><br />
		<p>Edit form names, descriptions, and templates here, but make sure you know what you're doing!</p>
		<form style="margin:5px;width:100%;" action="/forms/admin_index" style="margin:0px;float:right;">
			<button class="btn btn-warning" style="color:#FFF;" type="submit">Form Admin</button>
		</form>
	</div>
<? endif; ?>
</section>
</div>