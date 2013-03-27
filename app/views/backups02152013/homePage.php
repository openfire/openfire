<? global $user; ?><div class='span8'>
				<h1>featured goals</h1>
				<div id="myCarousel" class="carousel slide  well well-small">
  <!-- Carousel items -->
  <div class="carousel-inner">

<? foreach($this->featuredgoals as $index => $fg): $goal = $fg['goal']; $description = $fg['description'];  $gp = new Project($goal->projectID); ?>
    <div class="<? if($index == 0) echo "active " ?>item">

      <div class='span10 offset1'>

        <div class='text-align:center'><? if(!empty($goal->mediaEmbed)){ $objs = $this->embedly->oembed(array('url' => $goal->mediaEmbed, 'maxwidth' => '640')); echo $objs[0]->html; } ?></div>

<div style='font-size: 2em; margin: 1em auto 1em auto'><span style='font-weight: 300'><a href='/projects/<?= $gp->slug ?>'><?= strtolower($gp->title) ?></a></span> &raquo; <span style='font-weight:bold'><a href='/goals/<?= $goal->uuid ?>'><?= strtolower($goal->name) ?></a></span></div>

        <div class='lead'><?= nl2br($description) ?></div>
        <div class="progress<?
$goalPercentage = ($goal->currentAmount / $goal->targetAmount) * 100;
if($goal->status != "success") echo " progress-striped";

              switch(true){

                case($goal->daysUntilTarget < 5 && $goalPercentage < 50):
                echo " progress-danger";

                break;

                case($goal->daysUntilTarget < 5 && $goalPercentage < 90):
                echo " progress-warning";

                break;

                case($goalPercentage > 66 || $goal->daysUntilTarget > 5):
                echo " progress-success";
                break;



              }

              ?>">
            <div class="bar" style="width: <?= $goalPercentage ?>%"></div>
              </div>
              <h3>$<?= number_format($goal->currentAmount,2) ?> of $<?= number_format($goal->targetAmount, 2) ?> raised, with <?= $goal->daysUntilTarget ?> days left</h3><br>
              <div style='text-align:center; margin-top: 1em'><a href='/goals/<?= $goal->uuid ?>/fund' class='btn btn-large btn-success'>Fund This Goal</a></div>
</div>
</div>
<? endforeach; ?>
  </div>
  <!-- Carousel nav -->
  <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
  <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
</div>
<br><br>
<h2>recent updates</h2>
<? foreach($this->recentupdates as $update): ?>
<div class='well well-small'>
  <h3><a href='/updates/<?= $update->uuid ?>'><?= $update->title ?></a></h3>
  <h4>posted by <a href='/users/<?= $update->user->username ?>'><?= $update->user->username ?></a> in <a href='/projects/<?= $update->project->slug ?>'><?= strtolower($update->project->title) ?></a> &raquo; <a href='/goals/<?= $goal->uuid ?>'><?= strtolower($goal->name) ?></a> on <?= date("m-d-Y", $update->dateAdded) ?></h4>
  <div><?= trimtopcount($update->body, 2) ?><p style='text-align:right'><a href='/updates/<?= $update->uuid ?>'>Show More</a></p></div>
  <h4>
</div>
<? endforeach; ?>

			</div>

			<div class='span4'>
        <h1><img src='/img/logo_textual.png' style='height: 1em'></h1>
        <div class='well well-small'>
         <p><b>openfire</b> is a funding and development platform for long-term, socially valuable projects. We help connect project founders with the team, mentors and financial backers they need to make their projects a success.</p>
         <p><a href='/about'>Find out more</a> about openfire, or 
          <? if(!empty($user->id)): ?><a href='createProject'>create your own project</a><? else: ?><a href='/signup'>get started</a><? endif; ?> today!</p>
        </div>
<br><br>
        <h2>new projects</h2>
        <? foreach($this->recentprojects as $project): ?>
        <div class='well well-small'>
          <div style='text-align:center'><? if(!empty($project->mediaEmbed)){ $objs = $this->embedly->oembed(array('url' => $project->mediaEmbed, 'maxwidth' => '320')); echo $objs[0]->html; } ?></div>
          <h3><a href='/projects/<?= $project->slug ?>'><?= $project->title ?></a></h3>

          <h4><?= $project->subtitle ?></h4>
          <div><?= trimtopcount($project->description, 2) ?></div>
          <p style='text-align:right'><a href='/projects/<?= $project->slug ?>'>Explore this project</a></p>
        </div>
      <? endforeach; ?>





			</div>