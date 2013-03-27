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
<body>
<div class='container-fluid'>
	<!-- Header -->
	<div class='row-fluid'>
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
	<div class='row-fluid'>
		<!-- Splash -->
		<div class='hero-unit splash'>
			<div class='span1'><img src='/img/logo.png' class='span12'></div>
			<div class='span11'><h2 style='line-height: 1em; margin-top: 0; padding-top:0'><b>openfire</b> is a crowdfunding platform for long-term, socially valuable projects. <a href='/about'>Learn more about us.</a></h2></div>
			<div class='clearfix'></div>
		</div>
		<!-- /splash -->
</div>
<div class='row-fluid'>
		<!-- Main area -->
<div class='span12'>
		<div class='span8 primary'>
			<div class='featuredProjects'>
				<h2>Featured Projects</h2>
				<ul class='thumbnails'>
					<li class='project span4 well well-small'>
						<img src='http://lorempixel.com/640/480'>
						<h3><a href='/projects/project-name'>Project Name</a></h3>
						<div class='summary'>
							This is a summary of the project. It's 60 words or less. This can be longer or shorter, who knows how long it will be? But less than 60 words.
						</div>
												<hr>
						<ul class='stats unstyled'>
							<li><b>Creator:</b> <a href='/'>Joshua Ellis</a></li>
							<li><b>Launched: </b> February 13, 2013</li>
							<li><b>Funds Raised:</b> $4675</li>
						</ul>
					</li>
					<li class='project span4 well well-small'>
						<img src='http://lorempixel.com/640/480'>
						<h3><a href='/projects/project-name'>Project Name</a></h3>
						<div class='summary'>
							Pellentesque non nulla sit amet arcu vulputate tincidunt. Vivamus ac purus quis ligula tempus malesuada. Suspendisse enim ipsum, fringilla sed posuere ut, vulputate ac enim. Cras in tellus lectus, eu rhoncus arcu. In.
						</div>
												<hr>
						<ul class='stats unstyled'>
							<li><b>Creator:</b> <a href='/'>Joshua Ellis</a></li>
							<li><b>Launched: </b> February 13, 2013</li>
							<li><b>Funds Raised:</b> $4675</li>
						</ul>
					</li>
					<li class='project span4 well well-small'>
						<img src='http://lorempixel.com/640/480'>
						<h3><a href='/projects/project-name'>Project Name</a></h3>
						<hr>
						<div class='summary'>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque tincidunt justo ac viverra. Morbi vel velit risus. Nunc commodo convallis elit, et interdum arcu ultrices convallis. Pellentesque non nulla sit...
						</div>
						<hr>
						<ul class='stats unstyled'>
							<li><b>Creator:</b> <a href='/'>Joshua Ellis</a></li>
							<li><b>Launched: </b> February 13, 2013</li>
							<li><b>Funds Raised:</b> $4675</li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
		<!-- / main page -->
		<!-- sidebar -->
		<div class='span3 offset1 sidebar'>
			<div class='widget'>
			<h2>Project Categories</h2>
				<ul class='nav nav-pills nav-stacked'>
					<li><a href='/projects/categories/environmental'>Environment</a></li>
					<li><a href='/projects/categories/environmental'>Social</a></li>
					<li><a href='/projects/categories/environmental'>Technology</a></li>
					<li><a href='/projects/categories/environmental'>Sustainability</a></li>
					<li><a href='/projects/categories/environmental'>Urban</a></li>
					<li><a href='/projects/categories/environmental'>Education</a></li>

				</ul>
			</div>
		</div>
		<!-- /sidebar -->
	</div>
</div>
<hr>
<div class='row-fluid'>
	<div class='span12 featuredGoals'>
		<h2>Featured Goals</h2>
		<ul class='thumbnails'>
							<li class='project span4 well well-small'>
						<img src='http://lorempixel.com/640/480'>
						<h3><a href='#'>To Build A Well Somewhere In Africa</a></h3>
						<div class='summary'>
							Pellentesque non nulla sit amet arcu vulputate tincidunt. Vivamus ac purus quis ligula tempus malesuada. Suspendisse enim ipsum, fringilla sed posuere ut, vulputate ac enim. Cras in tellus lectus, eu rhoncus arcu. In.
						</div>
												<hr>
												<div class="progress">
  <div class="bar bar-success" style="width: 71.2%;"></div>
</div>
						<ul class='stats'>
							<li><b>$5000</b><br>goal</li>
												<li class="divider-vertical"></li>

							<li><b>$3560</b><br> raised</li>
												<li class="divider-vertical"></li>
							<li><b>18</b><br> backers</li>
												<li class="divider-vertical"></li>
							<li><b>24</b><br> days left</li>
						</ul>
					</li>
							<li class='project span4 well well-small'>
						<img src='http://lorempixel.com/640/480'>
						<h3><a href='#'>Another Goal Title Entirely</a></h3>
						<div class='summary'>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque tincidunt justo ac viverra. Morbi vel velit risus. Nunc commodo convallis elit, et interdum arcu ultrices convallis. Pellentesque non nulla sit amet arcu vulputate tincidunt. Vivamus ac purus quis ligula tempus malesuada. Suspendisse enim ipsum, fringilla sed posuere ut, vulputate...
													</div>
												<hr>
												<div class="progress">
  <div class="bar bar-success" style="width: 71.2%;"></div>
</div>
						<ul class='stats'>
							<li><b>$5000</b><br>goal</li>
												<li class="divider-vertical"></li>

							<li><b>$3560</b><br> raised</li>
												<li class="divider-vertical"></li>
							<li><b>18</b><br> backers</li>
												<li class="divider-vertical"></li>
							<li><b>24</b><br> days left</li>
						</ul>
					</li>
							<li class='project span4 well well-small'>
						<img src='http://lorempixel.com/640/480/'>
						<h3><a href='#'>A Really Stupidly Long Title For A Goal Because People Are Dumb</a></h3>
						<div class='summary'>
							Pellentesque non nulla sit amet arcu vulputate tincidunt. Vivamus ac purus quis ligula tempus malesuada. Suspendisse enim ipsum, fringilla sed posuere ut, vulputate ac enim. Cras in tellus lectus, eu rhoncus arcu. In.
						</div>
												<hr>
												<div class="progress">
  <div class="bar bar-success" style="width: 71.2%;"></div>
</div>
						<ul class='stats'>
							<li><b>$5000</b><br>goal</li>
												<li class="divider-vertical"></li>

							<li><b>$3560</b><br> raised</li>
												<li class="divider-vertical"></li>
							<li><b>18</b><br> backers</li>
												<li class="divider-vertical"></li>
							<li><b>24</b><br> days left</li>
						</ul>
					</li>
		</ul>
	</div>
</div>
<!-- /main body -->
</div>
<div class='container-fluid'>
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