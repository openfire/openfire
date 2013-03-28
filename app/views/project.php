<? global $user; global $embedly; $partials = new Templater(); ?>
            <? $currentGoal = new Goal($this->project->currentGoalID) ?>

	<div class="span8 project">
        <div class="generalInfo hero-unit">
        	<h1 class="title"><?= $this->project->title ?></h1>
        	<h3 class="subtitle"><?= $this->project->subtitle ?></h3>

            <!-- updated this guy -->
        	<div class="media">
               <? if(!empty($this->project->mediaEmbed)){ $objs = $this->embedly->oembed(array('url' => $this->project->mediaEmbed, 'maxwidth' => '640')); if(!empty($objs[0]->html)) echo $objs[0]->html; } ?>   
            </div>

    	    <div class="social-buttons">
<a class='btn btn-info' href="https://twitter.com/share?url=<?= urlencode('http://' . $_SERVER['SERVER_NAME'] .  '/projects/' . $this->project->slug) ?>
&text=<?= urlencode($this->project->title . ': ' . $this->project->subtitle . ' via @joinopenfire') ?>" target='_new'><i class='icon-twitter'></i>Share on Twitter</a> <a class='btn btn-info' style='background: #596F90' href='https://www.facebook.com/dialog/feed?app_id=<?= FACEBOOK_APP_ID ?>&
  link=http://<?= $_SERVER['SERVER_NAME'] ?>/projects/<?= $this->project->slug ?>&
  picture=http://<?= $_SERVER['SERVER_NAME'] ?>/img/logo.png&
  name=<? urlencode($this->project->title) ?>&
  caption=<?= urlencode($this->project->title . ": " . $this->project->subtitle) ?>&
  description=<?= urlencode($this->project->summary) ?>&
  redirect_uri=http://<?= $_SERVER['SERVER_NAME'] ?>' target='_blank'><i class='icon-facebook'></i> Share on Facebook</a> 
<a class='btn' href='https://plus.google.com/share?url=http://<?= $_SERVER['SERVER_NAME'] ?>/projects/<?= $this->project->slug ?>'><i class='icon-googleplus'  style='color: #d34836'></i> Share on Google+</a>
<!-- <div class='btn btn-link'>
    <script src="https://apis.google.com/js/plusone.js"></script>
<g:plus action="share" height="24" annotation="none"></g:plus>
</div> -->
<div style='display:none'>
    <span itemprop="name"><?= $this->project->title ?></span>
<span itemprop="description"><?= $this->project->summary ?></span>
<img itemprop="image" src="http://<?= $_SERVER['SERVER_NAME'] ?>/img/logo.png">
<meta property="og:title" content="openfire: <?= $this->project->title ?>" />
<meta property="og:image" content="http://<?= $_SERVER['SERVER_NAME'] ?>/img/logo.png" />
<meta property="og:description" content="<?= $this->project->summary ?>" />
</div>
               <!-- AddThis Button BEGIN -->
<!-- <div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_pinterest_pinit"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-512e9539719dfdf8"></script> -->
<!-- AddThis Button END -->
            </div>

    		<p class="lead summary"><?= $this->project->summary ?></p>
<div><? if(!empty($user->id)): ?>
    <a href="/goals/<?= $currentGoal->uuid ?>/fund" role="button" class="btn btn-success">Fund This Project</a>
<? else: ?>
<div class='well well-small'><a class="btn disabled btn-success" id='fundProjectButton'>Fund This Project</a>

