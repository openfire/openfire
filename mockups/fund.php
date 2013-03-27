<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/elusive-webfont.css" rel="stylesheet" media="screen">
<link href="/css/style_new.css" rel="stylesheet" media="screen">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> 
<script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>

<script src="/js/bootstrap.min.js"></script>

</head>

<body class='project'>
<div class='container'>
	<!-- Header -->
	<div class='row'>
		<div class='navbar navbar-static-top'>
			<div class='navbar-inner'>
				<a class='brand' href='/'><img src='/img/logo_textual.png' class='logo'></a>
				<ul class="nav">
					<li class='dropdown'>
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Explore <b class='caret'></b></a>
						<ul class='dropdown-menu'>
							<li><a href='/projects'>Browse Projects</a></li>
							<li><a href='/projectCategories'>Project Categories</a></li>
							<li><a href='/goals'>Browse Goals</a></li>

						</ul>
					</li>
					<li class="divider-vertical"></li>
					<li><a href="/create">Create</a></li>
					<li class="divider-vertical"></li>
					<li><a href="/profile">About Us</a></li>
			    </ul>
			    <ul class='nav pull-right'>
					<li class="divider-vertical"></li>

			    	<li>
			    		<form class='navbar-form form-search' action='/search' method='get'>
			    			<input type='text' class='input-medium search-query' name='q'> <button class='btn'type='submit'>Search</button>
			    		</form>
			    	</li>
					<li class="divider-vertical"></li>

<? if(empty($_GET['loggedin'])): ?>

			    	<li class='dropdown' style='margin-left: 2em;'>
			    		<a href="#" class="dropdown-toggle" data-toggle="dropdown">Login <b class="caret"></b></a>
			    		<div class='dropdown-menu' style='padding: 1em; font-size: 0.9em'>
			    			<form action='/login' method='post'>
			    				<fieldset>
			    					<input type='text' name='username' placeholder='Username'>
			    				</fieldset>
			    				<fieldset>
			    					<input type='password' name='password' placeholder='Password'>
			    				</fieldset>

			    					<button class='btn'>Login</button> <a class='btn btn-link' href='/signup'>Signup</a>
			    			</form>
			    			<hr>
<a class='span11 btn btn-info' href='/auth/facebook' style='background: #596F90; margin-top: 0.5em; margin-bottom: 0.5em'><i class='icon-facebook'></i> Log In With Facebook</a><br>
  		<a class='span11 btn btn-info' href='/auth/twitter'><i class='icon-twitter'></i> Log In With Twitter</a>
			    		</div>
			    	</li>
<? else: ?>
			    	<li class='dropdown' style='margin-left: 2em'>
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src='http://assets.openfi.re/images/avatars/openfire_default_avatar.png' class='avatar'> jzellis <b class="caret"></b></a>
			    		<ul class='dropdown-menu'>
			    			<li><a href='/notifications'>Notifications <b>(1)</b></a></li>
			    			<li><a href='/profile'>My Profile</a></li>
			    			<li><a href='/myProjects'>My Projects</a></li>
			    			<li><a href='/logout'>Logout</a></li>
			    		</ul>
			    	</li>
<? endif; ?>
			    </ul>
			</div>
		</div>
	</div>
<!-- /header -->

<!-- Main body -->

<ul class="breadcrumb">
  <li><a href="#">Home</a> <span class="divider">/</span></li>
  <li><a href="#">Projects</a> <span class="divider">/</span></li>
  <li><a href='#'>This Project</a> <span class="divider">/</span></li>
  <li><a href='#'>This Goal</a> <span class="divider">/</span></li>
  <li class='active'>Fund</li>

</ul>
<div class='row'>
	<div class='span12'>
			<h1>Fund This Goal</h1>
	</div>
</div>
<div class='row'>
	<!-- Main Area -->
<div class='span8'>
	<form action='fundingRedirect' method='post'>
		<fieldset>
			<label for='amount'>Funding Amount</label>
			<div class="input-prepend">
  <span class="add-on">$</span>
			<input type='text' name='amount' class='input input-large' value='5' style='font-weight:bold'>
		</div>
		</fieldset>
		<p>Your funding will immediately go to this project.</p>
<fieldset>
	<ul class='rewards unstyled'>
		<h3>Select A Reward</h3>
		<li style='padding-left: .65em; margin-bottom: 1em'><label class='radio'><input type='radio' name='reward' value='' checked='checked'>No Reward</label></li>
		<li class='well well-small'><label class='radio'><div class='row'><div class='span1'><input type='radio' name='reward' value='uuid'><span style='font-size: 1.5em'>$35+</span><div class='label' style='font-weight:bold; text-align:right'>Unlimited</div></div><div class='span10 offset1'>A description of this reward, that is a few sentences or less.</div></label>
		</li>
		<li class='well well-small'><label class='radio'><div class='row'><div class='span1'><input type='radio' name='reward' value='uuid'><span style='font-size: 1.5em'>$45+</span><div class='label label-success' style='font-weight:bold; text-align:right'>10 of 15 left</div></div><div class='span10 offset1'>A description of this reward, that is a few sentences or less. A description of this reward, that is a few sentences or less. A description of this reward, that is a few sentences or less.<br></div></label>
		</li>
		<li class='well well-small'><label class='radio'><div class='row'><div class='span1'><input type='radio' name='reward' value='uuid'><span style='font-size: 1.5em'>$45+</span><div class='label label-warning' style='font-weight:bold; text-align:right'>Only 2 of 15 left</div></div><div class='span10 offset1'>A description of this reward, that is a few sentences or less. A description of this reward, that is a few sentences or less. A description of this reward, that is a few sentences or less.<br></div></label>
		</li>

		<li class='well muted well-small'><label class='radio'><div class='row'><div class='span1'><input type='radio' name='reward' value='uuid' disabled='disabled'><span style='font-size: 1.5em'>$45+</span><div class='label label-important' style='font-weight:bold; text-align:right'>All Gone!</div></div><div class='span10 offset1'>A description of this reward, that is a few sentences or less. A description of this reward, that is a few sentences or less. A description of this reward, that is a few sentences or less.<br></div></label>
		</li>

	</ul>
	<hr>
	<div style='text-align:right'>
		<button class='btn btn-large btn-success'>Continue</button></div>
	</form>
</div>
<!-- /main area -->
<!-- sidebar -->
<div class='span4 sidebar'>
		<div class='well well-small'>
			Openfire's funding is powered by <a href='http://www.wepay.com'><b>WePay</b></a>. Legal text here.
		</div>
	</div>
	<!-- /sidebar -->
</div>
<!-- /main body -->
</div>
<div class='container'>
	<footer class='navbar'>
		<div class='navbar-inner'>
			<a class='brand'><img src='/img/logo.png' style='height:1em'></a>
			<ul class='nav'>
				<li><a href='#'>Privacy Policy</a></li>
				<li><a href='#'>Team</a></li>
				<li><a href='#'>Blog</a></li>
				<li><a href='#'>Contact Us</a></li>
			</ul>
			<div class='navbar-text pull-right'>All content &copy; 2013 openfire.</div>
		</div>
	</footer>
	</div>
</body>

</html>