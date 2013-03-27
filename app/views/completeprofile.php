<div class='span8 offset2 well well-small'>

<h2>Almost Done!</h2>

<p>We just need a couple of more details from you to complete your profile.

<form action='' method='post' data-validate='parsley'>
	<? if(empty($this->user->email)): ?>
	<fieldset>
		<label for='email'>Email</label>
		<input type='email' name='email' class='input-xxlarge' data-required='true' data-error-message='You must enter a valid email address.'>
	</fieldset>
	<? endif; ?>
	<? if(empty($this->user->firstName)): ?>
	<fieldset>
		<label for='firstName'>First Name</label>
		<input type='text' name='firstName' class='input-xxlarge' data-required='true' data-error-message='You must enter your first name.'>
	</fieldset>
	<? endif; ?>
	<? if(empty($this->user->lastName)): ?>
	<fieldset>
		<label for='lastName'>Last Name</label>
		<input type='text' name='lastName' class='input-xxlarge'  data-required='true' data-error-message='You must enter your last name.'>
	</fieldset>
	<? endif; ?>

	<? if(empty($this->user->password)): ?>
	<fieldset>
		<label for='password'>Password</label>
		<input type='password' id='tPassword' name='password' class='input-xxlarge' data-required='true' data-error-message='You must enter a password.'>
	</fieldset>
	<fieldset>
	<label for='passwordconfirm'>Password</label>
	<input type='password' name='passwordconfirm' class='input-xxlarge' data-required='true' data-error-message='Your passwords must match.' data-equalto='#tPassword'>
	</fieldset>
	<? endif; ?>



	<div class='form-actions'>
		<button type='submit' class='btn btn-success'>Update</button>
	</div>

</form>

</div>