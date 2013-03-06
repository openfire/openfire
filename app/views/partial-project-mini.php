<? global $embedly; ?>
<div class='project mini row-fluid'>
	<div class='span6'>
		<div class='media'>
      	<? if(!empty($this->project->mediaEmbed)){ if(empty($this->mediaWidth)) $this->mediaWidth = 320; $objs = $embedly->oembed(array('url' => $this->project->mediaEmbed, 'maxwidth' => $this->mediaWidth)); if(!empty($objs[0]->html)) echo $objs[0]->html; } ?>
      </div>
     </div>
     <div class='span6'>
<h3><a href='/projects/<?= $this->project->slug ?>'><img class='project-icon-small' src='<?= $this->project->icon ?>'> <?= $this->project->title ?></a></h3>

<div class='description'><?= $this->project->summary ?> <a href='/projects/<?= $this->project->slug ?>'>...(More)</a></div>
</div>
</div>