<? global $user; global $embedly; $partials = new Templater(); ?>
    <div class='goal span8' >
                <h1><?= $this->goal->name ?></h1>
                <h2><span class='muted'>Project:</span> <a href='/projects/<?= $this->project->slug ?>'><?= $this->project->title ?></h2>

<br>

<div class='media'>
            <? if(!empty($this->goal->mediaEmbed)){ if(empty($this->mediaWidth)) $this->mediaWidth = 320; $objs = $embedly->oembed(array('url' => $this->goal->mediaEmbed, 'maxwidth' => '640')); if(!empty($objs[0]->html)) echo $objs[0]->html; } ?>    
</div>

   <div class="social-buttons well well-small">
<a class='btn btn-info' href="https://twitter.com/share?url=<?= urlencode('http://' . $_SERVER['SERVER_NAME'] .  '/goals/' . $this->goal->uuid) ?>
&text=<?= urlencode($this->project->title . ": " . $this->goal->name . ' via @joinopenfire') ?>" target='_new'><i class='icon-twitter'></i>Share on Twitter</a> <a class='btn btn-info' style='background: #596F90' href='https://www.facebook.com/dialog/feed?app_id=<?= FACEBOOK_APP_ID ?>&
  link=http://<?= $_SERVER['SERVER_NAME'] ?>/goals/<?= $this->goal->uuid ?>&
  picture=<?= $this->project->icon ?>&
  name=<? urlencode($this->goal->name) ?>&
  caption=<?= urlencode($this->project->name) ?>&
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
</div>
<br>




                <div class='summary'>
               <span class='muted'>Summary:</span> <?= nl2br($this->goal->summary) ?>
            </div>



                <hr>
                <div class='description'>
<?= nl2br($this->goal->description) ?>
</div>
    </div>










<div class='span4 sidebar fundGoal goal'>
<h2>Fund This Goal</h2>
<p style='text-align:center'><small><a href="#faq_goal" role="button" data-toggle="modal"><i class='icon-question-sign help-icon'></i> What's the difference between a project and a goal?</a></small></p>
    <div class='well well-small'>
<div class="progress small">
  <div class="bar bar-success" style="width: <?= $this->goal->percentComplete ?>%;"></div>
</div>

                                    <ul class='stats'>
                            <li><b>$<?= $this->goal->targetAmount ?></b><br>goal</li>
                                                <li class="divider-vertical"></li>

                            <li><b>$<?= $this->goal->currentAmount ?></b><br> raised</li>
                                                <li class="divider-vertical"></li>
                            <li><b><?= count($this->goal->backers) ?></b><br> backers</li>
                                                <li class="divider-vertical"></li>
                            <li><b><?= $this->goal->daysUntilTarget ?></b><br> days left</li>
                        </ul>
<hr>
<form action='/fundingRedirect' method='post'>
    <input type='hidden' name='goalUUID' value='<?= $this->goal->uuid ?>'>
<fieldset>
    <label for='amount'><b>Funding Amount</b></label>
    <div class="input-prepend">
  <span class="add-on">$</span>
  <input class="input-xlarge" type="text" name='amount' placeholder="$5 Minimum Pledge" value='<?= $this->goal->suggestedAmount ?>'>
</div>
<br>
</fieldset>
<fieldset>
<h3>Rewards</h3>
<fieldset>
    <label class='radio reward'><input type='radio' name='reward' value='' checked='checked'> <h4><b>No Reward</b></h4></label>
    <hr>
    <? foreach($this->goal->rewards as $reward): ?><label class='radio reward'>
        <input type='radio' name='reward'><h4><b>$<?= $reward->minAmount ?></b> <?= $reward->name ?></h4>
        <?= nl2br($reward->description) ?>
    </label>
    <hr>
 <? endforeach; ?>
</fieldset>
<fieldset style='text-align:center'>
    <button type='submit' class='btn btn-large btn-success'>Continue</button>
</form>

</div>
<div>
<p><small>Openfire's payments are processed by <a href='http://www.wepay.com'>WePay</a>, and we never see or retain your credit card information. Your card will be immediately charged upon submission of payment.</small></p>
</div>
</div>
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