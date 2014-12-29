<section class="form-preview" style="overflow-y:auto;height:100%;width:75%">
	<table style="width:100%;height:100%;padding:0px;">
		<thead>
			<tr>
				<td>
					<h4 style="padding:5px;background:rgba(150,0,150,0.5);">Form Template:</h4>
				</td>
				<td>
					<h4 style="padding:5px;background:rgba(0,150,150,0.5);">View Template:</h4>
				</td>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<div id="editor" class="editor" style=""><?= htmlspecialchars($formelement['template']); ?></div>
					<script src="/js/ace-builds/src-noconflict/ace.js" type="text/javascript" charset="utf-8"></script>
					<script>
						var formtemplate = "<? $formelement['template']; ?>";
					    var editor = ace.edit("editor");
					    editor.setTheme("ace/theme/monokai");
					    editor.getSession().setMode("ace/mode/html");
					    editor.getSession().setUseWrapMode(true);
					    editor.getSession().on('change', function(e) {
						    document.getElementById('template').value = editor.getValue();
						});
						editor.commands.addCommand({
						name: 'saveFile',
						bindKey: {
						win: 'Ctrl-S',
						mac: 'Command-S',
						sender: 'editor|cli'
						},
						exec: function(env, args, request) {
						$("#save").click();
						}
						});
					</script>
				</td>
				<td>
					<div id="editor2" class="editor" style=""><?= htmlspecialchars($formelement['view_template']); ?></div>
					<script>
					    var editor2 = ace.edit("editor2");
					    editor2.setTheme("ace/theme/monokai");
					    editor2.getSession().setMode("ace/mode/html");
					    editor2.getSession().setUseWrapMode(true);
					    editor2.getSession().on('change', function(e) {
						    document.getElementById('view-template').value = editor2.getValue();
						});
						editor2.commands.addCommand({
						name: 'saveFile',
						bindKey: {
						win: 'Ctrl-S',
						mac: 'Command-S',
						sender: 'editor|cli'
						},
						exec: function(env, args, request) {
						$("#save").click();
						}
						});
					</script>
				</td>
			</tr>
		</tbody>
	</table>	
</section>



<div class="add-section" style="overflow-y:auto;position:fixed;top:48px;right:0px;height:auto;bottom:48px;background:rgba(0,0,0,0.5); width:25%">
	<section id="add-note" style="padding:20px;">
		<div id="flashmessage">
		<?= $this->Flash->render(); ?>
		</div>
		<script>
		$('#flashmessage').delay( 800 ).slideUp(400);
		</script>
		<?= $this->Form->create('FormElement', ['action' =>  'edit_element'.'/'.$formelement['id']]); ?>
		<?= $this->Form->input('id', ['type' => 'hidden', 'value' => $formelement['id']]); ?>
	  	<?= $this->Form->input('name', ['label' => 'Name', 'value' => $formelement['name']]); ?>
	  	<?= $this->Form->input('template', ['label' => '', 'type' => 'textarea', 'style' => 'display:none;', 'value' => $formelement['template']]); ?>
	  	<?= $this->Form->input('view_template', ['label' => '', 'type' => 'textarea', 'style' => 'display:none;', 'value' => $formelement['view_template']]); ?>
	  	<button id="save" class="btn btn-primary" type="submit" method="POST">Save</button>
	  	<?= $this->Form->end(); ?>
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
	}
});

</script>