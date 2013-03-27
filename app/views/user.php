<div class='span8'>
	<div class='row-fluid'>
	<div class='span2'><a href='<?= $this->displayUser->avatar ?>' target='_new'><img src='<?= $this->displayUser->avatar ?>' class='avatar-large'></a> </div>
	<div class='span10'>
	<h2><?= $this->displayUser->username ?></h2>
	<h3>Real name: <?= $this->displayUser->fullName ?></h3>
	<h4 class='location'><?= $this->displayUser->location ?></h4>
	<h4>Bio</h4>
	<div class='bio'><?= nl2br($this->displayUser->bio) ?></div>
</div>
	</div>
</div>

<div class='span4 sidebar'>
<h3>Projects</h3>
<? foreach($this->displayUser->projects as $project): if($project->status == 'published'): ?>
<div class='well well-small'>
	<div class='row-fluid'>
		<div class='span2'>
			<img src='<?= $project->icon ?>' class='project-icon-med'>
		</div>
			<div class='span10'>
				<h4><a href='/projects/<?= $project->slug ?>'><?= $project->title ?></a></h4>
			<p>Role: <?= $project->userRole ?></p>
		</div>
		</div>
</div>
<? endif; endforeach; ?>
<h3>Backed Goals</h3>
<? foreach($this->displayUser->backedGoals as $goal): $gproject = new Project($goal->projectID) ?>
<div class='well well-small'>

				<h4><a href='/projects/<?= $gproject->slug ?>'><?= $gproject->title ?></a> | <a href='/goals/<?= $goal->uuid ?>'><?= $goal->name ?></a></h4>
</div>
<? endforeach; ?>
	</div>