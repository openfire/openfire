<h2><a href='/manageProject/<?= $this->project->uuid ?>'><?= $this->project->title ?></a>: <?= $this->goal->name ?></h2>
</div>
<div class='row-fluid'>
	<div class='span2'>
			<ul class='nav nav-pills nav-stacked'>
				<li class='active'><a href='#overview' data-toggle=tab>Overview</a></li>
		<li><a href='#details' data-toggle=tab>Goal Details</a>
		<li><a href='#updates' data-toggle=tab>Updates</a>
		<li><a href='#backers' data-toggle=tab>Backers</a>

	</ul>
	</div>
<div class='span7 tab-content'>
	<div id='overview'  class='tab-pane fade in active'>
		<legend>Overview</legend>
		<div class='well well-small'>
			<div class="progress">
  <div class="bar" style="width: <?= ($this->goal->currentAmount / $this->goal->targetAmount) * 100 ?>%;"></div>
</div>
	<h5>$<?= number_format($this->goal->currentAmount,2) ?> raised of $<?= number_format($this->goal->targetAmount,2) ?> from <a href='#backers' data-toggle='tab'><?= count($this->goal->backers) ?> backers</a></h5>
	<h5><?= $this->goal->daysUntilTarget ?> days remaining
		</div>

	</div>

	<div id='details' class='tab-pane fade in'>
		<form action='' method='post'>
			<input type='hidden' name='action' value='updateGoal'>
			<legend>Goal Details</legend>
			<input type='hidden' name='goalUUID' value='<?= $this->goal->uuid ?>'>
			<fieldset>
				<label for='goalName'>Name</label>
				<input type='text' class='input-xxlarge' name='goalName' value='<?= $this->goal->name ?>'>
			</fieldset>
			<fieldset>
				<label for='mediaEmbed'>Media URL</label>
				<input type='text' class='input-xxlarge' name='mediaEmbed' placeholder='e.g. http://www.youtube.com/watch?v=oHg5SJYRHA0' value='<?= $this->goal->mediaEmbed ?>'>
			</fieldset>
			<fieldset>
				<label for='description'>Description</label>
				<textarea style='height: 12em' class='input-xxlarge' name='description'><?= $this->goal->description ?></textarea>
			</fieldset>

			<fieldset>
				<label for='targetAmount'>Target Amount</label>
				<div class="input-prepend">
		  <span class="add-on">$</span>
		  <input class="input-xlarge" name='targetAmount' type="text" placeholder="In US dollars" value='<?= $this->goal->targetAmount ?>'>
		</div>
			</fieldset>
		<fieldset>
					<label for='targetMonth'>Target Completion Date For Goal</label>
					<select name='targetMonth'>
					<? for($i = 1; $i < 13; $i++): ?>
					<option value='<?= sprintf("%02d", $i) ?>'<? $nextMonth = sprintf("%02d", $i); if(sprintf("%02d", $i) == $this->goalCompletion['month']){ echo " selected='selected'";} ?>><?= date("F", mktime(0, 0, 0, $i, 10)) ?></option>
				<? endfor; ?>
			</select> <select name='targetDay' class='input-small'>
					<? for($i = 1; $i < 32; $i++): ?>
					<option value='<?= sprintf("%02d", $i) ?>'<? $thisDay = sprintf("%02d", $i); if(sprintf("%02d", $i) == $this->goalCompletion['day']){ echo " selected='selected'";} ?>><?= sprintf("%02d", $i) ?></option>
				<? endfor; ?>
			</select>
			</select> <select name='targetYear' class='input-small'>
					<? for($i = 0; $i < 2; $i++): ?>
					<option value='<?= date("Y") + $i ?>'<? if(date("Y") + $i == $this->goalCompletion['year']){ echo " selected='selected'";} ?>><?= date("Y") + $i ?></option>
				<? endfor; ?>
			</select>
				</fieldset>
				<br>
				<fieldset>
					<label for='targetType'>Goal Type</label>
					<div class='well well-small'><input type='radio' name='targetType' value='complete' checked='checked'> <b>Complete:</b> this goal must reach its target amount by its completion date, or your project will not receive any of the funds raised.
					</div>
					<div class='well well-small muted'><input type='radio' name='targetType' value='partial' disabled='disabled'> <b>Partial:</b> your project will receive all of the funds raised for this goal whether you reach your target amount by the completion date or not.
					</div>
				</fieldset>

			<div class='form-actions'>
		<button class='btn btn-info' type='submit' name='status' value='draft'>Save As Draft</button>
		<button class='btn btn-success' type='submit' name='status' value='publish'>Publish</button>

			</div>

		</form>
	</div>

	<div id='updates' class='tab-pane fade in'>
		<legend>Updates<button class='btn pull-right' data-toggle="modal" onclick="$('#postUpdate').slideDown()"><i class='icon-plus-sign' style='color: #5bb75b'></i> Add Update</button></legend>

		<form id='postUpdate' style='display:none' action='' method='post' class='well well-small'>
			<input type='hidden' name='action' value='postUpdate'>
			<input type='hidden' name='goalUUID' value='<?= $this->goal->uuid ?>'>

		<h3>Add An Update</h3>
		<fieldset>
			<label for='title'>Title</label>
			<input type='text' class='span12' name='title'>
		</fieldset>
		<fieldset>
			<textarea name='body' class='span12' style='height: 8em'></textarea>
		</fieldset>
		<fieldset>
			<label for='public'>Type</label>
			<p><input type='radio' name='public' value='0'> <b>Private</b>: This update will be visible and emailed to team members and backers only.</p>
			<p><input type='radio' name='public' value='1' checked='checked'> <b>Public</b>: This update will be visible on this goal's page to anyone, as well as being emailed to backers and team members.</p>
		</fieldset>
			<div class='form-actions' style='text-align:right'>
				<button type='submit' class='btn'>Post Update</button>
			</div>
		</form>
		<h2>Updates</h2>
		<? $this->goal->getUpdates(); foreach($this->goal->updates as $update): ?>
		<div class='update well well-small'>
			<h3><?= $update->title ?></h3>
			<div>Posted by <?= $update->user->username ?> on <?= date("m-d-Y", $update->dateAdded) ?> at <?= date("h:ia", $update->dateAdded) ?></div>
			<div><?= nl2br($update->body) ?></div>
		</div>
	<? endforeach; ?>

	</div>

	<div id='backers' class='tab-pane fade in'>
		<legend>Backers</legend>
		<ul class="thumbnails">
  <?foreach($this->goal->backers as $backer): ?><li class="span2">
    <div class="thumbnail">
      <img src='<?= $backer->avatar ?>' style='height: 64px' alt="">
      <h5 style='text-align:center'><a href='/users/<?= $backer->username ?>'><?= $backer->username ?></a></h5>

    </div>
  </li>
