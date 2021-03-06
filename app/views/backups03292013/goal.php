<? global $user; global $embedly; $partials = new Templater(); ?>
<!-- <div class="row-fluid project-vitals">

    <div class="span8">
        <h1 class="title" style="text-align:left"><a title="Back to Project" class="back-arrow" href="/projects/<?= $this->project->slug ?>">&larr;</a><?= $this->project->title ?></h1>
        <h3 class="subtitle" style="text-align:left"><?= $this->project->subtitle ?></h3>
    </div>

     <div class="vitals span4 sidebar">
        <p> 
        Started on <strong><?= date("F jS, Y", $this->project->dateAdded) ?></strong> <br/> 
        <strong>30 days</strong> to go with <strong><? $this->project->getBackers(); echo count($this->project->backers) ?> backers</strong> <br/>  
        <strong>$<?= $this->project->totalFunding ?></strong> raised so far</p>
        <p>Created by <br/><a href="/users/<?= $this->project->creator->username ?>"><img src="<?= $this->project->creator->avatar ?>" class="avatar-medium"> <?= $this->project->creator->username ?></a>
        </p>
    </div>
</div> -->
<div class='row-fluid'>
    <div class='span12' style='margin-bottom: 1em'>
                    <h1 style='line-height: .75em !important'><?= $this->goal->name ?><br>
            <span class='muted' style='font-size:.5em'>this is a funding goal for project <a href='/projects/<?= $this->project->slug ?>'><?= $this->project->title ?></a></span></h1>
    </div>
</div>
<div class="row-fluid">
	<div class="span8">
        <div class="hero-unit goal-details">

            <div class="media" style='text-align:center'>
               <? if(!empty($this->goal->mediaEmbed)){ if(empty($this->mediaWidth)) $this->mediaWidth = 320; $objs = $embedly->oembed(array('url' => $this->goal->mediaEmbed, 'maxwidth' => '640')); if(!empty($objs[0]->html)) echo $objs[0]->html; } ?>    
            </div>
            <div class="social-buttons">
<a class='btn btn-info' href="https://twitter.com/share?url=<?= urlencode('http://' . $_SERVER['SERVER_NAME'] .  '/goals/' . $this->goal->uuid) ?>
&text=<?= urlencode($this->project->title . ": " . $this->goal->name . ' via @joinopenfire') ?>" target='_new'><i class='icon-twitter'></i>Share on Twitter</a> <a class='btn btn-info' style='background: #596F90' href='https://www.facebook.com/dialog/feed?app_id=<?= FACEBOOK_APP_ID ?>&
  link=http://<?= $_SERVER['SERVER_NAME'] ?>/goals/<?= $this->goal->uuid ?>&
  picture=<?= $this->project->icon ?>&
  name=<? urlencode($this->goal->name) ?>&
  caption=<?= urlencode($this->project->name) ?>&
  description=<?= urlencode($this->goal->summary) ?>&
  redirect_uri=http://<?= $_SERVER['SERVER_NAME'] ?>/goals/<?= $this->goal->uuid ?>' target='_blank'><i class='icon-facebook'></i> Share on Facebook</a> 
<a class='btn' target='_blank' href='https://plus.google.com/share?url=http://<?= $_SERVER['SERVER_NAME'] ?>/goals/<?= $this->goal->uuid ?>'><i class='icon-googleplus'  style='color: #d34836'></i> Share on Google+</a>
<!-- <div class='btn btn-link'>
    <script src="https://apis.google.com/js/plusone.js"></script>
<g:plus action="share" height="24" annotation="none"></g:plus>
</div> -->
<div style='display:none'>
    <span itemprop="name"><?= $this->goal->name ?></span>
<span itemprop="description"><?= $this->goal->summary ?></span>
<img itemprop="image" src="http://<?= $_SERVER['SERVER_NAME'] ?>/img/logo.png">
<meta property="og:title" content="openfire: <?= $this->goal->name ?>" />
<meta property="og:image" content="http://<?= $_SERVER['SERVER_NAME'] ?>/img/logo.png" />
<meta property="og:description" content="<?= $this->goal->summary ?>" />
</div>
</div>
            <p class="lead summary"><?if(!empty($this->goal->summary)):?><?= $this->goal->summary ?><br><br><hr><? endif; ?></p><div class='description'><?= nl2br($this->goal->description) ?></div>
            
            <p>
                <a class="btn btn-primary btn-large" href='/projects/<?= $this->project->slug ?>'>
                Back to Project
                </a>
            </p>
        </div>

    </div>

    <div class="span4 sidebar">
        <div class="funding item widget">
        	<!-- <h3>Progress</h3> -->
            <div class="funding-vitals">
                <h3>$<?= $this->goal->currentAmount ?><span>of $<?= $this->goal->targetAmount ?> raised</span></h3> 
                <h3 class="center"><?= count($this->goal->backers) ?><span>backers</span></h3>
                <h3><?= $this->goal->daysUntilTarget ?><span>days to go</span></h3>
            </div>
        	<div class="progress">
        		<div class="bar" style="width: <? if($this->goal->percentComplete < 100): echo $this->goal->percentComplete; else: echo "100"; endif; ?>%;"></div>
            </div>
        	

            <p style="text-align:right">
                <? if(!in_array($this->goal->status, array("success", "failed", "future"))): ?>
                <a href="/goals/<?= $this->goal->uuid ?>/fund" class="btn btn-success requiresLogin" onClick="_gaq.push(['_trackEvent', 'Fund Button', 'Fund Click', 'Clicked',, false]);">Fund This Goal</a>
            <? else:?>
            <? if($this->goal->status == 'success'): ?><span class='btn btn-success disabled'>Goal Successfully Funded</span><? endif; ?>
            <? if($this->goal->status == 'failed'): ?><span class='btn btn-warning disabled'>Goal Failed</span><? endif; ?>
            <? if($this->goal->status == 'failed'): ?><span class='btn disabled'>Goal Has Not Started Yet</span><? endif; ?>
        <? endif; ?>
            </p>

            <p>Goal created on <strong><?= date("F jS, Y", $this->goal->dateAdded) ?></strong>
            <br/>Funding ends on <strong><?= date("F jS, Y", $this->goal->targetDate) ?></strong></p>
    	</div>
    	<? foreach($this->goal->rewards as $reward): if($reward->status == "published"): ?>
    	<div class="rewards item">
            <h3><a href='/goals/<?= $this->goal->uuid ?>/fund?amount=<?= $reward->minAmount ?>'>Pledge $<?= $reward->minAmount ?> or more</a></h3>

             <strong><?= $reward->name ?></strong>

            <p><?= nl2br($reward->description) ?></p>

    	</div>
<? endif; endforeach; ?>
        <div class="backers item">
         	<h3>Backers</h3>
         			<ul class="unstyled">
        				<? foreach($this->goal->backers as $backer): ?>
        				<li><h4><a href="/users/<?= $backer->username ?>"><img src="<?= $backer->avatar ?>" class="avatar-small"> <?= $backer->username ?></a></h4></li>
        			<? endforeach; ?>
        			</ul>
         </div>

    </div>