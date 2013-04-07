<? global $user; global $embedly; $partials = new Templater(); ?>
            <? $currentGoal = new Goal($this->project->currentGoalID) ?>
</div>
<script>
$(function() {
    $('.popovered').popover({placement: get_popover_placement});

    function get_popover_placement(pop, dom_el) {
      var width = window.innerWidth;
      if (width<500) return 'bottom';
      var left_pos = $(dom_el).offset().left;
      if (width - left_pos > 400) return 'bottom';
      return 'left';
    }

    $('input[type="radio"]').change(function(){
        if(parseInt($('input[name="amount"]').val()) < $(this).attr('data-amount')){
        $('input[name="amount"]').val($(this).attr('data-amount'));
    }
    });


});
</script>
<div class='row-fluid'>
            <div class='titling span12'>
                <h1 class='title'><?= $this->project->title ?><a href="#faq_goal" role="button" data-toggle="modal"class='tooltipped' title='Click here for more info'><i class='icon-question-sign help-icon'></i></a></h1>
                <h3 class='subtitle'><?= $this->project->subtitle ?></h3>
             </div>
        <div class='goalChart span12'>
            <h4>Goals<br><small class='muted'>Click a goal's name for details</small></h4>

            <table class='chart table table-bordered'>
                <tbody>
                <tr>
            <? foreach($this->project->goals as $goal): if($goal->status != "draft"): ?>
            <td style='cursor:pointer' class='popovered goal <?= slugify($goal->status) ?><? if($goal->isCurrent == 0) echo " muted"; ?>' style='width: <?= 100 / count($this->project->goals) ?>%' data-title='<h3><a href="/goals/<?= $goal->uuid ?>"><?= $goal->name ?></a></h3>' data-trigger='click' data-html='true' data-content='<div class="goal"><span class="label"><?= ucwords($goal->status) ?></span>
                <div class="summary"><?= nl2br(htmlspecialchars($goal->summary, ENT_QUOTES)) ?></div><br><div class="progress progress-success">
  <div class="bar" style="width: <?= $goal->percentComplete ?>%;"></div>
</div>

                                    <ul class="stats">
                            <li><b>$<?= $goal->targetAmount ?></b><br>goal</li>
                                                <li class="divider-vertical"></li>

                            <li><b>$<?= $goal->currentAmount ?></b><br> raised</li>
                                                <li class="divider-vertical"></li>
                            <li><b><?= count($goal->backers) ?></b><br> backers</li>

                        </ul></div>'>
                <b><?= $goal->name ?></b> <? if($goal->isCurrent == 1) echo "<span class='label'>Current</span>"; ?>

            </td>
        <? endif; endforeach; ?>
    </tbody>
            </table>
        </div>
    </div>
    <div class='span8 project'>

<ul class='nav nav-tabs project-nav'>

    <li class='active'><a href='#about' data-toggle='tab'>Details</a></li>
    <li><a href='#updates' data-toggle='tab'>Updates <span class='badge'><?= count($this->project->updates) ?></span></a></li>
    <li><a href='#team' data-toggle='tab'>Team <span class='badge'><?= count($this->project->team) ?></span></a></li>
</ul>

<div class="tab-content">

    <div id='about' class='about tab-pane active fade in'>

        <div class='media'>
            <? if(!empty($this->project->mediaEmbed)){ if(empty($this->mediaWidth)) $this->mediaWidth = 320; $objs = $embedly->oembed(array('url' => $this->project->mediaEmbed, 'maxwidth' => '640')); if(!empty($objs[0]->html)) echo $objs[0]->html; } ?>    
        </div>
                            <div style='text-align:center; margin-top: 2em; margin-bottom: 2em'><a href="/goals/<?= $currentGoal->uuid ?>/fund" role="button" data-toggle="modal" class='btn btn-success btn-large requiresLogin'>Fund This Project's Current Goal<br><span style='font-size: 0.75em; font-weight: 300'>$<?= $currentGoal->suggestedAmount ?> Minimum Pledge</small></a></div>
        <div class='share well well-small'>
<a class='btn btn-info' href="https://twitter.com/share?url=<?= urlencode('http://' . $_SERVER['SERVER_NAME'] .  '/projects/' . $this->project->slug) ?>
&text=<?= urlencode($this->project->title . " (via @joinopenfire)") ?>" target='_new'><i class='icon-twitter'></i>Share on Twitter</a> <a class='btn btn-info' style='background: #596F90' href='https://www.facebook.com/dialog/feed?app_id=<?= FACEBOOK_APP_ID ?>&
  link=http://<?= $_SERVER['SERVER_NAME'] ?>/projects/<?= $this->project->slug ?>&
  picture=<?= $this->project->icon ?>&
  name=<? urlencode($this->project->title) ?>&
  caption=<?= urlencode($this->project->subtitle) ?>&
  description=<?= urlencode($this->project->summary) ?>&
  redirect_uri=http://<?= $_SERVER['SERVER_NAME'] ?>/projects/<?= $this->project->slug ?>' target='_blank'><i class='icon-facebook'></i> Share on Facebook</a> 
<a class='btn' target='_blank' href='https://plus.google.com/share?url=http://<?= $_SERVER['SERVER_NAME'] ?>/projects/<?= $this->project->slug ?>'><i class='icon-googleplus'  style='color: #d34836'></i> Share on Google+</a>
<div style='display:none'>
    <span itemprop="name"><?= $this->project->title ?></span>
