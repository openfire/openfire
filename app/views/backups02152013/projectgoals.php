	<ul class="breadcrumb">
  <li><b><a href="/projects/<?= $this->project->slug ?>"><?= $this->project->title ?></a></b> <span class="divider">><span></li>
  <li>Goals</li>

</ul>
</div>
<div class='row-fluid'>
<div class='span4'>
	<? foreach($this->project->goals as $goal): ?>
	<div class='well well-small'>
		<h3><a href="/goals/<?= $goal->uuid ?>"><?= $goal->name ?></a> <? if($this->project->currentGoalID == $goal->id):?><span class='label'>Current</span><? endif; ?></h3>

<div style='text-align:center'>
					
					<?



// Single url
if(!empty($goal->mediaEmbed)) {$objs = $this->embedly->oembed(array('url' => $goal->mediaEmbed, 'maxwidth' => '350'));
echo $objs[0]->html;
}

?>

				</div>
				<hr>
				<div><?= trimtopcount($goal->description, 2) ?></div>
<hr>

										<div class="progress<?
$goalPercentage = ($goal->currentAmount / $goal->targetAmount) * 100;
if($goal->status != "success") echo " progress-striped";

							switch(true){

								case($goalPercentage < 33):
								echo " progress-danger";

								break;

								case($goalPercentage > 33 && $goalPercentage < 50):
								echo " progress-warning";

								break;

								case($goalPercentage > 66):
								echo " progress-success";
								break;



							}

							?>">
		      	<div class="bar" style="width: <?= $goalPercentage ?>%"></div>
      				</div>
		      		<h4>$<?= number_format($goal->currentAmount,2) ?> of $<?= number_format($goal->targetAmount, 2) ?> raised, with <?= $goal->daysUntilTarget ?> days left</h4><br>
		      		<div style='text-align:center; margin-top: 1em'><a href='/goals/<?= $goal->uuid ?>/fund' class='btn btn-large btn-success'>Fund This Goal</a></div>

	</div>
<? endforeach; ?>
</div>