	<form action='/login' method='post'>
  		<input type='text' class='input-xlarge' name='login' placeholder='Login'><br>
  		<input type='password' class='input-xlarge' name='password' placeholder='Password'><br>
  		<button class='btn btn-small' type='submit'>Login</button> or <a href='/signup' class='btn btn-info'>Signup</a><br>
      <hr>
      <p><small>You can also create an openfire account using your Facebook or Twitter account. If you've already used one of these to create an account, please use the same service to log in.</small></p>
  		<a class='btn btn-info' href='/auth/facebook' style='background: #596F90; margin-top: 0.5em; margin-bottom: 0.5em'><i class='icon-facebook'></i> Log In With Facebook</a><br>
  		<a class='btn btn-info' href='/auth/twitter'><i class='icon-twitter'></i> Log In With Twitter</a>
<hr class='clearfix'>
<!-- <button class='btn btn-info btn-small'><i class='icon-twitter'></i> Login With Twitter</button>
<button class='btn btn-info btn-small'><i class='icon-facebook'></i> Login With Facebook</button>
 --></form>