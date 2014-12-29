<? foreach ($chatMessages as $chatMessage): ?>
<? //debug($chatMessage); ?>
	[<?= json_encode($chatMessage); ?>]
<? endforeach; ?>