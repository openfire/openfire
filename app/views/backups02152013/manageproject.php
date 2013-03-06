<? global $user; ?>
<script>



$(function() {

var msgURL = "/ajax/projectMessages";

$.get(msgURL, {"pid": "<?= $this->project->uuid ?>", "offset" : "0", "num" : "20", "last" : "<?= time() ?>"}, function(data){
	$('#projectMessages').html(data);
});

$('#postMessage').ajaxForm(function(){

$.get(msgURL,{"pid": "<?= $this->project->uuid ?>", "offset" : "0", "num" : "20", "last" : "<?= time() ?>"},function(data){
	$('#projectMessages').html(data);
});


});

$('#inviteUserForm').ajaxForm({
	dataType: 'json',
	success: function(data){
		$('#inviteUserForm').html("<b>" + data.msg + "</b>");
	}
});


});


</script>
<div class='span12' style='margin-bottom: 2em;'>
<h1><img class='pull-left' src='<?= $this->project->icon ?>' style='height: 64px; margin-right: 12px'> <?= $this->project->title ?></h1><h2><?= $this->project->subtitle ?></h2>
</div>
</div>
<div class='row-fluid'>
	<div class='span2'>
			<ul class='nav nav-pills nav-stacked'>
		<!-- <li class='active'><a href='#messages' data-toggle='tab'>Messages</a> -->
		<li class='active'><a href='#overview' data-toggle=tab>Project Overview</a>
		<li><a href='#goals' data-toggle=tab>Goals</a>
		<li><a href='#team' data-toggle=tab>Team</a>

	</ul>
	</div>
<div class='span7 tab-content'>
	<!-- <div class='tab-pane active' id='messages'>
		<form action='/ajax/postMessage' method='post' id='postMessage' class='well well-small'>
			<input type='hidden' name='projectID' value='<?= $this->project->uuid ?>'>
			<h4>Post Message</h4>
			<textarea name='body' style='width: 98%; height: 8em'></textarea><br>
			<button type='submit' class='btn pull-right'>Add Message</button>
			<div class='clearfix'></div>
		</form>

	<div id='projectMessages'>
	</div>

	</div> -->
	<div class='tab-pane active fade in' id='overview'>
		<form enctype="multipart/form-data" action='' method='post' id='manageProjectForm'>
			<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
						<input type='hidden' name='uuid' value='<?= $this->project->uuid ?>'>

						<fieldset>
							<legend>Project Overview</legend>
							<label for='title'>Title</label>
							<input type='text' class='input-xxlarge' name='title' value="<?= $this->project->title ?>" <? if(!in_array($this->project->status, array("draft","pending approval"))): ?> disabled='disabled' <?endif; ?>><? if(!in_array($this->project->status, array("draft","pending approval"))): ?><span class='help-block'>Once your project has been published, the title cannot be changed.</span><?endif;?>
				 		</fieldset>
						<fieldset>
							<label for='subtitle'>Tagline/Subtitle</label>
							<input type='text' class='input-xxlarge' name='subtitle' value="<?= $this->project->subtitle ?>">
				 		</fieldset>
						<fieldset>
							<label for='mediaEmbed'>Media URL</label>
							<input type='text' class='input-xxlarge' name='mediaEmbed' placeholder='e.g. http://www.youtube.com/watch?v=oHg5SJYRHA0' value="<?= $this->project->mediaEmbed ?>">
				 		</fieldset>
				 		<br>
						<fieldset>
							<label for='description'>Description</label>
							 
							<textarea name='description' id='description' class='input-xxlarge' style='height: 12em'><? if(!empty($this->project->description)): echo $this->project->description; else: echo $this->project->initialProposal; endif; ?></textarea>
				 		</fieldset>
						<fieldset>
							<label for='icon'>Project Icon</label>
							<div class='row-fluid'><div class='span2'><img src='<?= $this->project->icon ?>' style='width: 128px'></div>
							<div class='span10'><input type='file' name='icon'>
							<span class='help-block'>This is your project's logo or image. Maximum file size 5MB, and we'll resize it to 256x256 pixels. If you don't upload one, you get the default one, which is spiffy, but not as cool as having your own.</span>
						</div>
					</div>
						</fieldset> <br>
						<h5>Project Status: <?= ucwords($this->project->status) ?></h5>
				 		<? if ($this->project->isAdmin($user) == true): ?><div class="form-actions">
				 			<button type='submit' name='action' value='update' class='btn'>Update<? if($this->project->status == "draft") echo " Draft" ?></button> <? if($this->project->status == "draft"): ?><button type='submit' id='publishButton' class='btn btn-success' name='action' value='publish'>Publish Project</button><? endif; ?>
				 		</div>
				 		<? endif; ?>
					</form>
	</div>
	<div class='tab-pane fade in' id='goals'>
		<legend>Goals</legend>
		<? foreach($this->project->goals as $goal): ?>
		<div class='goal well well-small'>
			<div><h3 class='pull-left'><a href='/manageGoal/<?= $goal->uuid ?>'><?= $goal->name ?></a> <? if($goal->isCurrent == 1): ?><span class='label label-info'>current</span><? endif; ?></h3><a href='/goals/<?= $goal->uuid ?>' class='btn pull-right'><i class='icon-eye-open'></i> View Goal</a><div class='clearfix'></div></div>
			<div><?= trimtopcount($goal->description, 2) ?></div>
			<h5>Status: <?= ucwords($goal->status) ?></h5>
 			<h5>Funds: <b>$<?= number_format($goal->currentAmount, 2) ?></b> of <b>$<?= number_format($goal->targetAmount, 2) ?></b> raised from <b><?= count($goal->backers) ?></b> backers</h5>
 			<h5><? if($goal->daysUntilTarget > 0): ?><?= $goal->daysUntilTarget ?> days remaining<? else: ?><?= ucwords($goal->status) ?><? endif; ?></h5>
		</div>
	<? endforeach; ?>
	<a href='/manageProject/<?= $this->project->uuid ?>/addGoal' class='btn btn-success span6 offset3'><i class='icon-plus-sign'></i> Add A Goal</a>
	</div>
	<div class='tab-pane fade in' id='team'>
		<legend>Team <a href='#inviteUser' class='btn pull-right' data-toggle="modal"><i class='icon-plus-sign' style='color: #5bb75b'></i> Invite User</a></legend>
		<ul class='thumbnails'>
		<? foreach($this->project->team as $member): ?>
 <li class="span2">
    <a href='/users/<?= $member->username ?>'><div class="thumbnail">
      <img src="<?= $member->avatar ?>" alt="<?= $member->username ?>">
      <h5 style='text-align:center'><?= $member->username ?></h5>

    </div>
</a>
  </li>
		<? endforeach; ?>
	</ul>
	</div>
</div>

<div class='span3'>

</div>

<div id="inviteUser" class="modal hide fade">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Invite User</h3>
  </div>
  <div class="modal-body">
  	<p>Enter your user's email address below. If they're not already an openfire member, they'll receive an email inviting them to join.</p>
    <form class='form-inline' id='inviteUserForm' action='/ajax/inviteUser' method='post'>
    	<fieldset>
    		<input type='hidden' name='projectUUID' value='<?= $this->project->uuid ?>'>
    	<input type='text' name='email' placeholder='Email address'> 
    	<button type='submit'>Invite User</button>
    </fieldset>

    </form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
  </div>
</div>