<? endforeach; ?>
</ul>
	</div>

</div>
<div class='span3'>
	<h3><i class='icon-info-sign'></i> Adding A Goal</h3>
<p><b>Goals</b> are the most important part of your project: they're how you raise money and bring in collaborators for your project.</p>
<p>When creating a goal for your project, remember that a goal must be specific, finite, realistic, and achievable with the target funding amount you set. An example of a bad goal might be &quot;Change The World&quot; or &quot;End World Hunger&quot;. (Unless you can actually do these things in a finite amount of time with a realistic amount of money, in which case, we're really excited to see your plan.)</p>
<p>Another bad goal might be &quot;Build New High School&quot; with a target funding amount of $2,000...because while the goal is realistic and finite, it's unlikely to be achieved with the funding amount you've decided upon.</p>
<p>Each goal must have a <b>funding target</b> and a <b>target completion date</b> for raising those funds. Goals can be aimed at either <b>complete</b> funding (where your project only receives the funds if you meet your target amount by your target date) or <b>partial</b> funding (where you receive all funds, whether you meet your goal or not).</p><p>When you're first starting your openfire project, you'll only be able to create goals with complete funding; once you've met three of those, and proven your ability to get things done, you can begin adding partial goals.</p>
<p><b>Currently, you can only have one current goal running at a time</b>. You cannot set a new goal to be current until the existing current goal has either failed or succeeded.</p>


	</div>