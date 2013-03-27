<? global $embedly; ?>
<div class='goal mini'>
		      	<h3><? if(!empty($this->showProjectIcon)): ?><a href='/projects/<?= $this->project->slug ?>'><img class='project-icon-med' src='<?= $this->project->icon ?>'></a> <? endif; ?> <a href='/goals/<?= $this->goal->uuid ?>'><?= $this->goal->name ?></a><? if($this->goal->isCurrent == 1): ?> <span class='label label-warning'>Current</span><? endif; ?></h3>
	      	<? if(!empty($this->showProject)): ?><h5>Project: <a href='/projects/<?= $this->project->slug ?>'><?= $this->project->title ?></a></h5><? endif; ?>
      <div class='media'>
      	<? if(!empty($this->goal->mediaEmbed)){ if(empty($this->mediaWidth)) $this->mediaWidth = 320; $objs = $embedly->oembed(array('url' => $this->goal->mediaEmbed, 'maxwidth' => $this->mediaWidth)); if(!empty($objs[0]->html)) echo $objs[0]->html; } ?>
      </div>
      <div>


	      <div class='description'><?= $this->goal->summary ?></div>
	      <div class='funding'>
		  	<div class="progress <? if ($this->goal->currentAmount < $this->goal->targetAmount) echo 'progress-striped active'; ?>">
				 <div class="bar bar-success" style="width: <?= ($this->goal->currentAmount / $this->goal->targetAmount) * 100 ?>%;"></div>
			</div>
	<ul class='stats'>
		<li><span class='statBig'>$<?= $this->goal->currentAmount ?></span> raised of<br><span class='statBig'>$<?= $this->goal->targetAmount ?></span> target</li>
		        <li class="divider-vertical"></li>

		<li><span class='statBig'><?= count($this->goal->backers) ?></span> backers</li>
		        <li class="divider-vertical"></li>
		<li><span class='statBig'><?= $this->goal->daysUntilTarget ?></span> days left</li>
	</ul>
	<div style='text-align:center; margin-top: 1em'>
		<a href='/goals/<?= $this->goal->uuid ?>/fund' class='btn btn-large btn-success'>Fund This Goal</a>
</div>

  		</div>
  		<? if(!empty($this->goal->rewards)): ?>
	<h3>Swag</h3>
	<ul class='rewards'>
		<? foreach($this->goal->rewards as $reward): ?>
		<li><div><b>$<?= $reward->minAmount ?>+</b> <?= nl2br($reward->description) ?><? if($reward->numTotal > 0): ?> (<?= $reward->numStillAvailable ?> of <?= $reward->numTotal ?> left)<? endif; ?></div>
		</li>
 	<? endforeach; ?>

	</ul>
<? endif; ?>
    </div>
