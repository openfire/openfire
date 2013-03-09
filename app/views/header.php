<? global $user; ?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<link href="/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="/css/elusive-webfont.css" rel="stylesheet" media="screen">
<link href="/css/style.css" rel="stylesheet" media="screen">



<? if(!empty($this->css)): foreach($this->css as $url): ?>
<link rel="stylesheet" href="<?= $url ?>">
<? endforeach; endif; ?>


<title>Openfire<? if(!empty($this->title)) echo " | " . $this->title ?></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> 
<script src='/app/libraries/min/b=js&f=bootstrap.min.js,holder.js,jquery.form.js,parsley.js'></script>
<? if(!empty($this->scripts)): foreach($this->scripts as $url): ?>
<script src='<?= $url ?>'></script>
<? endforeach; endif; ?>
<script>
function bootstrap_tab_bookmark (selector) { if (selector == undefined) {
    selector = ""; }
 
    /* Automagically jump on good tab based on anchor */
    $(document).ready(function() {
        url = document.location.href.split('#');
        if(url[1] != undefined) {
            $(selector + '[href=#'+url[1]+']').tab('show');
        }
    });
 
    var update_location = function (event) {
        document.location.hash = this.getAttribute("href");
    }
 
    /* Update hash based on tab */
    $(selector + "[data-toggle=pill]").click(update_location);
    $(selector + "[data-toggle=tab]").click(update_location);
}

bootstrap_tab_bookmark('a');
</script>


</head>
<body <? if(!empty($this->bodyClass)): ?>class="<?= $this->bodyClass ?>"<? endif; ?>>
	<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-38984146-2']);
  _gaq.push(['_setDomainName', 'openfi.re']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript';
ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' :
'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0];
s.parentNode.insertBefore(ga, s);
  })();

</script>

		<div class="navbar navbar-static-top">
		  <div class="navbar-inner">
		    <a class="brand" href="/"><img src='/img/logo_textual.png' style='height:32px'></a>
		    <ul class="nav">
		      <li><a href="/about">About</a></li>
		        <li class="divider-vertical"></li>

		      <li><a href="/projects">Explore</a></li>
		        <li class="divider-vertical"></li>

		      <li><a href="/create">Submit</a></li>

		    </ul>
		    <ul class='nav pull-right'>
		    	<li class="dropdown">
  <a class="dropdown-toggle" data-toggle="dropdown" href="#"><? if(empty($user->id)): ?>Sign Up/Login<? else: echo "<img src='" . $user->avatar . "' style='height: 16px'> " . $user->fullName . " (" . $user->username . ")"; endif; ?><b class='caret'></b></a>

  	<? if(empty($user->id)): ?>
  	  <ul class="dropdown-menu span4" role="menu" aria-labelledby="dLabel"  style='padding: 1em;'>
  	  	  	<li>
              <h4>Login</h4>
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
	<? else: ?>
	  	  <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel"  style='padding: 1em'>
  	  	  	<li>
	<ul class='unstyled'>
		<li><a href='/profile'>My Profile</a></li>
		<li><a href='/profile/#projects'>My Projects</a></li>
		<li><a href='/createProject'>Create A Project</a></li>
		<li><a href='/logout'>Logout</a></li>
	</ul>
	<? endif; ?>
</li>
  </ul>
</li>
</ul>
		  </div>
		</div>
<!-- 		<div class='row-fluid'>
			<div class='span12' style='text-align:right'>
				<form class='form-search' action='/search' method='get'>
					<div class='input-append'><input type="search" class="input-xlarge search-query">
  <button type="submit" class="btn">Search</button>
</div>
				</form>
			</div>
		</div> -->
	<div class='container-fluid'>
<div class='row-fluid'>

<? if(!empty($this->breadcrumbs)): ?>
<ul class="breadcrumb">
<li><a href="/">Home</a>  <span class="divider">><span></li>
<? $i = 1; foreach($this->breadcrumbs as $url=>$label): ?>
<li><? if ($i == count($this->breadcrumbs)): ?><b><a href="<?= $url ?>"><?= $label ?></a></b><? else: ?><a href="<?= $url ?>"><?= $label ?></a><? endif; ?><? if($i != count($this->breadcrumbs)): ?><span class="divider">><span><? endif; ?></li>
<? $i++; endforeach; ?>

</ul>
</div>
<div class='row-fluid'>
	<? endif; ?>