<? global $embedly; ?>
<div class='project micro'>
<h4><a href='/projects/<?= $this->project->slug ?>'><img class='project-icon-small' src='<?= $this->project->icon ?>'> <?= $this->project->title ?></a></h4>
<div class='description'><?= trimtowcount($this->project->description, 45) ?>...</div>
</div>