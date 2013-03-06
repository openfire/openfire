<? global $user; global $embedly; $partials = new Templater(); ?>
<div class='span8'>
<h2>Projects</h2>
	<? foreach($this->projects as $project): ?>
	<div class='well well-small'>
	<div class='row-fluid'>
		<div class='span2'><a href='/projects/<?= $project->slug ?>'><img src='<?= $project->icon ?>' class='pull-left' style='height: 128px'></a></div>
		<div class='span10 pull-left'><h4><a href='/projects/<?= $project->slug ?>'><?= $project->title ?></a></h4>
			<div>Category: <b><?= $project->category['name'] ?></b></div>
		<div><?= trimtopcount($project->description, 1) ?></div>
		<div style='font-weight: bold'>Goals: <a href='/projects/<?= $project->slug ?>/goals'><?= count($project->goals) ?></a> | Backers: <?= count($project->backers) ?></div>
	</div>
</div>
	<div class='clearfix'></div>
	</div>

<? endforeach; ?>
</div>
<div class='span4'>
	<h3>Categories</h3>
<ul>
<? foreach($this->categories as $category): ?>
	<li><a href='/projects/categories/<?= $category->slug ?>'><?= $category->name ?> (<?= $category->numProjects ?>)</a></li>
<? endforeach; ?>
</ul>
</div>