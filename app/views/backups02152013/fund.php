<script>


function stripeResponseHandler(status, response) {
    if (response.error) {
        $(".payment-errors").html("<b>Warning:</b> " + response.error.message);
        $(".payment-errors").show();

    } else {
        var form$ = $("#payment-form");
        // token contains id, last4, and card type
        var token = response['id'];
        // insert the token into the form so it gets submitted to the server
        form$.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
        // and submit
        form$.get(0).submit();
    }
}

$(function() {

Stripe.setPublishableKey("<?= STRIPE_PUBLIC_KEY ?>");

$('#payment-form').submit(function(event) {
    // Disable the submit button to prevent repeated clicks
    $('.submit-button').prop('disabled', true);

    Stripe.createToken({
      number: $('.card-number').val(),
      name: $('.card-name').val(),
      cvc: $('.card-cvc').val(),
      exp_month: $('.card-expiry-month').val(),
      exp_year: $('.card-expiry-year').val()
    }, stripeResponseHandler);

    // Prevent the form from submitting with the default action
    return false;
  });

});
</script>
<div class='span8 well well-small'>
	<h2>Fund Goal: "<?= $this->goal->name ?>"</h2><br>
	<form id='payment-form' action='' method='post'>
		<input type='hidden' name='goalUUID' value='<?= $this->goal->uuid ?>'>
		<fieldset>
			<label for='amount'>Amount</label>
		<div class="input-prepend input-append">
  <span class="add-on">$</span>
  <input name='amount' type="text" style='text-align:right; width: 6em' value='<?= $this->goal->suggestedAmount ?>'>
  <span class="add-on">.00</span>
</div>
<span class="help-inline"><? if($this->goal->targetType == "complete"): ?>Your credit card will be charged only if this project meets its funding goal by its target date.<? else: ?>Your credit card will be charged immediately for this amount.<? endif; ?></span>
		</fieldset>
		<hr>
		<fieldset>
			<label for='ccName'>Credit Cardholder Name</label>
			<input type='text' id='ccName' class='card-name input-xxlarge'>
		</fieldset>
		<fieldset>
			<label for='ccNum'>Credit Card Number</label>
			<input type='text' class='input-xxlarge card-number'>
		</fieldset>
		<fieldset>
			<label for='expMonth'>Expiration Date</label>
			<select id='expMonth' class='card-expiry-month' style='width: 5em'>
				<? for($i = 1; $i < 13; $i++): ?>
				<option value="<?= sprintf("%02d", $i) ?>"><?= sprintf("%02d", $i) ?></option>
			<? endfor; ?>
			</select> 			<select id='expYear' class='card-expiry-year' style='width: 5em'>
				<? for($i = 0; $i < 21; $i++): ?>
				<option value="<?= date("Y") + $i ?>"><?= date("Y") + $i ?></option>
			<? endfor; ?>
			</select>
		</fieldset>
				<fieldset>
			<label for='CVC'>CVC/CVS Number</label>
			<input type='text' id='CVC' class='card-cvc' style='width: 5em'>
		</fieldset>
		<div class='payment-errors alert alert-error' style='display:none'></div>
		<div class="form-actions">

  <button type="submit" class="btn btn-primary">Submit</button>
  <button type="button" class="btn">Cancel</button>
</div>
	</form>

</div>
<div class='span4'>
	<h3>Thanks for funding this goal!</h3> <p>[insert explanatory text here.]</p>	
	</div>