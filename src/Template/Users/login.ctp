<div class="container">
	<div class="logo">
		<img src="/img/logo.svg" alt="logo"/>
		<h2>Rising Tide Team</h2>
	</div>
	<div class="login">
		<h1>Portal Login</h1>
		<?= $this->Form->create() ?>
		<?= $this->Form->input('username', ['label' => 'Username']) ?>
		<?= $this->Form->input('password', ['label' => 'Password', 'type' => 'password']) ?>
		<br />
		<div style="width:100%;">
					<br />
					<a href="/users/forgot" class="btn btn-sm btn-warning" style="color:#FFF;text-decoration:none;float:right;margin-left:20px;">Forgot Password?</a>
					<button class="btn btn-sm btn-primary" style="float:right;" type="submit">Login</button>
		</div>
		<?= $this->Form->end() ?>
		
	</div>
</div>