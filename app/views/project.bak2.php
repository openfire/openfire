<? global $user; global $embedly; $partials = new Templater(); ?>
<div class='span8 project'>
	<h1 class='title'><img src='<?= $this->project->icon ?>' class='project-icon-inline'> <?= $this->project->title ?></h1>
	<h2 class='subtitle'><?= $this->project->subtitle ?></h2>

	<div class='media'>
		<? if(!empty($this->project->mediaEmbed)){ $objs = $this->embedly->oembed(array('url' => $this->project->mediaEmbed, 'maxwidth' => '640')); if(!empty($objs[0]->html)) echo $objs[0]->html; } ?>
	</div>

	<div class='description'>
		<?= nl2br($this->project->description) ?>
	</div>

</div>
<div class='span4 sidebar'>
	<div class='item currentGoal'>
		<h3><i class='icon-check'></i> Current Goal </h3>


		<?	$partials->load('partial-goal-micro'); 
	      $partials->goal = $this->currentGoal; 
	      $partials->project = $this->project;
	      $partials->showProject = false;
	      $partials->showProjectIcon = false;

	      $partials->mediaWidth = 320;
	      $partials->publish();

	      ?>

		<h4 style='text-align:right'><a href='/projects/<?= $this->project->slug ?>/goals'>(See All Goals)</a></h4>
	</div>

	<div class='item team'>
		<h3><i class='icon-user'></i> Team</h3>
		<ul class='unstyled'>
		<? foreach($this->project->team as $member):?>
		<li><h4><a href='/users/<?= $member->username ?>'><img src='<?= $member->avatar ?>' class='avatar-small'> <?= $member->username ?></a><? if($member->id == $this->project->creatorID) :?> <span class='label'>Project Creator</span><? endif; ?></h4></li>
	<? endforeach; ?>
		</ul>
	</div>

</div>