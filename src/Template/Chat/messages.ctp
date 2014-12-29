[
<? foreach ($chatMessages as $chatMessage): ?>
{<?= $chatMessage['created']; ?>},
{<?= $chatMessage['message']; ?>}
<? debug($chatMessage);?>
<? endforeach; ?>
]

