<? global $user; global $embedly; $partials = new Templater(); ?>
	<div class="span8 project">
        <div class="generalInfo hero-unit">
        	<h1 class="title"><?= $this->project->title ?></h1>
        	<h3 class="subtitle"><?= $this->project->subtitle ?></h3>

            <!-- updated this guy -->
        	<div class="media">
               <? if(!empty($this->project->mediaEmbed)){ $objs = $this->embedly->oembed(array('url' => $this->project->mediaEmbed, 'maxwidth' => '640')); if(!empty($objs[0]->html)) echo $objs[0]->html; } ?>   
            </div>

    	    <div class="social-buttons">
               <!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_pinterest_pinit"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-512e9539719dfdf8"></script>
<!-- AddThis Button END -->
            </div>

    		<p class="lead summary"><?= $this->project->summary ?></p>

            


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
	<div class="funding item widget">
        <div class="goal mini">
        	<? $currentGoal = new Goal($this->project->currentGoalID) ?>
            <h3> <a href="/goals/<?= $currentGoal->uuid ?>"><?= $currentGoal->name ?></a> <span class="label label-warning">Current</span></h3>
        </div>

        <p><?= trimtowcount($currentGoal->description,60) ?>...</p>
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
	           <a href="/goals/<?= $currentGoal->uuid ?>/fund" class="btn btn-large btn-success">Find Out More</a>
            </div>

  		</div>

		<h3>Rewards</h3>
        <div class="rewards-summary">
        	<? foreach($currentGoal->rewards as $reward): ?>
            <a href="/goals/<?= $currentGoal->uuid ?>/fund?amount=<?= $reward->minAmount ?>">
                <strong><?= $reward->name ?></strong> - <i>$<?= $reward->minAmount ?>+</i> <?= trimtowcount($reward->description,60) ?>...
            </a>
           <? endforeach; ?>

        </div>
    </div>
</div>
<div class="span4 sidebar">
    	<? foreach($this->project->goals as $goal): if($goal->isCurrent != 1 && $goal->status !="draft"): ?>
    <div class="funding item widget goal mini <? if(in_array($goal->status, array("success", "failed"))): echo $goal->status . " muted"; endif; ?>">

            <h3> <a href="/goals/<?= $goal->uuid ?>"><?= $goal->name ?></a><? if(in_array($goal->status, array("success", "failed"))): ?> <span class="label label-default<? if($goal->status == "success") echo " label-success"; if($goal->status == "failed") echo " label-important"; ?>"><?= ucwords($goal->status) ?></span><? endif; ?></h3>

        <p><?= trimtowcount($goal->description,60) ?>...</p>
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
        </div>
    <? endif; endforeach; ?>

    </div>
</div>
