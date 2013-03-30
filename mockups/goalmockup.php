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

<ul class="breadcrumb">
  <li><a href="#">Home</a> <span class="divider">/</span></li>
  <li><a href="#">Projects</a> <span class="divider">/</span></li>
  <li class="active">This Project</li>
</ul>

<div class='row-fluid'>
	<div class='goal span8'	>
				<h2>This Goal's Long And Annoying Title</h2>
<br>

<div class='media'>
			<iframe width="560" height="315" src="http://www.youtube.com/embed/ZBAGEeOms-8?rel=0" frameborder="0" allowfullscreen></iframe>
</div>

		<div class='share well well-small'>
	<h4 style='display:inline-block; margin-top: 0.5em; margin-right: 1em !important'><i class='icon-share'></i> Share</h4>
<a class='btn btn-info'><i class='icon-twitter'></i> Twitter</a> <a class='btn btn-info' style='background: #596F90'><i class='icon-facebook'></i> Facebook</a> <a class='btn'><i class='icon-googleplus' style='color: #d34836'></i> Google+</a> <a class='btn'><i class='icon-envelope'></i> Email</a>
</div>





				<div class='summary'>
					<h4>Summary</h4>
				<p>Goodbye, friends. I never thought I'd die like this. But I always really hoped. THE BIG BRAIN AM WINNING AGAIN! I AM THE GREETEST! NOW I AM LEAVING EARTH, FOR NO RAISEN! And I'd do it again! And perhaps a third time! But that would be it. Ooh, name it after me!</p>
				<p>Kif might! Oh, you're a dollar naughtier than most. OK, this has gotta stop. I'm going to remind Fry of his humanity the way only a woman can.</p>
				<p>No, no, no! Yes, yes. A bit. But she's got a wart. Now, look here, my good man. He hasn't got shit all over him. Listen. Strange women lying in ponds distributing swords is no basis for a system of government. Supreme executive power derives from a mandate from the masses, not from some farcical aquatic ceremony.</p>
			</div>



				<hr>
				<div class='description'>
<p>I don't want to talk to you no more, you empty-headed animal food trough water! I fart in your general direction! Your mother was a hamster and your father smelt of elderberries! Now leave before I am forced to taunt you a second time! She looks like one. Listen. Strange women lying in ponds distributing swords is no basis for a system of government. Supreme executive power derives from a mandate from the masses, not from some farcical aquatic ceremony. And the hat. She's a witch! Look, my liege! You don't vote for kings.</p>
<p>Shut up! &hellip;Are you suggesting that coconuts migrate? Oh! Come and see the violence inherent in the system! Help, help, I'm being repressed! Camelot!</p>
<p>What do you mean? Well, we did do the nose. Where'd you get the coconuts?</p>
<p>Shut up! Will you shut up?! The nose? And this isn't my nose. This is a false one. Well, we did do the nose. Look, my liege! Shh! Knights, I bid you welcome to your new home. Let us ride to Camelot!</p>
<p>The nose? It's only a model. We found them. Bloody Peasant! The nose?</p>
<p>We want a shrubbery!! Ni! Ni! Ni! Ni! Shut up! Will you shut up?!</p>
<p>We want a shrubbery!! &hellip;Are you suggesting that coconuts migrate? And this isn't my nose. This is a false one.</p>
<p>You don't vote for kings. Burn her anyway! Shut up! What do you mean? Look, my liege!</p>
<p>Now, look here, my good man. Bloody Peasant! And the hat. She's a witch! Shh! Knights, I bid you welcome to your new home. Let us ride to Camelot!</p>
</div>
	</div>










<div class='span4 sidebar fundGoal goal'>
<h2>Fund This Goal</h2>
<p style='text-align:center'><small><a href="#faq_goal" role="button" data-toggle="modal"><i class='icon-question-sign help-icon'></i> What's the difference between a project and a goal?</a></small></p>
	<div class='well well-small'>
<div class="progress small">
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
<hr>
<form action='/fundingRedirect' method='post'>
<fieldset>
	<label for='amount'><b>Funding Amount</b></label>
	<div class="input-prepend">
  <span class="add-on">$</span>
  <input class="input-xlarge" type="text" name='amount' placeholder="$5 Minimum Pledge" value='5'>
</div>
<br>
</fieldset>
<fieldset>
<h3>Rewards</h3>
<fieldset>
	<label class='radio reward'><input type='radio' name='reward' value='' checked='checked'> <h4><b>No Reward</b></h4></label>
	<hr>
	<label class='radio reward'>
		<input type='radio' name='reward'><h4><b>$5</b> A Fuckin' Sticker</h4>
		<p>This is a description of the reward. It can be no more than 60 words.</p>
	</label>
	<hr>
	<label class='radio reward'>
		<input type='radio' name='reward'><h4><b>$10</b> A Fuckin' T-Shirt</h4>
		<p>II. A Loose-Fish is fair game for anybody who can soonest catch it. But what plays the mischief with this masterly code is the admirable brevity of it, which necessitates a vast volume of commentaries to expound it. First: What is a Fast-Fish? Alive or dead a fish is technically fast, when it is connected with</p>
	</label>
</fieldset>
<fieldset style='text-align:center'>
	<button type='submit' class='btn btn-large btn-success'>Continue</button>
</form>

</div>
<div>
<p><small>Openfire's payments are processed by <a href='http://www.wepay.com'>WePay</a>, and we never see or retain your credit card information. Your card will be immediately charged upon submission of payment.</small></p>
</div>
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

<!-- Modals -->

<div id="faq_goal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Help</h3>
  </div>
  <div class="modal-body">
    <h4>What's the difference between a project and a goal?</h4>
    <p>An openfire <b>project</b> is the overall, long-term, overarching list of things that a project creator or team is trying to achieve. A <b>goal</b> is one step within the project: a specific actionable thing.</p>
    <p>You can think of the project as a to-do list, and each goal is an item on that to-do list, which is accomplished when it's funded by people like you.</p>
  </div>
</div>

<div id="faq_rewards" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Help</h3>
  </div>
  <div class="modal-body">
    <h4>What are rewards?</h4>
    <p>A <b>reward</b> is what the project creator or team is offering to you as a thank-you for helping to fund this goal. Some rewards are tangible (swag, goods) and others are intangible (services).</p>
    <p>As most openfire projects aren't really about creating products, don't think of these as what you're getting for your money. Think of them as a way of thanking you for your support.</p>
  </div>
</div>



<!-- <div id="fundProject" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h2 id="myModalLabel" style='display:inline'>Fund Project</h2> <small class='muted' style='margin-left: 1em'>Your funding will go towards this project's current goal.</small>
  </div>
  <div class="modal-body">
   
<div class='goal well well-small'>
   	<h3><a href='#'>A Really Long And Annoying Goal Title</a></h3>

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
</div>
<form action='/fundingRedirect' method='post' data-validate='parsley'>
	<fieldset>
		<label for='amount'><b>Funding Amount</b></label>
		<div class="input-prepend">
  <span class="add-on">$</span>
		<input type='text' name='amount' class='input input-large'>
	</div>
	</fieldset>
</form>
  </div>
</div> -->

<script>
$(function() {
	$('.tooltipped').tooltip();
	// $("*:not(ul.nav):not(ul.nav li a) [data-toggle='tab']").on('click', function(){
	// 	var link = $(this).attr('href');
	// 	$('.nav li').removeClass('active');
	// 	$('.nav a[href="' + link + '"][data-toggle="tab"]').parent().addClass('active');
	// });
});
</script>
</html>