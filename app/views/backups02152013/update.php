<ul class="breadcrumb">
  <li><a href="/projects/<?= $this->project->slug ?>"><?= $this->project->title ?></a> <span class="divider">></span></li>
  <li><a href="/goals/<?= $this->update->goal->uuid ?>"><?= $this->update->goal->name ?></a><span class="divider">></span></li>
  <li><?= $this->update->title ?></li>
</ul>
</div>
<div class='row-fluid'>
<div class='span8 well well-small'>

<div class='row-fluid'>
	<h2><?= date("m-d-Y", $this->update->dateAdded) ?> : <?= $this->update->title ?></h2>

	<div class='body span10'><?= nl2br($this->update->body) ?></div>
</div>
<div class='row-fluid'>
	<div class='meta' style='text-align:right; margin-top: 1em; font-weight: bold'><small>Posted by <a href='/users/<?= $this->update->user->username ?>'><?= $this->update->user->username ?></a> on <a href='/projects/<?= $this->project->slug ?>/updates/<?= $this->update->uuid ?>'><?= date("m-d-Y", $this->update->dateAdded) ?> at <?= date("h:ia", $this->update->dateAdded) ?></a></small>
	</div>
</div>
</div>