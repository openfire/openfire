<? global $embedly; ?>
<li class='goal list <?= $this->goal->status ?><? if($this->goal->isCurrent == 1): echo " current"; else: echo " muted"; endif; ?> well well-small'>
	<h4><a href='/goals/<?= $this->goal->uuid ?>'><?= $this->goal->name ?></a><? if($this->goal->isCurrent == 1): ?> <span class='label label-warning'>Current</span><? endif; ?></h4>
	<div class='row-fluid'>
	
		<div class='span6'>
	<div class='summary'><?= nl2br($this->goal->summary) ?></div>
</div>
<div class='span6'>
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
	<? if($this->goal->isCurrent == 1):?><div style='text-align:right; margin-top: 1em'>
		<a href='/goals/<?= $this->goal->uuid ?>/fund' class='btn btn-large btn-success'>Fund This Goal</a>
</div><? endif; ?>
</li>