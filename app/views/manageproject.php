<? global $user; ?>
<script>



$(function() {

$("#summary").wordCounter({limit: 60});

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
		$('.inviteThanks').html(data.msg);
		$('#inviteEmail').val('');

		$('.inviteThanks').show();
	}
});

$('#addPress').ajaxForm({
	dataType: 'html',
	success: function(data){
		$('#pressList').prepend(data);
		$('#addPress').hide();
		$('#addPress input, #addPress textarea').val('');
	}
});

$('#postUpdate').ajaxForm({
	dataType: 'html',
	success: function(data){
		$('#updateList').prepend(data);
		$('#postUpdate').hide();
		$('#postUpdate input, #addPress textarea').val('');
	}
});

$('#inviteUser').on('show', function () {
$('.inviteThanks').hide();
$('#inviteEmail').val('');
})


$('.deleteMember').click(function(){

theRow = $(this).closest('tr');

if(confirm("Are you sure you want to remove this team member?") == true){
	var action = "action=removeFromProject&projectUUID=" + $(this).attr('data-projectUUID') + "&userUUID=" + $(this).attr('data-userUUID');
	success = function(data){
		$('body').prepend("<div class='alert' style='position:fixed; top:0; left: 0; width:90%'>" + data.message + "</div>");
		if(data.code == "200"){
			theRow.slideUp();
		}
	}
	$.ajax('/ajax/userActions', {data: action, type: 'POST', success: success, dataType: 'json'});
}

 });

$('.updateUserRole').click(function(){

userRole = $(this).siblings('input[name="role"]').val();


var action = "action=updateUserRole&projectUUID=" + $(this).attr('data-projectUUID') + "&userUUID=" + $(this).attr('data-userUUID') +"&role=" + userRole;
	success = function(data){
		$('#userAlert').remove();
		$('body').prepend("<div id='userAlert' class='alert' style='position:fixed; top:0; left: 0; width:90%; z-index: 99999'>" + data.message + "</div>");
	}
 	$.ajax('/ajax/userActions', {data: action, type: 'POST', success: success, dataType: 'json'});

 });


$('.isAdmin').click(function(){
var doIt = "removeUserAdmin";
if($(this).is(':checked') == true){ doIt = "makeUserAdmin"}

var action = "action=" + doIt + "&projectUUID=" + $(this).attr('data-projectUUID') + "&userUUID=" + $(this).attr('data-userUUID');
	success = function(data){
		$('#userAlert').remove();

		$('body').prepend("<div id='userAlert' class='alert' style='position:fixed; top:0; left: 0; width:90% width:90%; z-index: 99999'>" + data.message + "</div>");	}
 	$.ajax('/ajax/userActions', {data: action, type: 'POST', success: success, dataType: 'json'});

 });


});


</script>
<div class='span12' style='margin-bottom: 2em;'>
<h1><img class='pull-left' src='<?= $this->project->icon ?>' style='height: 64px; margin-right: 12px'> <?= $this->project->title ?></h1><h2><?= $this->project->subtitle ?></h2>
</div>
</div>
<div class='row-fluid'>
	<div class='span2'>
	<ul>
		<li>Total Funding: <b>$<? $this->project->getTotalFunding; echo $this->project->totalFunding; ?></b></li>
		<li>WePay Account: <b><a href='https://www.wepay.com/account/<?= $this->project->wePayAccountID ?>'><?= $this->project->wePayAccountID ?></a></b></li>
	</ul>
			<ul class='nav nav-pills nav-stacked'>
		<!-- <li class='active'><a href='#messages' data-toggle='tab'>Messages</a> -->
		<li class='active'><a href='#overview' data-toggle=tab>Project Overview</a>
		<li><a href='#goals' data-toggle=tab>Goals</a>
		<li><a href='#team' data-toggle=tab>Team</a>
		<li><a href='#updates' data-toggle=tab>Updates <? if(count($this->project->updates > 0)): ?>(<?= count($this->project->updates) ?>)<? endif; ?></a>
		<li><a href='#backers' data-toggle=tab>Backers <? if(count($this->project->backers > 0)): ?>(<?= count($this->project->backers) ?>)<? endif; ?></a>

		<li><a href='#press' data-toggle=tab>Press</a>

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
		<form enctype="multipart/form-data" action='' method='post' id='manageProjectForm' form-validate='parsley'>
			<input type="hidden" name="MAX_FILE_SIZE" value="5000000" />
						<input type='hidden' name='uuid' value='<?= $this->project->uuid ?>'>

						<fieldset>
							<legend>Project Overview</legend>
							<label for='title'>Title</label>
							<input type='text' data-required='true'  data-error-message='Your project must have a title.' class='input-xxlarge' name='title' value="<?= $this->project->title ?>" <? if(!in_array($this->project->status, array("draft","pending approval"))): ?> disabled='disabled' <?endif; ?>><? if(!in_array($this->project->status, array("draft","pending approval"))): ?><span class='help-block'>Once your project has been published, the title cannot be changed.</span><?endif;?>
				 		</fieldset>
						<fieldset>
							<label for='subtitle'>Tagline/Subtitle</label>
							<input type='text'  data-required='true'  data-error-message='Your project must have a subtitle.' class='input-xxlarge' name='subtitle' value="<?= $this->project->subtitle ?>">
				 		</fieldset>
						<fieldset>
							<label for='mediaEmbed'>Video URL</label>
							<input type='text'  data-required='true'  data-error-message='Your project must have a video.' class='input-xxlarge' name='mediaEmbed' placeholder='e.g. http://www.youtube.com/watch?v=oHg5SJYRHA0' value="<?= $this->project->mediaEmbed ?>">
				 		</fieldset>
				 		<br>
						<fieldset>
							<label for='summary'>Summary</label>
							 
							<textarea name='summary' id='summary' class='input-xxlarge' style='height: 8em' data-required='true' data-error-message='Your project must have a summary.'><?= $this->project->summary ?></textarea>
				 		</fieldset>

						<fieldset>
							<label for='description'>Description</label>
							 
							<textarea name='description' id='description' class='input-xxlarge' style='height: 12em' data-required='true' data-error-message='Your project must have a description.'><? if(!empty($this->project->description)): echo $this->project->description; else: echo $this->project->initialProposal; endif; ?></textarea>
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
		<table class='table' id='teamTable'>
			<thead><tr><th></th><th>Name</th><th>Role</th><th>Admin</th><th></th></tr></thead>
			<tbody>
		<? foreach($this->project->team as $member): ?>
		<tr><td><img src='<?= $member->avatar ?>' class='avatar-small'></td><td><a href='/users/<?= $member->username ?>'><?= $member->fullName ?></a></td><td>
			<div class="input-append">
					<input type='text' name='role' value='<?= $member->role ?>'>
					<span class="btn updateUserRole" data-projectUUID ='<?= $this->project->uuid ?>' data-userUUID='<?= $member->uuid ?>' type="button">Update</span>
			</div>