<span itemprop="description"><?= $this->project->summary ?></span>
<img itemprop="image" src="<?= $this->project->icon ?>">
<meta property="og:title" content="openfire: <?= $this->project->title ?>" />
<meta property="og:image" content="<?= $this->project->icon ?>" />
<meta property="og:description" content="<?= $this->project->summary ?>" />
</div>
</div>


            <ul class='stats unstyled'>
            <li>Creator: <b><a href='#'><?= $this->project->creator->username ?></a></b></li>
            <li>Launched: <b><?= date("F jS, Y", $this->project->dateAdded) ?></b></li>
            <li>Total Funds Raised: <b>$<?= $currentGoal->currentAmount ?></b> from <b><?= count($currentGoal->backers) ?></b> backers</li>
        </ul>



                <div class='summary'>

               <span class='muted'>Summary:</span> <?= nl2br($this->project->summary) ?>
            </div>



                <hr>
                <div class='description'>
<?= nl2br($this->project->description) ?>
</div>
    </div>


    <div id='updates' class='tab-pane fade in'>
        <h3>Updates</h3>
        <ul class='updates unstyled'>
            <? foreach($this->project->updates as $update): ?>
            <li class='update<? if($update->public == 0): ?> private muted<? endif ?>'>
                <h4><a href='/updates/<?= $update->uuid ?>'><?= $update->title ?></a></h4>
                <div class='meta'>Posted by <a href='/users/<?=$update->user->username ?>'><?= $update->user->username ?></a> on <?= date("F jS, Y", $update->dateAdded) ?> at <?= date("h:ia", $update->dateAdded) ?></div>
                <div class='body'>
                    <? if($update->public == 1): ?>
                    <?= trimtopcount($update->body, 2) ?> <a href='/updates/<?= $update->uuid ?>'>(See more)</a></p>
                    <? else: ?>
                    <i>This is a private update for project team members and backers only.</i>
                <? endif; ?>
                </div>
            </li>
        <? endforeach; ?>

        </ul>
        <h4 style='text-align:center; margin-bottom: 2em'><a href='#'>See All Updates</a></h4>
    </div>

    <div id='team' class='tab-pane fade in'>
        <h3>Team</h3>
        <ul class='teamMembers unstyled'>
            <? foreach($this->project->team as $member): ?>
            <li class='member well well-small'>
                <div class='row-fluid'>
                    <div class='span2'>
                        <a href='#'><img src='<?= $member->avatar ?>'></a>
                    </div>
                    <div class='span10'>
                        <h3 style='margin:0; line-height: 1em; font-weight:bold'><a href='/users/<?= $member->username ?>'><?= $member->fullName ?></a></h3>
                        <h4><?= $member->role ?></h4>
                        <div class='bio'>
                            <?= nl2br($member->bio) ?>
                        </div>
                    </div>
                </div>
            </li>
         <? endforeach; ?>
        </ul>
    </div>





</div>
    </div>
<div class='span4 goal sidebar'>
 <h3>Fund This Project's Current Goal</h3>
<p style='text-align:center'><small><a href="#faq_goal" role="button" data-toggle="modal"><i class='icon-question-sign help-icon'></i> What's the difference between a project and a goal?</a></small></p>
    <div class='well well-small'>
        <h3><?= $currentGoal->name ?></h3>
        <div class='summary'><?= nl2br($currentGoal->summary) ?></div>
<div class="progress small">
  <div class="bar bar-success" style="width: <?= $this->currentGoal->percentComplete ?>%;"></div>
</div>

                                    <ul class='stats'>
                            <li><b>$<?= $this->currentGoal->targetAmount ?></b><br>goal</li>
                                                <li class="divider-vertical"></li>

                            <li><b>$<?= $this->currentGoal->currentAmount ?></b><br> raised</li>
                                                <li class="divider-vertical"></li>
                            <li><b><?= count($this->currentGoal->backers) ?></b><br> backers</li>
                                                <li class="divider-vertical"></li>
                            <li><b><?= $this->currentGoal->daysUntilTarget ?></b><br> days left</li>
                        </ul>
<hr>
<form action='/fundingRedirect' method='post'>
    <input type='hidden' name='goalUUID' value='<?= $this->currentGoal->uuid ?>'>
<fieldset>
    <label for='amount'><b>Funding Amount</b></label>
    <div class="input-prepend">
  <span class="add-on">$</span>
  <input class="input-xlarge" type="text" id='amount' name='amount' placeholder="$5 Minimum Pledge" value='<?= $this->currentGoal->suggestedAmount ?>'>
</div>
<br>
</fieldset>
<fieldset>
<h3>Rewards</h3>
<fieldset>
    <label class='radio reward'><input type='radio' name='rewardUUID' value='0' checked='checked'> <h4><b>No Reward</b></h4></label>
    <hr>
    <? foreach($this->currentGoal->rewards as $reward): ?><label class='radio reward'>
        <input type='radio' data-amount='<?= $reward->minAmount ?>' name='rewardUUID'><h4><b>$<?= $reward->minAmount ?></b> <?= $reward->name ?></h4>
        <?= nl2br($reward->description) ?>
                <p style='text-align:right; margin-top: 1em; font-weight: bold'><? if($reward->numTotal > 0): if($reward->numStillAvailable > 0): ?><?= $reward->numStillAvailable ?> of <?= $reward->numTotal ?> still available<? else: ?>All gone!<? endif; else: ?>Unlimited<? endif; ?></p>
    </label>
    <hr>
 <? endforeach; ?>
</fieldset>
<fieldset style='text-align:center'>
    <button type='submit' class='btn btn-large btn-success requiresLogin'>Continue</button>
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
<script>
$(function() {
    $('input[type="radio"]').change(function(){
        $('input[name="amount"]').val($(this).attr('data-amount'));
    });
});
</script>