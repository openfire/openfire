 <div class='span8 well well-small'>
    <h2>Signup</h2>
    <form action='' method='post'>
    	<input type='hidden' name='userID' value='<?= $this->user->id ?>'>
    	<input type='hidden' name='inviteID' value='<?= $this->invite->id ?>'>
    
<fieldset>
<label for='username'>Username</label>
<input type='text' name='username' class='input-xlarge' placeholder='No spaces, 256 characters or less.'>
</fieldset>
<fieldset>
<label for='email'>Email</label>
<input type='email' name='email' class='input-xlarge' disabled='disabled' placeholder='Email' value='<?= $this->user->email ?>'>
</fieldset>
<fieldset>
<label for='password'>Password</label>
<input type='password' name='password' class='input-xlarge' >
<label for='password_confirm'>Confirm Password</label>
<input type='password' name='password_confirm' class='input-xlarge' >
</fieldset>
<fieldset>
<label for='firstName'>Name</label>
<input type='text' name='firstName' class='input-xlarge' placeholder='First'><br><input type='text' class='input-xlarge' name='lastName' placeholder='Last'>



</fieldset>
<fieldset class='input-xlarge'>
  <button type='submit' class='btn pull-right'>Sign Up</button>
</fieldset>
</form>

  </div>