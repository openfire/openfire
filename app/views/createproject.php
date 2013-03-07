<script>

$(function() {
	$("#summary").wordCounter({limit: 60});
	$("#goalSummary").wordCounter({limit: 60});

});
</script>
<div class='span7 well well-small'>
	<form action='' method='post' data-validate='parsley'>
		<legend><b><span class='circled'>1</span></b> Submit Project For Proposal <span class='muted'><br><span class='circled'>2</span> Complete Project Details<br><span class='circled'>3</span> Complete Initial Goal Details</span></legend>
		<span class="help-block">Fields with <b>*</b> are required.</span>
		<fieldset>
			<label for='title' style='font-size: 1.25em' ><b>*</b> Project Title</label><input type='text'class='input-xxlarge' name='title' placeholder='Title' data-required='true' data-error-message='Your project has to have a title.' > 
			<span class="help-block">This is the name of your project. This is the first thing people will see, so make it informative. And probably snappy. Yeah, snappy's good. Remember: <b>once you publish your project, you won't be able to change this.</b></span>
		</fieldset>
		<fieldset>
			<label for='categoryID'><b>*</b> Category</label>
			<select name='categoryID'>
				<? foreach($this->categories as $category): ?>
				<option value='<?= $category->id ?>' title='<?= $category->description ?>'><?= $category->name ?></option>
				<? if(!empty($category->subcategories)): foreach($category->subcategories as $subcat): ?>
				<option value='<?= $subcat->id ?>' title='<?= $subcat->description ?>'> - <?= $subcat->name ?></option>
			<? endforeach; endif; ?>

			<? endforeach; ?>
			</select>
			<span class="help-block">Don't obsess on this, just pick the best fit.</span>
		</fieldset>
		<fieldset>
			<label for='mediaEmbed'>Video URL</label><input type='text'class='input-xxlarge' name='mediaEmbed' placeholder='e.g. http://vimeo.com/58933055' data-required='true' data-error-message='Your project has to have a video file.' ><span class="help-inline" style='font-size:0.9em'>Optional</span>
			<span class="help-block">You need to have a video explaining your project.</span>
		</fieldset>
		<fieldset>
			<label for='summary'><b>*</b> Summary</label><textarea class='input-block-level' style='height: 12em' id='summary' name='summary' placeholder="60 words max." data-required='true' data-error-message='Your project has to have a summary.' ></textarea>
<span class="help-block">This is your elevator pitch. In sixty words or less, tell us what your project is about.</span>
		</fieldset>
		<hr>
		<fieldset>
			<legend>Initial Goal</legend>
			<span class="help-block">In order to submit a project, you must have an initial goal already figured out. </span>
			<label for='goalTitle'><b>*</b> Title</label>

			<input type='text' name='goalTitle'  class='input-xxlarge' placeholder='title of initial goal' data-required='true' data-error-message='Your goal has to have a title.' > 
									<span class="help-block">Every <b>project</b> begins with a <b>goal</b>: this is your first one. Tell us what your first goal is, how much you need to achieve it, and the date you want it to be finished.</span>
		</fieldset>
				<fieldset>
			<label for='goalMediaEmbed'>Media URL</label><input type='text'class='input-xxlarge' name='goalMediaEmbed' placeholder="e.g. http://vimeo.com/58933055" data-required='true' data-error-message='Your initial goal has to have a title.' > <span class="help-inline" style='font-size:0.9em'>Optional</span>
			<span class='help-block'>This can be the same as your project's media embed, for now.</span>
		</fieldset>
		<fieldset>
			<label for='goalSummary'>Summary</label>
			<textarea class='input-block-level' style='height: 12em' id='goalSummary' name='goalSummary' placeholder="60 words max." data-required='true' data-error-message='Your goal has to have a summary.' ></textarea>
<span class="help-block">A short description of your goal, for easy display.</span>

		<fieldset>
			<label for='goalDescription'><b>*</b> Description</label><textarea class='input-xxlarge' name='goalDescription' style='height:12em' data-required='true' data-error-message='Your goal has to have a description.'></textarea> 
			<span class="help-block">A complete description of your goal.</span>

		</fieldset>
		<fieldset>
			<label for='targetAmount'><b>*</b> Funding Target</label><div class="input-prepend" style='display:inline'>
  <span class="add-on">$</span>
  <input class="input-xxl" name='targetAmount' type="text" placeholder="In US dollars"  data-required='true' data-error-message='Your goal has to have a funding target.'> 
</div> 
		</fieldset>
		<fieldset>
			<label for='targetMonth'><b>*</b> Target Completion Date For Goal</label>
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
		<fieldset>
			<button type='submit' class='btn'>Submit Project For Proposal</button>
		</fieldset>
	</form>
</div>
<div class='span4'>
	<h3>step 1: submitting a project<br><span style='color: #f00'>(read this first!)</span></h3>
	<p>So you want to create an openfire project? Awesome! There's some things you should know first, though.</p>
<ul class='explanatory'>
	<li><p><b>An openfire project is defined by multiple stages, or "goals".</b> This is one of the things that makes us different from other funding platforms: we're here to help you achieve larger, more complex projects, through a series of well-defined goals with individual funding targets. Reach a goal, and you can move on to the next one.</p><p>Think of them as mini-bosses; you have to beat each mini-boss to complete the game. :-)</p>
		<p>Initially, each goal must be accompanied by a financial target. As you complete goals, you'll be able to "unlock" the ability to add non-monetary goals, which your team and backers can help you complete in ways that don't necessarily involve money.</p></li>
	<li><p><b>All openfire projects are curated</b>. That means that once you submit your project, it'll be sent to our team for review. You'll receive an email whether we approve it or reject it.</p>
		<p>If we reject it, it doesn't mean we don't think your idea is great; it just means we don't think it's a fit for openfire. Don't be discouraged!</p>
	</li>
		<li><p><b>Think hard about your initial goal.</b> During our approval process, we look carefully at a project's initial goal. What we want to see is a <b>concrete, achievable goal with a reasonable financial target amount</b>.</p><p>"Change the world" is an example of a bad initial goal; a better example might be "Complete initial prototype of hardware" or "Complete feasibility study".</p></li>
	<li><p><b>Once we approve your project</b>, you'll be able to add a project icon, media, a more detailed description, and existing team members. You'll also be able to add more information about your initial goal. You'll also be required to set up a <a href='http://www.wepay.com' target='_new'>WePay</a> account for your project, so we can get your money to you when and if you meet your goal.</p></li>
	<li><p><b>When you're approved and ready to roll</b>, you can set your project to be published. Once a project is published, it can't be unpublished...so be sure you've got everything you need to get rolling!</p></li>
	<li><p><b>If you have any questions,</b> feel free to <a href='/contact'>contact us</a> and ask them!</p></li>

</ul>
</div>