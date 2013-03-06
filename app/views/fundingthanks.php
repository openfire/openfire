<? global $user; ?>
<div class='span6 offset3'>
	<h2>Thanks!</h2>

	<p>Your contribution of <b>$<?= $this->amount ?></b> has been successfully processed. You are super awesome.</p>
	<p><a href='/goals/<?= $this->goal->uuid ?>'>Return to goal</a></p>
</div>