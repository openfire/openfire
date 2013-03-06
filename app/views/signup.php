 <div class='span8 well well-small'>
    <h2>Signup</h2>
    <form action='' method='post' data-validate="parsley">

    
<fieldset>
<label for='username'>Username</label>
<input type='text' name='username' class='input-xlarge' data-required='true' data-type='alphanum' data-notblank='true' data-error-message="Totally invalid username." data-trigger='blur'>
</fieldset>
<fieldset>
<label for='email'>Email</label>
<input type='email' name='email' data-type='email' class='input-xlarge' placeholder='Email' data-trigger='blur' data-remote='/ajax/checkEmail'>
</fieldset>
<fieldset>
<label for='password'>Password</label>
<input type='password' id='password' name='password' class='input-xlarge'>
<label for='password_confirm'>Confirm Password</label>
<input type='password' id='password_confirm' name='password_confirm' class='input-xlarge' data-equalto='#password'>
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