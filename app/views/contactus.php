<? global $user; ?>
<div class='span8 offset2'>
	<h1>Contact Us</h1>
<form action='' method='post'>

	<fieldset>
		<label for='name'>Your Name</label>
		<input type='text' class='input-xxlarge' name='name' <? if(!empty($user->fullName)) echo "value='$user->fullName'"; ?>>
	</fieldset>
	<fieldset>
		<label for='email'>Your Email</label>
		<input type='email' class='input-xxlarge' name='email' <? if(!empty($user->email)) echo "value='$user->email'"; ?>>
	</fieldset>
	<fieldset>
		<label for='body'>Your Message</label>
		<textarea class='input-block-level' style='height: 12em'name='body'></textarea>
	</fieldset>
	<div class='form-actions'>
		<button class='btn' type='submit'>Contact Us</button>
</form>
</div>