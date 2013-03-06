<? global $embedly; ?>
<div class='goal mini row-fluid'>
      <div class='media span6'>
      	<? if(!empty($this->goal->mediaEmbed)){ if(empty($this->mediaWidth)) $this->mediaWidth = 320; $objs = $embedly->oembed(array('url' => $this->goal->mediaEmbed, 'maxwidth' => $this->mediaWidth)); if(!empty($objs[0]->html)) echo $objs[0]->html; } ?>
      </div>
      <div class='span6'>

	      	<h3><a href='/projects/<?= $this->project->slug ?>'><? if(!empty($this->showProjectIcon)): ?><a href='/projects/<?= $this->project->slug ?>'><img class='project-icon-med' src='<?= $this->project->icon ?>'></a> <? endif; ?> <a href='/goals/<?= $this->goal->uuid ?>'><?= $this->goal->name ?></a></h3>
	      	<? if(!empty($this->showProject)): ?><h5>Project: <a href='/projects/<?= $this->project->slug ?>'><?= $this->project->title ?></a></h5><? endif; ?>
	      <div class='description'><?= trimtowcount($this->goal->description, 60) ?>...(<a href='/goals/<?= $this->goal->uuid ?>'>More</a>)</div>
	      <div class='funding'>
		  	<div class="progress <? if ($this->goal->currentAmount < $this->goal->targetAmount) echo 'progress-striped active'; ?>">
				 <div class="bar bar-success" style="width: <?= ($this->goal->currentAmount / $this->goal->targetAmount) * 100 ?>%;"></div>
			</div>
			<h3>$<?= $this->goal->currentAmount ?> raised of $<?= $this->goal->targetAmount ?> goal (<?= ($this->goal->currentAmount / $this->goal->targetAmount) * 100 ?>%)</h3>
			<h3><?= count($this->goal->backers) ?> backers</h3><br><a href='/goals/<?= $this->goal->uuid ?>/fund' class='btn btn-success'>Fund This Goal</a>

			</div>
  		</div>
    </div>
