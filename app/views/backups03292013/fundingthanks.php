<? global $user; $project = new Project($this->goal->projectID); ?>
<div class='span6 offset3'>
	<h2>Thanks!</h2>

	<p>Your contribution of <b>$<?= $this->amount ?></b> has been successfully processed. You are super rad.</p>
	<p><a class='btn btn-info' href="https://twitter.com/share?url=<?= urlencode('http://' . $_SERVER['SERVER_NAME'] .  '/goals/' . $this->goal->uuid) ?>
&text=<?= urlencode('I backed the '. $project->title . ' goal "' . $this->goal->name . '" on openfire! (via @joinopenfire)') ?>" target='_new'><i class='icon-twitter'></i> Share On Twitter</a> <a class='btn btn-info' style='background: #596F90' href='https://www.facebook.com/dialog/feed?app_id=<?= FACEBOOK_APP_ID ?>&
  link=http://<?= $_SERVER['SERVER_NAME'] ?>/goals/<?= $this->goal->uuid ?>&
  picture=<?= $this->project->icon ?>&
  name=<? urlencode($this->goal->name) ?>&
  caption=<?= urlencode($this->project->title) ?>&
  description=<?= urlencode($this->goal->summary) ?>&
  redirect_uri=http://<?= $_SERVER['SERVER_NAME'] ?>' target='_blank'><i class='icon-facebook'></i> Share On Facebook</a> <div class='btn btn-link'>
    <script src="https://apis.google.com/js/plusone.js"></script>
<g:plus action="share" height="24" annotation="none"></g:plus>
</div>
<div style='display:none'>
    <span itemprop="name"><?= $this->goal->name ?></span>
<span itemprop="description"><?= $this->goal->summary ?></span>
<img itemprop="image" src="http://<?= $_SERVER['SERVER_NAME'] ?>/img/logo.png">
<meta property="og:title" content="openfire: <?= $this->goal->title ?>" />
<meta property="og:image" content="http://<?= $_SERVER['SERVER_NAME'] ?>/img/logo.png" />
<meta property="og:description" content="<?= $this->goal->summary ?>" />
</div></p>
	<p><a href='/goals/<?= $this->goal->uuid ?>'>Return to goal</a></p>
  <p><a href='/projects/<?= $project->slug ?>'>Return to project</a></p>

</div>

