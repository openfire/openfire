<div class='span8 well well-small'>
<h2>Add Update</h2>

<form action='' method='post'>
	<input type='hidden' name='projectUUID' value='<?= $this->project->uuid ?>'>
	<fieldset>
		<label for='title'>Title</label>
		<input type='text' name='title' class='input-xxlarge' style='font-size: 1.2em'>
	</fieldset>

	<fieldset>
		<label for='goal'>Goal</label>
		<select name='goalID' class='input-xxlarge'>
			<? foreach($this->project->goals as $goal): ?>
			<option value='<?= $goal->uuid ?>'><?= $goal->name ?></option>
		<? endforeach; ?>
	</select>
	</fieldset>
	<fieldset>
		<label for='body'>Body</label>
		<textarea name='body' class='input-xxlarge' style='height: 12em'></textarea>
	</fieldset>
	<fieldset><button type='submit' class='btn'>Add Update</button></fieldset>

</form>

</div>