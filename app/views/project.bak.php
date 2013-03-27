<? global $user; global $embedly; $partials = new Templater(); ?>
<div class='span8 project'>
	<h1 class='title' style='text-align:center'><?= $this->project->title ?></h1>
	<h3 class='subtitle' style='text-align:center'><?= $this->project->subtitle ?></h3>

	<div class='media'>
		<? if(!empty($this->project->mediaEmbed)){ $objs = $this->embedly->oembed(array('url' => $this->project->mediaEmbed, 'maxwidth' => '640')); if(!empty($objs[0]->html)) echo $objs[0]->html; } ?>
	</div>
	<div class='social' style='text-align:cen'>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style ">
<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
<a class="addthis_button_tweet"></a>
<a class="addthis_button_pinterest_pinit"></a>
<a class="addthis_counter addthis_pill_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-512e9539719dfdf8"></script>
<!-- AddThis Button END -->
	</div>
<div class='generalInfo'>
	
		<div class='summary'>
			<?= $this->project->summary ?>
		</div>


	<div class='details'>
		<ul class='nav nav-tabs'>
			<li class='active'>
				<a href='#about' data-toggle='tab'>About</a>
			</li>
			<li>
				<a href='#goals' data-toggle='tab'>Goals</a>
			</li>
			<li>
				<a href='#updates' data-toggle='tab'>Updates</a>
			</li>
			<li>
				<a href='#team' data-toggle='tab'>Team</a>
			</li>
			<li>
				<a href='#backers' data-toggle='tab'>Backers</a>
			</li>
		</ul>
		<div class="tab-content">
 			 <div class="tab-pane active" id="about">
 			 	<h2>About <?= $this->project->title ?></h2>
 			 		<?= nl2br($this->project->description) ?>
 			 </div>
		  
		  <div class="tab-pane" id="goals">
		  	<h2>Goals</h2>
		  	<ul class='unstyled goalList'>
		  	<? $partials->load('partial-goal-list');
		  	foreach($this->project->goals as $goal): 
		  		$partials->goal = $goal;
		  		$partials->publish();
			endforeach; ?>
		  </div>
	</div>
</div>
</div>
</div>
<div class='span4 sidebar'>
	<div class='currentGoal well well-small'>
	<h4 style='font-weight: 300; text-align:center'>Help Fund Our Current Goal!</h4>
	<? $partials->load('partial-goal-micro');
		  	
		  		$partials->goal = $this->currentGoal;
		  		$partials->publish();
		  		?>
		  	</div>
	</div>