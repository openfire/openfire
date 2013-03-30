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
  <li class="active">This Project</li>
</ul>
<div class='row'>

	<div class='span8 project'>
		<div class='titling'>
				<h1 class='title'>Code For Appalachia <a href="#faq_goal" role="button" data-toggle="modal"class='tooltipped' title='Click here for more info'><i class='icon-question-sign help-icon'></i></a></h1>
				<h3 class='subtitle'>A project to bring code to the hollers of Appalachia</h3>
		</div>


<!-- 		<div class='share'>
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_pinterest_pinit"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-512e9539719dfdf8"></script>
		</div> -->
<ul class='nav nav-tabs project-nav'>

	<li class='active'><a href='#about' data-toggle='tab'>Details</a></li>
	<li><a href='#updates' data-toggle='tab'>Updates <span class='badge'>15</span></a></li>
	<li><a href='#team' data-toggle='tab'>Team <span class='badge'>12</span></a></li>
<!-- 	<li><a href='#backers' data-toggle='tab'>Backers <span class='badge'>230</span></a></li>
 -->
</ul>

<div class="tab-content">

	<div id='about' class='about tab-pane active fade in'>

		<div class='media'>
			<iframe width="560" height="315" src="http://www.youtube.com/embed/ZBAGEeOms-8?rel=0" frameborder="0" allowfullscreen></iframe>
		</div>
							<div style='text-align:center; margin-top: 2em; margin-bottom: 2em'><a href="#" role="button" data-toggle="modal" class='btn btn-success btn-large'>Fund This Project's Current Goal<br><span style='font-size: 0.75em; font-weight: 300'>$5 Minimum Pledge</small></a></div>
		<div class='share well well-small'>
	<h4 style='display:inline-block; margin-top: 0.5em; margin-right: 1em !important'><i class='icon-share'></i> Share</h4>
<a class='btn btn-info'><i class='icon-twitter'></i> Twitter</a> <a class='btn btn-info' style='background: #596F90'><i class='icon-facebook'></i> Facebook</a> <a class='btn'><i class='icon-googleplus' style='color: #d34836'></i> Google+</a> <a class='btn'><i class='icon-envelope'></i> Email</a>
</div>

			<ul class='stats unstyled'>
			<li>Creator: <b><a href='#'>jzellis</a></b></li>
			<li>Launched: <b>Mar 01,2013</b></li>
			<li>Total Funds Raised: <b>$5000</b> from <b>234</b> backers</li>
		</ul>


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


	<div id='updates' class='tab-pane fade in'>
		<h3>Updates</h3>
		<ul class='updates unstyled'>
			<li class='update'>
				<h4><a href='#'>This Is An Update Title</a></h4>
				<div class='meta'>Posted by <a href='#'>jzellis</a> on April 04, 2013 at 2:34pm</div>
				<div class='body'>
					<p>I'm trying not to, kid. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you're going. No! Alderaan is peaceful. We have no weapons. You can't possibly&hellip; I want to come with you to Alderaan. There's nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me.</p>
<p>Remember, a Jedi can feel the Force flowing through him. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers. What!? I find your lack of faith disturbing. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>
<p>Dantooine. They're on Dantooine. I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. But with the blast shield down, I can't even see! How am I supposed to fight? The more you tighten your grip, Tarkin, the more star systems will slip through your fingers. ... <a href='#'>(See more)</a></p>
				</div>
			</li>

			<li class='update'>
				<h4><a href='#'>Another Update</a></h4>
				<div class='meta'>Posted by <a href='#'>davidryal</a> on April 04, 2013 at 2:34pm</div>
				<div class='body'>
					<p>I'm trying not to, kid. Look, I can take you as far as Anchorhead. You can get a transport there to Mos Eisley or wherever you're going. No! Alderaan is peaceful. We have no weapons. You can't possibly&hellip; I want to come with you to Alderaan. There's nothing for me here now. I want to learn the ways of the Force and be a Jedi, like my father before me.</p>
<p>Remember, a Jedi can feel the Force flowing through him. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers. What!? I find your lack of faith disturbing. The more you tighten your grip, Tarkin, the more star systems will slip through your fingers.</p>
<p>Dantooine. They're on Dantooine. I suggest you try it again, Luke. This time, let go your conscious self and act on instinct. But with the blast shield down, I can't even see! How am I supposed to fight? The more you tighten your grip, Tarkin, the more star systems will slip through your fingers. </p>
				</div>
			</li>

			<li class='update private muted'>
				<h4><a href='#'>A Private Message</a></h4>
				<div class='meta'>Posted by <a href='#'>davidryal</a> on April 04, 2013 at 2:34pm</div>
				<div class='body privateOnly'>This update is only available to project members and backers.</div>
			</li>

		</ul>
		<h4 style='text-align:center; margin-bottom: 2em'><a href='#'>See All Updates</a></h4>
	</div>

	<div id='team' class='tab-pane fade in'>
		<h3>Team</h3>
		<ul class='teamMembers unstyled'>
			<li class='member well well-small'>
				<div class='row-fluid'>
					<div class='span2'>
						<a href='#'><img src='http://lorempixel.com/128/128'></a>
					</div>
					<div class='span10'>
						<h3 style='margin:0; line-height: 1em; font-weight:bold'><a href='#'>Joshua Ellis</a></h3>
						<h4>Project Founder</h4>
						<div class='bio'>
							Joshua Ellis is the CTO of openfire, a writer, musician, and dork.
						</div>
					</div>
				</div>
			</li>
			<li class='member well well-small'>
				<div class='row-fluid'>
					<div class='span2'>
						<a href='#'><img src='http://lorempixel.com/128/128?q=a'></a>
					</div>
					<div class='span10'>
						<h3 style='margin:0; line-height: 1em; font-weight:bold'><a href='#'>David Anderson</a></h3>
						<h4>Vice President In Charge Of Fishing Lures</h4>
						<div class='bio'>
							<p>David Anderson is ultimate frisbee world champion. Below in his hammock, Ahab did not hear of this till grey dawn, when he came to the deck; it was then recounted to him by Flask, not unaccompanied with hinted dark meanings. He hollowly laughed, and thus explained the wonder.</p>

