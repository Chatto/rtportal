<? if($user['status'] == "online"): ?>
		<img class="badge" src="/img/theme/icons/statuses/online.svg" alt="online"/>
	<? elseif($user['status'] == "away"): ?>
		<img class="badge" src="/img/theme/icons/statuses/away.svg" alt="away"/>
	<? elseif($user['status'] == "busy"): ?>
		<img class="badge" src="/img/theme/icons/statuses/busy.svg" alt="busy"/>
	<? elseif($user['status'] == "offline"): ?>
		<img class="badge" src="/img/theme/icons/statuses/offline.svg" alt="offline"/>
<? endif; ?>