<div id="flashmessage">
	<h4 class="alert alert-warning" role="alert"><?= h($message) ?></h4>
</div>
		<script>
		$('#flashmessage').delay(1000).slideUp(600);
		</script>