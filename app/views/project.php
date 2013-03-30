<? global $user; global $embedly; $partials = new Templater(); ?>
            <? $currentGoal = new Goal($this->project->currentGoalID) ?>

    <div class='span8 project'>
        <div class='titling'>
                <h1 class='title'><?= $this->project->title ?><a href="#faq_goal" role="button" data-toggle="modal"class='tooltipped' title='Click here for more info'><i class='icon-question-sign help-icon'></i></a></h1>
                <h3 class='subtitle'><?= $this->project->subtitle ?></h3>
        </div>
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
<div class='span4 sidebar'>
    <h2>Goals</h2>
    <p style='text-align:center'><small><a href="#faq_goal" role="button" data-toggle="modal"><i class='icon-question-sign help-icon'></i> What's the difference between a project and a goal?</a></small></p>
    <ul class='goals unstyled'>
        <li class='goal current well well-small'>
            <h4>Current Goal</h4>
            <h3><a href='/goals/<?= $currentGoal->uuid ?>'><?= $currentGoal->name ?></a></h3>

            <div class='summary'>
                <?= nl2br($currentGoal->summary) ?>
<div style='text-align:right'><a href='/goals/<?= $currentGoal->uuid ?>'>More Info</a></div><br>
            </div>
                                                            <div class="progress">
  <div class="bar bar-success" style="width: <?= $currentGoal->percentComplete ?>%;"></div>
</div>

                                    <ul class='stats'>
                            <li><b>$<?= $currentGoal->targetAmount ?></b><br>goal</li>
                                                <li class="divider-vertical"></li>

                            <li><b>$<?= $currentGoal->currentAmount ?></b><br> raised</li>
                                                <li class="divider-vertical"></li>
                            <li><b><?= count($currentGoal->backers) ?></b><br> backers</li>
                                                <li class="divider-vertical"></li>
                            <li><b><?= $currentGoal->daysUntilTarget ?></b><br> days left</li>
                        </ul>
                        <br>
<div style='text-align:center'><a href='/goals/<?= $currentGoal->uuid ?>/fund' class='btn btn-success btn-large'>Fund This Goal<br><span style='font-size: 0.75em; font-weight: 300'>$<?= $currentGoal->suggestedAmount ?> Minimum Pledge</small></a></div>
        </li>

<hr>
<? foreach($this->project->goals as $goal): if($goal->uuid != $currentGoal->uuid && $goal->uuid != "draft"): ?>
    <li class='goal <?= $goal->status ?> well well-small'>
            <h3><a href='/goals/<?= $goal->uuid ?>'><?= $goal->name ?></a> <span style='font-size:0.75em' class='muted'><?= $goal->status ?></span></h3>
            <? if($goal->status == "future"): ?><p><small><i>This goal has not been started yet.</i></small></p><? endif; ?>
            <div class='summary'><?= nl2br($goal->summary) ?></div>

            <? if($goal->status != "future"): ?>
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
                    <? endif; ?>
        </li>
<? endif; endforeach; ?>
    </ul>
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