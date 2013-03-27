<div class='span8'>

			<div>
				<h1><?= $this->project->title ?></h1>				<h3><?= $this->project->subtitle ?></h3>

				<div style='text-align:center'><? if(!empty($this->project->mediaEmbed)){ $objs = $this->embedly->oembed(array('url' => $this->project->mediaEmbed, 'maxwidth' => '640')); echo $objs[0]->html; } ?>
				</div>
				
				<hr>
				<div><?= nl2br($this->project->description) ?></div>
			</div>
<br><br>
<h2>Updates</h2>
<? foreach($this->project->updates as $update): ?>
<div class='well well-small'>
	<h4><?= date("m-d-Y") ?> | <?= $update->title ?></h4>

	<div><?= trimtopcount($update->body,2) ?><p style='text-align:right'><a href='/update/<?= $update->uuid ?>'>View full update</a></p> </div>
	</div>
<? endforeach; ?>
<div style='text-align:right'><a href='/projects/<?= $this->project->slug ?>/updates'>View all updates</a></div>
</div>
<div class='span4'>
	<div class='well well-small'>
		<h3>Current Goal &raquo; <a href='/goals/<?= $this->currentGoal->uuid ?>'><?= $this->currentGoal->name ?></a></h3>
				<div style='text-align:center'>
					
					<?



// Single url
if(!empty($this->currentGoal->mediaEmbed)) {$objs = $this->embedly->oembed(array('url' => $this->currentGoal->mediaEmbed, 'maxwidth' => '350'));
echo $objs[0]->html;
}

?>

				</div>
				<hr>
				<div><?= trimtopcount($this->currentGoal->description, 2) ?></div>
<hr>

										<div class="progress<?
$goalPercentage = ($this->currentGoal->currentAmount / $this->currentGoal->targetAmount) * 100;
if($this->currentGoal->status != "success") echo " progress-striped";

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
		      		<h4>$<?= number_format($this->currentGoal->currentAmount,2) ?> of $<?= number_format($this->currentGoal->targetAmount, 2) ?> raised, with <?= $this->currentGoal->daysUntilTarget ?> days left</h4><br>
		      		<div style='text-align:center; margin-top: 1em'><a href='/goals/<?= $this->currentGoal->uuid ?>/fund' class='btn btn-large btn-success'>Fund This Goal</a></div>


		</div>
		<div style='text-align:right'><a href='/projects/<?= $this->project->slug ?>/goals'>See all goals</a></div><br><br>

		<div class='well well-small'>
			<h2>Team <small>(<?= count($this->project->team) ?>)</small></h2>
			<ul class="thumbnails">

		<? $limitteam = array_slice($this->project->team, 0, 9); foreach($limitteam as $member): ?>
		<li class="span4">
    <div class="thumbnail">
      <a href='/users/<?= $member->username ?>'><img src="<?= $member->avatar ?>" alt="<?= $member->avatar ?>">
      <div style='text-align:center'><small><?= $member->username ?></small></div></a>
    </div>
  </li>
	<? endforeach; ?>
</ul>
		</div>
		<div style='text-align:right'><a href='/projects/<?= $this->project->slug ?>/team'>See all team members</a></div><br><br>


		<div class='well well-small'>
			<h2>Backers <small>(<?= count($this->project->backers) ?>)</small></h2>
			<ul class="thumbnails">

		<? $limitbackers = array_slice($this->project->backers, 0, 9); foreach($limitbackers as $backer): ?>
		<li class="span4">
    <div class="thumbnail">
      <a href='/users/<?= $backer->username ?>'><img src="<?= $backer->avatar ?>" alt="<?= $backer->avatar ?>">
      <div style='text-align:center'><small><?= $backer->username ?></small></div></a>
    </div>
  </li>
	<? endforeach; ?>
</ul>
		</div>
		<div style='text-align:right'><a href='/projects/<?= $this->project->slug ?>/backers'>See all backers</a></div><br><br>



</div>