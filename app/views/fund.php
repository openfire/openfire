<script>
$(function() {
	$('#amount').blur(function(){
		var amount = $('#amount').val();
var available = $(".reward").filter(function() {
    return  parseInt($(this).attr("data-minAmount")) <= parseInt(amount);
});
available.removeClass('muted');
available.find('input[name="rewardUUID"]').removeAttr('disabled');
available.first().find('input[name="rewardUUID"]').attr('checked','checked');

var unavailable = $(".reward").filter(function() {
    return  parseInt($(this).attr("data-minAmount")) > parseInt(amount);
});
unavailable.addClass('muted');
unavailable.find('input[name="rewardUUID"]').attr('disabled','disabled');
unavailable.first().find('input[name="rewardUUID"]').removeAttr('checked');

});
});
</script>
<div class='span 8'>
	<h1>Fund &quot;<?= $this->goal->name ?>&quot;</h1>
	<p>Thanks for funding this goal! Use the form below to choose your funding amount and select your reward (if any).</p><p>Once you fill in this information, you'll be redirected to <a href='http://www.wepay.com'>WePay</a> to complete the transaction.</p>
	<form action='/fundingRedirect' method='post'>
		<input type='hidden' name='goalUUID' value='<?= $this->goal->uuid ?>'>
 		<fieldset>
			<label for='amount'>Funding Amount</label>
			<div class="input-prepend input-append">
  <span class="add-on">$</span><input type='text' style='text-align:right' class='span1' id='amount' name='amount' value='<? if(!empty($this->goal->minAmount) && empty($this->amount)): echo $this->goal->minAmount; elseif(!empty($this->amount)): echo $this->amount; else: echo "5"; endif; ?>'><span class="add-on">.00</span>
</div>
		</fieldset>
		<? if(!empty($this->goal->rewards)): ?>
	<legend>Rewards</legend>
	<fieldset>
		<? foreach($this->goal->rewards as $reward): ?>
		<div class='well well-small reward <? if(!empty($this->amount) && $reward->minAmount > $this->amount): ?>muted<? endif; ?>' id = '<?= $reward->uuid ?>' data-minAmount = '<?= $reward->minAmount ?>'>

					<h3><input type='radio' <? if(!empty($this->amount) && $reward->minAmount < $this->amount): ?>disabled='disabled'<? endif; ?> <? if(!empty($this->amount) && $reward->minAmount == $this->amount): ?>checked='checked'<? endif; ?> name='rewardUUID' value='<?= $reward->uuid ?>'>  $<?= $reward->minAmount ?>: <?= $reward->name ?></h3>
					<div><?= $reward->description ?></div>

		</div>
	<? endforeach; ?>
	</fieldset>

<? endif; ?>
<div class='form-actions'>
	<button type='submit'>Fund This Goal</button>
</div>
	</form>
</div>