<? global $user; ?><!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Openfire<? if(!empty($this->title)) echo " | " . $this->title ?></title>
<link href="/css/bootstrap.min.css" rel="stylesheet">
<link href="/css/elusive-webfont.css" rel="stylesheet" media="screen">
<link href="/css/style_new.css" rel="stylesheet" media="screen">
<? if(!empty($this->css)): foreach($this->css as $url): ?>
<link rel="stylesheet" href="<?= $url ?>">
<? endforeach; endif; ?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> 
<script src="http://code.jquery.com/jquery-migrate-1.1.1.min.js"></script>

<script src='/app/libraries/min/b=js&f=bootstrap.min.js,holder.js,jquery.form.js,parsley.js,jquery.cookie.js'></script>
<? if(!empty($this->scripts)): foreach($this->scripts as $url): ?>
<script src='<?= $url ?>'></script>
<? endforeach; endif; ?>
</head>

<body<? if(!empty($this->bodyClass)): ?> class="<?= $this->bodyClass ?>"<? endif; ?>>
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
<div class='container-fluid'>
  <!-- Header -->
  <div class='row-fluid'>
    <div class='navbar navbar-static-top'>
      <div class='navbar-inner'>
        <a class='brand' href='/'><img src='/img/logo_textual.png' class='logo'></a>
        <ul class="nav">
          <li class='dropdown'>
            <a href="/projects">Explore</a>
          </li>
          <li class="divider-vertical"></li>
          <li><a href="/create">Create</a></li>
          <li class="divider-vertical"></li>
          <li><a href="/about">About Us</a></li>
          </ul>
          <ul class='nav pull-right'>
          <li class="divider-vertical"></li>

<!--             <li>
              <form class='navbar-form form-search' action='/search' method='get'>
                <input type='text' class='input-medium search-query' name='q'> <button class='btn'type='submit'>Search</button>
              </form>
            </li>
          <li class="divider-vertical"></li> -->

    <? if(empty($user->id)): ?>

            <li class='dropdown'>
             <a href="#loginModal" role="button" data-toggle="modal">Login/Signup</a>

            </li>
<? else: ?>
            <li class='dropdown' style='margin-left: 2em'>
          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class='muted'>Logged in as</span> <img src='<?= $user->avatar?>' class='avatar'> <?= $user->username ?> <b class="caret"></b></a>
              <ul class='dropdown-menu'>
                <li><a href='/profile'>My Profile</a></li>
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
<div class='row-fluid' style='min-height: 100%; padding-bottom: 4em'>