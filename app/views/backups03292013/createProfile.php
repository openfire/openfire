<div class='span8 offset2' style='margin-top:2em'>
<? if(!empty($this->params['doesExist'])): ?>
 <div class='alert'>There is already a user with that username. Are you sure you don't already have an account? If so, you can already <a href='/login'>log in</a>.</div>
<? endif; ?>
<h2>Almost Done!</h2>
<h3>We just need you to give us a little bit more info about yourself.</h3>
    <form action='' method='post' data-validate="parsley">
    	<div class='row-fluid'>
    		<div class='span6'>
    			<h1 style='color:red'>!!! Required !!!</h1>
<input type='hidden' name='avatar' value='<?= $this->params['avatar'] ?>'>
<input type='hidden' name='type' value='<?= $this->params['type'] ?>'>

<input type='hidden' name='token' value='<?= $this->params['token'] ?>'>
<? if($this->params['type'] == "twitter"): ?>
<input type='hidden' name='secret' value='<?= $this->params['secret'] ?>'>
<? endif; ?>
    
<fieldset>
<label for='username'>Username</label>
<input type='text' name='username' class='input-xlarge' data-type='alphanum' data-required='true' data-error-message='Invalid username' value='<?= $this->params['username'] ?>'>
</fieldset>
<fieldset>
<label for='email'>Email</label>
<input type='email' name='email' data-required='true' data-remote="/ajax/checkEmail" class='input-xlarge' placeholder='Email'>
</fieldset>
<fieldset>
<label for='password'>Password</label>
<input type='password' id='tpassword' data-required='true' name='password' class='input-xlarge'>
<label for='password_confirm'>Confirm Password</label>
<input type='password' id='password_confirm' name='password_confirm' class='input-xlarge' data-required='true' data-equalto='#tpassword' data-error-message='Passwords must match.'>
</fieldset>
<fieldset>
<label for='firstName'>Name</label>
<input type='text' name='firstName' class='input-xlarge'  data-required='true' placeholder='First' value='<?= $this->params['firstName'] ?>'><br><input type='text' class='input-xlarge' name='lastName'  data-required='true' placeholder='Last' value='<?= $this->params['lastName'] ?>'>
</fieldset>
</div>
<div class='span6'>
<h1 style='color:red'>!!! Optional !!!</h1>
<fieldset>
<label for='location'>Location</label>
<input type='text' name='location' class='input-xlarge' value='<?= $this->params['location'] ?>'>
</fieldset>
<fieldset>
<label for='bio'>Bio</label>
<textarea name='bio' class='input-xlarge' rows='5'><?= $this->params['bio'] ?></textarea>
</fieldset>
</div>
</div>
<fieldset class='input-xlarge'>
  <button type='submit' class='btn pull-right'>Complete Signup</button>
</fieldset>
</form>
</div>