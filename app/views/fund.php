<? $project = new Project($this->goal->projectID) ?>
<div class='fund span8 offset2'>
<h1>Fund <a href='/goals/<?= $this->goal->uuid ?>'>&quot;<?= $this->goal->name ?>&quot;</a></h1>
<p>Openfire's payments are processed by <a href='http://www.wepay.com'>WePay</a>, and we never see or retain your credit card information. Your card will be immediately charged upon submission of payment.</p>
<form action='/fundingRedirect' method='post'>
    <input type='hidden' name='goalUUID' value='<?= $this->goal->uuid ?>'>
<fieldset>
    <label for='amount'><b>Funding Amount</b></label>
    <div class="input-prepend">
  <span class="add-on">$</span>
  <input class="input-xlarge" type="text" name='amount' id='amount' placeholder="$5 Minimum Pledge" value='<?= $this->goal->suggestedAmount ?>'>
</div>
<br>
</fieldset>
<fieldset>
<h3>Rewards</h3>
<p>If you select a reward higher than the amount you've entered, the amount will change to reflect the reward amount.</p>
<fieldset>
    <label class='radio reward'><input type='radio' name='rewardUUID' value='0' checked='checked'data-amount='<?= $this->goal->suggestedAmount ?>'> <h4><b>No Reward</b></h4></label>
    <hr>
    <? foreach($this->goal->rewards as $reward): ?><label class='radio reward'>
        <input type='radio' name='rewardUUID' value='<?= $reward->id ?>' data-amount='<?= $reward->minAmount ?>'><h4><b>$<?= $reward->minAmount ?></b> <?= $reward->name ?></h4>
        <?= nl2br($reward->description) ?>
    </label>
    <hr>
 <? endforeach; ?>
</fieldset>
<fieldset style='text-align:center'>
    <button type='submit' class='btn btn-large btn-success requiresLogin'>Continue</button>
</form>

</div>
<script>
$(function() {
    $('input[type="radio"]').change(function(){
        if(parseInt($('input[name="amount"]').val()) < $(this).attr('data-amount')){
        $('input[name="amount"]').val($(this).attr('data-amount'));
    }
    });
});
</script>