<p>Those rocky islands the ship had passed were the resort of great numbers of seals, and some young seals that had lost their dams, or some dams that had lost their cubs, must have risen nigh the ship and kept company with her, crying and sobbing with their human sort of wail. But this only the more affected some of them, because most mariners cherish a very superstitious feeling about seals, arising not only from their peculiar tones when in distress, but also from the human look of their round heads and semi-intelligent faces, seen peeringly uprising from the water alongside. In the sea, under certain circumstances, seals have more than once been mistaken for men.</p>
						</div>
					</div>
				</div>
			</li>
		</ul>
	</div>





</div>
	</div>
<div class='span4 sidebar'>
	<h2>Goals</h2>
	<p style='text-align:center'><small><a href="#faq_goal" role="button" data-toggle="modal"><i class='icon-question-sign help-icon'></i> What's the difference between a project and a goal?</a></small></p>
	<ul class='goals unstyled'>
		<li class='goal current well well-small'>
			<h4>Current Goal</h4>
			<h3><a href='#'>A Really Long And Annoying Goal Title</a></h3>

			<div class='summary'>
				<p>Bender, you risked your life to save me! You guys aren't Santa! You're not even robots. How dare you lie in front of Jesus? Then throw her in the laundry room, which will hereafter be referred to as "the brig". We're rescuing ya. I guess because my parents keep telling me to be more ladylike. As though!</p>
<p>I'll get my kit! Fry, we have a crate to deliver. You, minion. Lift my arm. AFTER HIM! You seem malnourished. Are you suffering from intestinal parasites?</p>
<div style='text-align:right'><a href='#'>More Info</a></div><br>
			</div>
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
						<br>
<div style='text-align:center'><a href='#' class='btn btn-success btn-large'>Fund This Goal<br><span style='font-size: 0.75em; font-weight: 300'>$5 Minimum Pledge</small></a></div>
		</li>

<hr>
		<li class='goal future well well-small'>
			<h3 title='This goal has not been started yet.'><a href='#'>A Future Goal</a> <span style='font-size:0.75em' class='muted'>future</span></h3>
			<p><small><i>This goal has not been started yet.</i></small></p>
			<div class='summary'>"What do ye do when ye see a whale, men?" "Sing out for him!" was the impulsive rejoinder from a score of clubbed voices. "Good!" cried Ahab, with a wild approval in his tones; observing the hearty animation into which his unexpected question had so magnetically thrown them.</div>
		</li>

					<li class='goal muted well well-small success'>
					<h3><a href='#'>A Past Goal</a> <span style='font-size:0.75em' class='muted'>successful</span></h3>
					<div class='summary'>"What do ye do when ye see a whale, men?" "Sing out for him!" was the impulsive rejoinder from a score of clubbed voices. "Good!" cried Ahab, with a wild</div>
<div class="progress progress-success">
  <div class="bar" style="width: 100%;"></div>
</div>

									<ul class='stats'>
							<li><b>$5000</b><br>goal</li>
												<li class="divider-vertical"></li>

							<li><b>$5500</b><br> raised</li>
												<li class="divider-vertical"></li>
							<li><b>18</b><br> backers</li>

						</ul>
					</li>

					<li class='goal muted well well-small failed'>
					<h3><a href='#'>A Failed Goal</a> <span style='font-size:0.75em' class='muted'>failed</span></h3>
					<div class='summary'>"What do ye do when ye see a whale, men?" "Sing out for him!" was the impulsive rejoinder from a score of clubbed voices. "Good!" cried Ahab, with a wild approval in his tones; observing the hearty animation into which his unexpected question had so magnetically thrown them. "And what do ye next, men?" "Lower away, and</div>
					<div class="progress">
  <div class="bar bar-danger" style="width: 25%;"></div>
</div>

									<ul class='stats'>
							<li><b>$5000</b><br>goal</li>
												<li class="divider-vertical"></li>

							<li><b>$1250</b><br> raised</li>
												<li class="divider-vertical"></li>
							<li><b>18</b><br> backers</li>

						</ul>

					</li>



	</ul>
</div>
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