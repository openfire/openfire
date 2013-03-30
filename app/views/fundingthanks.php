<? global $user; $project = new Project($this->goal->projectID); ?>
<div class='span10 offset1 fundingComplete' style='text-align:center; margin-bottom: 10em'>
	<h2>Thanks!</h2>

	<h3>Your contribution of <b>$<?= $this->amount ?></b> to the <b><a href='/projects/<?= $project->slug ?>'><?= $project->title ?></a></b> goal <b><a href='/goals/<?= $this->goal->uuid ?>'>&quot;<?= $this->goal->name ?>&quot;</a></b> has been successfully processed. You are super awesome.</h3><br>
  <h4>Hey, why not share this with the whole wide world?</h4>
	<div>
    <a class='btn btn-info' href="https://twitter.com/share?url=<?= urlencode('http://' . $_SERVER['SERVER_NAME'] .  '/goals/' . $this->goal->uuid) ?>
&text=<?= urlencode("I backed " . $this->goal->name . ': on @joinopenfire') ?>" target='_new'><i class='icon-twitter'></i>Share on Twitter</a> <a class='btn btn-info' style='background: #596F90' href='https://www.facebook.com/dialog/feed?app_id=<?= FACEBOOK_APP_ID ?>&
  link=http://<?= $_SERVER['SERVER_NAME'] ?>/goals/<?= $this->goal->uuid ?>&
  picture=<?= $project->icon ?>&
  name=<? urlencode($this->goal->name) ?>&
  caption=<?= urlencode($project->name) ?>&
  description=<?= urlencode($this->goal->summary) ?>&
  redirect_uri=http://<?= $_SERVER['SERVER_NAME'] ?>/goals/<?= $this->goal->uuid ?>' target='_blank'><i class='icon-facebook'></i> Share on Facebook</a> 
<a class='btn' target='_blank' href='https://plus.google.com/share?url=http://<?= $_SERVER['SERVER_NAME'] ?>/goals/<?= $this->goal->uuid ?>'><i class='icon-googleplus'  style='color: #d34836'></i> Share on Google+</a>

<div style='display:none'>
    <span itemprop="name"><?= $this->goal->name ?></span>
<span itemprop="description"><?= $this->goal->summary ?></span>
<img itemprop="image" src="<?= $project->icon ?>">
<meta property="og:title" content="openfire: <?= $this->goal->name ?>" />
<meta property="og:image" content="<?= $project->icon ?>" />
<meta property="og:description" content="<?= $this->goal->summary ?>" />
</div>
<br><br>
	<h4><a href='/goals/<?= $this->goal->uuid ?>'>Return to <b><?= $this->goal->name ?></b></a><br><br>
  <a href='/projects/<?= $project->slug ?>'>Return to <b><?= $project->title ?></b></a></h4>

</div>
</div>