<p style='text-align:center'> <small>Please <a href='/login'>login</a> to fund this project.</small></p></div>
<? endif; ?>
</div>


        	<div class="details">
        		<ul class="nav nav-tabs">
        			<li class="active">
        				<a href="#about" data-toggle="tab">About</a>
        			</li>
        			<li>
        				<a href="#updates" data-toggle="tab">Updates</a>
        			</li>
        			<li>
        				<a href="#team" data-toggle="tab">Team</a>
        			</li>
        			<li>
        				<a href="#backers" data-toggle="tab">Backers</a>
        			</li>
        		</ul>
        		<div class="tab-content">
        	        <div class="tab-pane active" id="about">
        		 	    <h2>About <?= $this->project->title ?></h2>
         			 		<?= nl2br($this->project->description) ?> 
                    </div>
        		  
                <div class="tab-pane" id="updates">
                	<? foreach($this->project->updates as $update): ?>
                	<div class='update<? if($update->public == '0') echo " private" ?>'>
                		<h2><?= $update->title ?> <? if($update->public == '0'): ?><span class='label label-important'>Private</span><? endif; ?></h2>
                		<div class='body'>
                		<? if($update->public == '1' || $update->public == '0' && ($this->project->isMember($user) == true || $this->project->isBacker($user) == true)): ?><?= nl2br($update->body) ?><? else: ?><div style='font-weight:bold; margin-left: 2em'>This update is for project backers and team members only.</div><? endif; ?>
                	</div>
                	<div class='meta'>Posted by <a href='/users/<?= $update->user->username ?>'><?= $update->user->username ?></a> on <a href='/updates/<?= $update->uuid ?>'><?= date("F jS, Y", $update->dateAdded) ?> at <?= date("h:ia T", $update->dateAdded) ?></a></div>
                	</div>
                <? endforeach; ?>
                </div>

                <div class="tab-pane" id="team">
                	<? foreach($this->project->team as $member): ?>
                	<div class='member well well-small'>
                		<div class='row-fluid'>
	                		<div class='span1'><img src='<?= $member->avatar ?>' class='span12'></div>
	                		<div class='span8'><b><a href='/users/<?= $member->username ?>'><?= $member->username ?></a></b>: <?= $member->role ?></div>
                		</div>
                	</div>
                <? endforeach; ?>
                </div>

                <div class="tab-pane" id="backers">
                	<? foreach($this->project->backers as $member): ?>
                	<div class='member well well-small'>
                		<div class='row-fluid'>
	                		<div class='span1'><img src='<?= $member->avatar ?>' class='span12'></div>
	                		<div class='span8'><b><a href='/users/<?= $member->username ?>'><?= $member->username ?></a></b></div>
                		</div>
                	</div>
                <? endforeach; ?>
                </div>

        	</div>

        </div>
    </div>
</div>

<div class="span4 sidebar">
    <h1>Goals</h1>
	<div class="funding item widget">
        <div class="goal mini">
            <h3> <a href="/goals/<?= $currentGoal->uuid ?>"><?= $currentGoal->name ?></a> <span class="label label-warning">Current</span></h3>
        </div>

        <p><? if(empty($currentGoal->summary)): echo trimtowcount($currentGoal->description, 60) . "..."; else: echo nl2br($currentGoal->summary); endif ?></p>
        <div class="funding">
            <div class="funding-vitals">
                <h3>$<?= $currentGoal->currentAmount ?><span>of $<?= $currentGoal->targetAmount ?> raised</span></h3> 
                <h3 class="center"><?= count($currentGoal->backers) ?><span>backers</span></h3>
                <h3><?= $currentGoal->daysUntilTarget ?><span>days to go</span></h3>
            </div>
            <div class="progress">
                <div class="bar" style="width: <? if($currentGoal->percentComplete < 100): echo $currentGoal->percentComplete; else: echo "100"; endif; ?>%;"></div>
            </div>

            <div style="text-align:center; margin-top: 1em">
	           <a href="/goals/<?= $currentGoal->uuid ?>/fund" class="btn btn-large btn-success" onClick="_gaq.push(['_trackEvent', 'Fund this Goal', 'Find Click', 'Clicked',, false]);">Fund This Goal</a>
            </div>

  		</div>

		<h3>Rewards</h3>
        <div class="rewards-summary">
        	<? foreach($currentGoal->rewards as $reward): ?>
            <a href="/goals/<?= $currentGoal->uuid ?>/fund?amount=<?= $reward->minAmount ?>">
                <strong><span style='font-size: 1.5em'>$<?= $reward->minAmount ?>+</span> <?= $reward->name ?></strong> 
            </a>
           <? endforeach; ?>

        </div>
    </div>
</div>
<div class="span4 sidebar">
    	<? foreach($this->project->goals as $goal): if($goal->isCurrent != 1 && !in_array($goal->status, array("draft", "failed"))): ?>
    <div class="funding item widget goal mini <? if(in_array($goal->status, array("success", "failed","future"))): echo $goal->status . " muted"; endif; ?>">

            <h3> <a href="/goals/<?= $goal->uuid ?>"><?= $goal->name ?></a><? if(in_array($goal->status, array("success", "failed","future"))): ?> <span class="label label-default<? if($goal->status == "success") echo " label-success"; if($goal->status == "failed") echo " label-important"; ?>"><?= ucwords($goal->status) ?></span><? endif; ?></h3>

        <p><?= trimtowcount($goal->description,60) ?>...</p>
        <? if($goal->status !='future'): ?>
              <div class="funding">
            <div class="funding-vitals">
                <h3>$<?= $goal->currentAmount ?><span>of $<?= $goal->targetAmount ?> raised</span></h3> 
                <h3 class="center"><?= count($goal->backers) ?><span>backers</span></h3>
                <h3><?= $goal->daysUntilTarget ?><span>days to go</span></h3>
            </div>
            <div class="progress">
                <div class="bar" style="width: <? if($goal->percentComplete < 100): echo $goal->percentComplete; else: echo "100"; endif; ?>%;"></div>
            </div>
        </div>
    <? endif; ?>
        </div>
    <? endif; endforeach; ?>

    </div>
