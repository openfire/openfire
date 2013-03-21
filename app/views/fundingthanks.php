<? global $user; $project = new Project($this->goal->projectID); ?>
<div class='span6 offset3'>
	<h2>Thanks!</h2>

	<p>Your contribution of <b>$<?= $this->amount ?></b> has been successfully processed. You are super rad.</p>
	<p><a class='btn btn-info' href="https://twitter.com/share?url=<?= urlencode('http://' . $_SERVER['SERVER_NAME'] .  '/goals/' . $this->goal->uuid) ?>
&text=<?= urlencode('I backed the '. $project->title . ' goal "' . $this->goal->name . '" on openfire! (via @joinopenfire)') ?>" target='_new'><i class='icon-twitter'></i> Share On Twitter</a> <a class='btn btn-info' style='background: #596F90' href='https://www.facebook.com/dialog/feed?app_id=<?= FACEBOOK_APP_ID ?>&
  link=http://<?= $_SERVER['SERVER_NAME'] ?>/goals/<?= $this->goal->uuid ?>&
  picture=http://<?= $_SERVER['SERVER_NAME'] ?>/img/logo.png&
  name=<? urlencode($this->goal->name) ?>&
  caption=<?= urlencode("I backed this goal on openfire!") ?>&
  description=<?= urlencode($this->goal->summary) ?>&
  redirect_uri=http://<?= $_SERVER['SERVER_NAME'] ?>' target='_blank'><i class='icon-facebook'></i> Share On Facebook</a></p>
	<p><a href='/goals/<?= $this->goal->uuid ?>'>Return to goal</a></p>
</div>

