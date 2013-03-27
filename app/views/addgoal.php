<script>

$(function() {

var i = 0;



	$('#addReward').click(function(){
		$('#rewardList').prepend("<div class='reward well well-small' id='reward" + i + "'><fieldset><label for='reward[" + i + "][name]'>Reward Name</label><input type='text' name='reward[" + i + "][name]' class='input-xxlarge'></fieldset><fieldset><label for='image'>Reward Image</label><input type='file' name='rewardimages[" + i + "]'></fieldset><fieldset><label for='description'>Description</label><textarea name='reward[" + i + "][description]' class='input-xxlarge'></textarea></fieldset><fieldset><label for='reward[" + i + "][minAmount]'>Funding Amount</label>$<input type='text' name='reward[" + i + "][minAmount]' value='10'></fieldset><fieldset><label for='numTotal'>Number Available</label><input type='text' name='reward[" + i + "][numTotal]'></fieldset><fieldset><label for='status'>Status</label><select name='reward[" + i + "][status]'><option value='draft'>Draft</option><option value='published'>Published</option></select></fieldset><div class='form-actions'><span class='removeReward btn' data-parent='reward" + i + "'>Remove This Reward</span></div>");
		i++;

	$('.removeReward').on('click', function(){
		var theparent = "#" + $(this).attr('data-parent');
		$(theparent).remove();
	});

	});


});

</script>
<div class='span8'>

		<form enctype="multipart/form-data" action='' method='post' data-validate='parsley'>
			<input type="hidden" name="MAX_FILE_SIZE" value="100000000" />
	<legend>Add Goal</legend>
	<input type='hidden' name='projectUUID' value='<?= $this->project->uuid ?>'>
	<fieldset>
		<label for='goalName'>Name</label>
		<input type='text' class='input-xxlarge' name='goalName'  data-required='true' data-error-message='Your goal must have a name.'>
	</fieldset>
	<fieldset>
		<label for='mediaEmbed'>Media URL</label>
		<input type='text' class='input-xxlarge' name='mediaEmbed' placeholder='e.g. http://www.youtube.com/watch?v=oHg5SJYRHA0'  data-required='true' data-error-message='Your goal must have a video URL.'>
	</fieldset>
	<fieldset>
		<label for='summary'>Summary (optional)</label>
		<textarea style='height: 12em' class='input-xxlarge' name='summary'></textarea>
	</fieldset>
	<fieldset>
		<label for='description'>Description</label>
		<textarea style='height: 12em' class='input-xxlarge' name='description' data-required='true' data-error-message='Your goal must have a description.'></textarea>
	</fieldset>

	<fieldset>
		<label for='targetAmount'>Funding Target</label>
		<div class="input-prepend">
  <span class="add-on">$</span>
  <input class="input-xlarge" name='targetAmount' type="text" placeholder="In US dollars" data-required='true' data-error-message='Your goal must have a funding target.'>
</div>
	</fieldset>
<fieldset>
			<label for='targetMonth'>Target Completion Date For Goal</label>
			<select name='targetMonth'>
			<? for($i = 1; $i < 13; $i++): ?>
			<option value='<?= sprintf("%02d", $i) ?>'<? $nextMonth = sprintf("%02d", $i); if($nextMonth == date("m") + 1){ echo " selected='selected'";} ?>><?= date("F", mktime(0, 0, 0, $i, 10)) ?></option>
		<? endfor; ?>
	</select> <select name='targetDay' class='input-small'>
			<? for($i = 1; $i < 32; $i++): ?>
			<option value='<?= sprintf("%02d", $i) ?>'<? $thisDay = sprintf("%02d", $i); if($thisDay == date("d")){ echo " selected='selected'";} ?>><?= sprintf("%02d", $i) ?></option>
		<? endfor; ?>
	</select>
	</select> <select name='targetYear' class='input-small'>
			<? for($i = 0; $i < 2; $i++): ?>
			<option value='<?= date("Y") + $i ?>'><?= date("Y") + $i ?></option>
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
<fieldset>
					<legend>Rewards</legend>
					<span class='help-block'>Rewards are your thanks to people who support your goals and project. Unlike other crowdfunding platforms, Openfire goal rewards don't have to be tangible. But they can be.</span>
					<div class='btn' id='addReward'><i class='icon-plus-sign'></i> Add A Reward</div>
					<div id='rewardList'></div>
				</fieldset>
	<div class='form-actions'>
<button class='btn btn-info' type='submit' name='status' value='draft'>Save As Draft</button>
<button class='btn' type='submit' name='status' value='publish'>Publish</button>

	</div>

</form>

</div>
<div class='span3'>
	<h3><i class='icon-info-sign'></i> Adding A Goal</h3>
<p><b>Goals</b> are the most important part of your project: they're how you raise money and bring in collaborators for your project.</p>
<p>When creating a goal for your project, remember that a goal must be specific, finite, realistic, and achievable with the target funding amount you set. An example of a bad goal might be &quot;Change The World&quot; or &quot;End World Hunger&quot;. (Unless you can actually do these things in a finite amount of time with a realistic amount of money, in which case, we're really excited to see your plan.)</p>
<p>Another bad goal might be &quot;Build New High School&quot; with a target funding amount of $2,000...because while the goal is realistic and finite, it's unlikely to be achieved with the funding amount you've decided upon.</p>
<p>Each goal must have a <b>funding target</b> and a <b>target completion date</b> for raising those funds. Goals can be aimed at either <b>complete</b> funding (where your project only receives the funds if you meet your target amount by your target date) or <b>partial</b> funding (where you receive all funds, whether you meet your goal or not).</p><p>When you're first starting your openfire project, you'll only be able to create goals with complete funding; once you've met three of those, and proven your ability to get things done, you can begin adding partial goals.</p>
<p><b>Currently, you can only have one current goal running at a time</b>. You cannot set a new goal to be current until the existing current goal has either failed or succeeded.</p>


	</div>