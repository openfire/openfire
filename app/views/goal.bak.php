<? global $user; global $embedly; $partials = new Templater(); ?>
<div class='span8'>
	<div class='goal'>
		      	<h1><?= $this->goal->name ?></a></h1>

	      <div class='media'>
	      	<? if(!empty($this->goal->mediaEmbed)){ if(empty($this->mediaWidth)) $this->mediaWidth = 320; $objs = $embedly->oembed(array('url' => $this->goal->mediaEmbed, 'maxwidth' => '640')); if(!empty($objs[0]->html)) echo $objs[0]->html; } ?>
	      </div>


		      <div class='description'><?= $this->goal->description ?></div>
	</div>
</div>
<div class='span4 sidebar'>
<div class='funding item widget'>
	<h3>Progress</h3>
	<div class="progress">
		<div class="bar" style="width: <?= ($this->goal->currentAmount / $this->goal->targetAmount) * 100 ?>%;"></div>
		</div>
		<h4>$<?= $this->goal->currentAmount ?> of $<?= $this->goal->targetAmount ?> raised from <?= count($this->goal->backers) ?> backers</h4><p style='text-align:right'><a href='/goals/<?= $this->goal->uuid ?>/fund' class='btn btn-success'>Fund This Goal</a></p>

	</div>
	<div class='rewards item'>
		<? print_r($this->goal->rewards) ?>
	</div>
 <div class='backers item'>
 	<h3>Backers</h3>
 			<ul class='unstyled'>
		<? foreach($this->goal->backers as $member):?>
		<li><h4><a href='/users/<?= $member->username ?>'><img src='<?= $member->avatar ?>' class='avatar-small'> <?= $member->username ?></a></h4></li>
	<? endforeach; ?>
		</ul>
 </div>
</div>