<? global $user; global $embedly; $partials = new Templater(); ?>
  <div class='span12 splash'>
    <div class='splash-inner'>
      <img src='/img/logo_large.png' class='span2 pull-left'>
      <div class='pull-right span9 offset1'>
        <span style='font-size: 3em; line-height: 1em'><b>openfire</b> is a crowdfunding platform for long-term, socially valuable projects.</span>
        <p style='text-align:right'><a href='/create'>Learn more</a></p>
      </div>
      <div class='clearfix'></div>
  </div>
  </div>
</div>
<div class='row-fluid'>
  <div class='span8 featuredGoals'>
    <h1>Featured Goals</h1>
    <? foreach($this->featuredGoals as $goal): $project = new Project($goal->projectID); ?>
    <div class="funding item widget goal mini <? if(in_array($goal->status, array("success", "failed"))): echo $goal->status . " muted"; endif; ?>">            
      
           
      <div class='row-fluid'>
        <div class='span6'>
<h3><a href="/goals/<?= $goal->uuid ?>"><?= $goal->name ?></a><? if(in_array($goal->status, array("success", "failed"))): ?> <span class="label label-default<? if($goal->status == "success") echo " label-success"; if($goal->status == "failed") echo " label-important"; ?>"><?= ucwords($goal->status) ?></span><? endif; ?></h3>
                        <div class="media">
               <? if(!empty($goal->mediaEmbed)){ if(empty($this->mediaWidth)) $this->mediaWidth = 320; $objs = $embedly->oembed(array('url' => $goal->mediaEmbed, 'maxwidth' => '320')); if(!empty($objs[0]->html)) echo $objs[0]->html; } ?>    
            </div>

        <p><?= trimtowcount($goal->description,60) ?>...<a href='/goals/<?= $goal->uuid ?>'>(more)</a></p>
      </div>
      <div class='span6 well well-small'>
         <legend>Project: <a href='/projects/<?= $project->slug ?>'><img src='<?= $project->icon ?>' style='height: 1em'> <?= $project->title ?></a></legend>
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
    </div>
        </div>
    <? endforeach; ?>
  </div>
  <div class='span4 sidebar leftBorder'>
    <div class='featuredProjects'>
    <h2>Featured Projects</h2>
    <? foreach($this->featuredProjects as $project): ?>
    <div class='project'>
      <h3><a href='/projects/<?= $project->slug ?>'><?= $project->title ?></a></h3>
      <div class="media">
               <? if(!empty($project->mediaEmbed)){ $objs = $this->embedly->oembed(array('url' => $project->mediaEmbed, 'maxwidth' => '240')); if(!empty($objs[0]->html)) echo $objs[0]->html; } ?>   
            </div>
      <div class='summary'>
        <?= nl2br($project->summary) ?>
      </div>
    <p> 
        Started on <strong><?= date("F jS, Y", $project->dateAdded) ?></strong> <br/> 
        <strong>30 days</strong> to go with <strong><? $project->getBackers(); echo count($project->backers) ?> backers</strong> <br/>  
        <strong>$<?= $project->totalFunding ?></strong> raised so far</p>
      </div>
    <? endforeach; ?>
  </div>
  </div>
</div>