<div class='span8 offset2 well well-small'>

<h2>Almost Done!</h2>

<p>We just need a couple of more details from you to complete your profile.

<form action='' method='post'>
	<? if(empty($this->user->email)): ?>
	<fieldset>
		<label for='email'>Email</label>
		<input type='email' name='email' class='input-xxlarge'>
	</fieldset>
	<? endif; ?>
	<? if(empty($this->user->firstName)): ?>
	<fieldset>
		<label for='firstName'>First Name</label>
		<input type='text' name='firstName' class='input-xxlarge'>
	</fieldset>
	<? endif; ?>
	<? if(empty($this->user->lastName)): ?>
	<fieldset>
		<label for='lastName'>Last Name</label>
		<input type='text' name='lastName' class='input-xxlarge'>
	</fieldset>
	<? endif; ?>

	<? if(empty($this->user->password)): ?>
	<fieldset>
		<label for='password'>Password</label>
		<input type='password' name='password' class='input-xxlarge'>
	</fieldset>
	<fieldset>
	<label for='passwordconfirm'>Password</label>
	<input type='password' name='passwordconfirm' class='input-xxlarge'>
	<span class='help-block'>A password is optional, but if you don't have one you'll only be able to login using the Facebook or Twitter account you've linked to your openfire account.</span>
	</fieldset>
	<? endif; ?>



	<div class='form-actions'>
		<button type='submit' class='btn btn-success'>Update</button>
	</div>

</form>

</div>