 <div class='span8' style='margin-top: 2em; margin-bottom: 2em'>
    <h2>Create Account</h2>
    <form action='' method='post' data-validate="parsley">
    
<fieldset>
<label for='username'>Username</label>
<input type='text' name='username' class='input-xlarge' data-type='alphanum' data-required='true' data-error-message='Invalid username'>
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
<input type='text' name='firstName' class='input-xlarge'  data-required='true' placeholder='First'><br><input type='text' class='input-xlarge' name='lastName'  data-required='true' placeholder='Last'>



</fieldset>
<fieldset class='input-xlarge'>
  <button type='submit' class='btn pull-right'>Sign Up</button>
</fieldset>
</form>

  </div>
