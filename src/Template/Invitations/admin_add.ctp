<div class="container">
              <header>
                <h2>Rising Tide Invitations</h2>
              </header>
	<div class="form">
    <?= $this->Form->create('Invitation') ?>
            <p>To send out an invite, please enter an email to send an invite link to.</p>
            <small>Your email address</small>
            <?= $this->Form->input('email', ['placeholder' => 'finn@gmail.com']) ?>
    <?= $this->Form->button(__('Send Invite')); ?>
    <?= $this->Form->end() ?>
	</div>
</div>
