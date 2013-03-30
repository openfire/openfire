<script>

$(function() {
	$('#tabMenu a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
});

$('.tooltipped').tooltip();

});
</script>
<div class='row-fluid'>
	<div class='span2'>
			<ul class='nav nav-pills nav-stacked'>
  <li class="active"><a href="#home" data-toggle=tab>Profile</a></li>
  <li><a href="#projects" data-toggle=tab>My Projects</a></li>

	</ul>
	</div>
<div class='span7'>

<div class='tab-content'>
				<div class='tab-pane fade in active' id='home'>
<h2><?= $this->user->username ?></h2>

<!-- <form action="/upload-avatar"
      class="dropzone"
      id="my-awesome-dropzone">
      <input type='hidden' name='userUUID' value='<?= $this->user->uuid ?>'></form> -->

<form enctype="multipart/form-data" action='' method='post' data-validate='parsley'>
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
<fieldset>
		<label for='avatar'>Avatar</label>
		<img src='<?= $this->user->avatar ?>' style='height: 64px'> 
		<input type='file' name='avatar'>
	</fieldset>
	<br>
	<fieldset>
		<label for='email'>Email</label>
		<input type='email' class='input-xxlarge' name='email' value='<?= $this->user->email ?>'data-required='true' >
	</fieldset>
	<fieldset>
		<label for='password'>New Password</label>
		<input type='password' class='input-xxlarge' name='password' id='tpassword'>
	</fieldset>
	<fieldset>
		<label for='password2'>Confirm New Password</label>
		<input type='password' class='input-xxlarge' name='password2' data-equalto='#tpassword' data-error-message='Passwords must match.'>
	</fieldset>
	<fieldset>
		<label for='firstName'>First Name</label>
		<input type='text' class='input-xxlarge' name='firstName' value='<?= $this->user->firstName ?>'data-required='true' >
	</fieldset>
	<fieldset>
		<label for='lastName'>Last Name</label>
		<input type='text' class='input-xxlarge' name='lastName' value='<?= $this->user->lastName ?>'data-required='true' >
	</fieldset>
	<fieldset>
		<label for='location'>Location</label>
		<input type='text' class='input-xxlarge' name='location' value='<?= $this->user->location ?>'>
	</fieldset>
	<fieldset>
		<label for='bio'>Bio</label>
		<textarea name='bio'class='input-xxlarge' style='height: 12em'><?= $this->user->bio ?></textarea>
	</fieldset>
	<div class="form-actions">
  <button type="submit" class="btn btn-primary">Save changes</button>
<br><br>
		<a class='btn btn-info' href='/auth/facebook' style='background: #596F90; margin-top: 0.5em; margin-bottom: 0.5em'><i class='icon-facebook'></i> Connect With Facebook</a><? if(!empty($this->user->facebookToken)): ?> <b>connected</b><? endif; ?><br>
  		<a class='btn btn-info' href='/auth/twitter'><i class='icon-twitter'></i> Connect With Twitter</a><? if(!empty($this->user->twitterAuthToken)): ?> <b>connected</b><? endif; ?>

</div>
	</form>


	<div class='tab-pane fade in' id='projects'>
		<h2>My Projects</h2>

	<? foreach($this->user->projects as $project): ?>
	<div class='well well-small'>
		<h3><a href='/projects/<?= $project->slug ?>'><img src='<?= $project->icon ?>' style='width: 64px'> <?= $project->title ?></a> <? if($project->isAdmin == 1): ?><a href='/manageProject/<?= $project->uuid ?>' class='btn pull-right'><i class='icon-edit'></i> Manage Project</a><? endif; ?></h3>
		<h4>User Role: <?= $project->userRole ?></h4>

	</div>
<? endforeach; ?>
	</div>
</div>
</div>