</td><td><? if($member->id != $this->project->creatorID): ?><input type='checkbox' name='isAdmin' class='isAdmin' data-projectUUID ='<?= $this->project->uuid ?>' data-userUUID='<?= $member->uuid ?>' <? if($member->isAdmin == '1') echo "checked='checked'"; ?>><? endif; ?></td><td><? if($member->id != $this->project->creatorID): ?><span class='btn btn-danger btn-mini deleteMember' data-projectUUID ='<?= $this->project->uuid ?>' data-userUUID='<?= $member->uuid ?>'>Remove Member</span><? endif; ?></td></tr>
	<? endforeach; ?>
</tbody>
</table>
	</div>

	<div id='updates' class='tab-pane fade in'>
		<legend>Updates<button class='btn pull-right' data-toggle="modal" onclick="$('#postUpdate').slideDown()"><i class='icon-plus-sign' style='color: #5bb75b'></i> Add Update</button></legend>

		<form id='postUpdate' style='display:none' action='/ajax/addUpdate' method='post' class='well well-small'>
			<input type='hidden' name='action' value='postUpdate'>
			<input type='hidden' name='projectID' value='<?= $this->project->id ?>'>

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
		<div id='updateList'>
		<? $this->project->getUpdates(); foreach($this->project->updates as $update): ?>
		<div class='update well well-small'>
			<h3><?= $update->title ?></h3>
			<div>Posted by <?= $update->user->username ?> on <?= date("m-d-Y", $update->dateAdded) ?> at <?= date("h:ia", $update->dateAdded) ?></div>
			<div><?= nl2br($update->body) ?></div>
		</div>
	<? endforeach; ?>
</div>

	</div>


	<div class='tab-pane fade in' id='press'>
		<legend>Press <span class='btn pull-right' onclick="$('#addPress').show()"><i class='icon-plus-sign'></i> Add Press</span></legend>
		<form class='well well-small' style='display:none' id='addPress' action='/ajax/addPress' method='post'>
			<input type='hidden' name='projectID' value='<?= $this->project->id ?>'>
		<fieldset>
			<label for='title'>Title</label>
			<input type='text' name='title' class='input-xxlarge'>
		</fieldset>
		<fieldset>
			<label for='url'>URL</label>
			<input type='text' name='url' class='input-xxlarge'>
		</fieldset>
		<fieldset>
			<label for='description'>Description</label>
			<textarea name='description' class='input-xxlarge' style='height: 8em'></textarea>
		</fieldset>
		<div class='form-actions'>
			<button type='submit' class='btn btn-success'>Add Press</button>
		</div>
	</form>
	<ul class='unstyled' id='pressList'>

		<? foreach($this->project->press as $press): ?>
		<li><a href='<?= $press->url ?>'><b><?= $press->title ?></b></a> - <?= $press->description ?></li>
	<? endforeach; ?>

	</ul>
		
	</div>

	<div class='tab-pane fade in' id='backers'>
		<legend>Backers</legend>
		<table class='table table-striped'>
			<thead>
				<tr>
					<th>User</th><th>Email</th><th>Goal</th><th>Amount</th><th>Reward</th><th>Status</th>
				</tr>
			</thead>
			<tbody>
  <?foreach($this->project->backers as $backer): ?>
  <tr><td><a href='/users/<?= $backer->username ?>'><img src='<?= $backer->avatar ?>' class='avatar-tiny'> <?= $backer->username ?></td><td><?= $backer->email ?></td><td><a href='/manageGoal/<?= $backer->goal->uuid ?>'><?= $backer->goal->name ?></a></td><td>$<?= $backer->amount ?></td><td><?= $backer->reward->name ?></td><td><?= $backer->rewardStatus ?></td></tr>
<? endforeach; ?>
</tbody>
</table>
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
    	<input type='text' id='inviteEmail' name='email' placeholder='Email address'> 
    	<button type='submit'>Invite User</button>
    	<div class='inviteThanks' style='display:none; font-weight:bold'></div>
    </fieldset>

    </form>
  </div>
  <div class="modal-footer">
    <a href="#" class="btn" data-dismiss="modal" aria-hidden="true">Close</a>
  </div>
</div>