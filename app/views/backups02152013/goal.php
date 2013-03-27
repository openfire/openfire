	<ul class="breadcrumb">
  <li><b><a href="/projects/<?= $this->project->slug ?>"><?= $this->project->title ?></a></b> <span class="divider">><span></li>
  <li><?= $this->goal->name ?></li>

</ul>
</div>
<div class='row-fluid'>
<div class='span8'>

<h2><img src='<?= $this->project->icon ?>' style='width: 64px'> <?= $this->goal->name ?></h2>
<div style='text-align:center'><? if(!empty($this->goal->mediaEmbed)){ $objs = $this->embedly->oembed(array('url' => $this->goal->mediaEmbed, 'maxwidth' => '640')); echo $objs[0]->html; } ?></div>
<div class='description' style='margin-bottom: 2em'><?= nl2br($this->goal->description) ?></div>

<h3>Updates</h3>
<? foreach($this->goal->updates as $update): ?>
<div class='well well-small'>
	<h3><?= date("m-d-Y", $update->dateAdded) ?> : <a href='/updates/<?= $update->uuid ?>'><?= $update->title ?></a></h3>
	<div class='body'><?= nl2br(trimtowcount($update->body, 20)) ?>... <a href='/updates/<?= $update->uuid ?>'>More</a></div>	
	<div class='meta' style='text-align:right; margin-top: 1em; font-weight: bold'><small>Posted by <a href='/users/<?= $update->user->username ?>'><?= $update->user->username ?></a> on <a href='/updates/<?= $update->uuid ?>'><?= date("m-d-Y", $update->dateAdded) ?> at <?= date("h:ia", $update->dateAdded) ?></a></small>
	</div>
</div>
<? endforeach; ?>
</div>
<div class='span4'>
	<div class='well well-small'>
		<h2>Progress</h2> 
		<div class="progress<?
$goalPercentage = ($this->goal->currentAmount / $this->goal->targetAmount) * 100;
if($this->goal->status != "success") echo " progress-striped";

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
		      		<h4>$<?= number_format($this->goal->currentAmount,2) ?> of $<?= number_format($this->goal->targetAmount, 2) ?> raised, with <?= $this->goal->daysUntilTarget ?> days left</h4><br>
		      		<div style='text-align:center; margin-top: 1em'><a href='/goals/<?= $this->goal->uuid ?>/fund' class='btn btn-large btn-success'>Fund This Goal</a></div>
	</div>
</div>