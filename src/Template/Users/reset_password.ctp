<div class="container">
<?= $this->Flash->render(); ?>
	<div class="logo">
		<img src="/img/logo.svg" alt="logo"/>
		<h2>Automatic Building Controls</h2>
	</div>
	<div class="login">
		<h1>Password Reset</h1>
		<?= $this->Form->create('User') ?>
		<?= $this->Form->input('password', ['label' => 'password', 'type' => 'password']) ?>
		<br />
		<div style="width:100%;">
					<button class="btn btn-sm btn-primary" style="float:right;" type="submit">Reset Password</button>
		</div>
		<?= $this->Form->end() ?>
	</div>
</div>