</div>

<!-- Funding modal -->

<div id="fundProject" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <form action='/fundingRedirect' method='post' data-validate='parsley'>

  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">Fund <?= $this->project->title ?></h3>
  </div>
  <div class="modal-body">
    <p class='muted'>Your funding will go towards this project's current goal.</p>
    <div class='goal'>
        <? $currentGoal = new Goal($this->project->currentGoalID) ?>
            <h3> <a href="/goals/<?= $currentGoal->uuid ?>" target='_blank'><?= $currentGoal->name ?></a> <span class="label label-warning">Current</span></h3>
        </div>
<hr>
        <p><? if(empty($currentGoal->summary)): echo trimtowcount($currentGoal->description, 60) . "..."; else: echo nl2br($currentGoal->summary); endif ?></p>
<!--         <div class="funding">
            <div class="funding-vitals">
                <h3>$<?= $currentGoal->currentAmount ?><span>of $<?= $currentGoal->targetAmount ?> raised</span></h3> 
                <h3 class="center"><?= count($currentGoal->backers) ?><span>backers</span></h3>
                <h3><?= $currentGoal->daysUntilTarget ?><span>days to go</span></h3>
            </div>
            <div class="progress">
                <div class="bar" style="width: <? if($currentGoal->percentComplete < 100): echo $currentGoal->percentComplete; else: echo "100"; endif; ?>%;"></div>
            </div> -->
<hr>
        <input type='hidden' name='goalUUID' value='<?= $this->currentGoal->uuid ?>'>
        <fieldset>
            <label for='amount'>Funding Amount</label>
            <div class="input-prepend input-append">
  <span class="add-on">$</span><input type='text' style='text-align:right' class='span1' id='amount' name='amount'  data-required='true' data-error-message='You must enter an amount.' value='<? if(!empty(

$this->currentGoal->minAmount) && empty($this->amount)): echo 

$this->currentGoal->minAmount; elseif(!empty($this->amount)): echo $this->amount; else: echo "5"; endif; ?>'><span class="add-on">.00</span>
</div>
        </fieldset>
        <? if(!empty(

$this->currentGoal->rewards)): ?>
    <legend>Rewards</legend>
    <fieldset>
        <? foreach(

$this->currentGoal->rewards as $reward): ?>
        <div class='well well-small reward <? if(!empty($this->amount) && $reward->minAmount > $this->amount || empty($this->amount) || ($reward->numTotal > 0 && $reward->numStillAvailable == 0)): ?>muted<? endif; ?>' id = '<?= $reward->uuid ?>' data-minAmount = '<?= $reward->minAmount ?>'>

                    <h3><? if(($reward->numTotal > 0 && $reward->numStillAvailable != 0) || $reward->numTotal == 0): ?><input type='radio' <? if((!empty($this->amount) && $reward->minAmount <= $this->amount) || empty($this->amount)): ?>disabled='disabled'<? endif; ?> <? if(!empty($this->amount) && $reward->minAmount == $this->amount): ?>checked='checked'<? endif; ?> name='rewardUUID' value='<?= $reward->uuid ?>'><? endif; ?>  $<?= $reward->minAmount ?>: <?= $reward->name ?></h3>
                    <div><?= $reward->description ?></div>
<h3 style='text-align:right'><? if($reward->numTotal > 0): ?><? if($reward->numTotal > 0 && $reward->numStillAvailable != 0): ?><b><?= $reward->numStillAvailable ?></b> of <b><?= $reward->numTotal ?></b> still available<? else: ?>All Gone!<?endif; ?><? else: ?>Unlimited<? endif; ?></h3>
        </div>
    <? endforeach; ?>
    </fieldset>

<? endif; ?>

  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class='btn btn-info' type='submit'>Fund This Goal</button>

  </div>
              </form>

</div>

<!-- /modal -->
<script>
$(function() {


    
    $('#amount').blur(function(){
        var amount = $('#amount').val();
var available = $(".reward").filter(function() {
    return  parseInt($(this).attr("data-minAmount")) <= parseInt(amount);
});
available.removeClass('muted');
available.find('input[name="rewardUUID"]').removeAttr('disabled');
available.first().find('input[name="rewardUUID"]').attr('checked','checked');

var unavailable = $(".reward").filter(function() {
    return  parseInt($(this).attr("data-minAmount")) > parseInt(amount);
});
unavailable.addClass('muted');
unavailable.find('input[name="rewardUUID"]').attr('disabled','disabled');
unavailable.first().find('input[name="rewardUUID"]').removeAttr('checked');

});
});
</script>