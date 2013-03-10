<? global $user; global $embedly; $partials = new Templater(); ?>
<div class="row-fluid project-vitals">

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
</div>

<div class="row-fluid">
	<div class="span8">
        <div class="hero-unit goal-details">
            <h1><?= $this->goal->name ?></h1>
            <div class="media">
               <? if(!empty($this->goal->mediaEmbed)){ if(empty($this->mediaWidth)) $this->mediaWidth = 320; $objs = $embedly->oembed(array('url' => $this->goal->mediaEmbed, 'maxwidth' => '640')); if(!empty($objs[0]->html)) echo $objs[0]->html; } ?>    
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
        	
            <p style="text-align:right"><a href="/goals/<?= $this->goal->uuid ?>/fund" class="btn btn-success" onClick="_gaq.push(['_trackEvent', 'Fund Button', 'Fund Click', 'Clicked',, false]);">Fund This Goal</a></p>

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