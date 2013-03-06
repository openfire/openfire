<? class ajxProjectMessages{

function get(){

	global $dbh;
	global $user;

	$messages = array();


$projectUUID = $_GET['pid'];

$sth = $dbh->prepare("SELECT id FROM projects where uuid='$projectUUID' limit 1");
$sth->execute();
$result = $sth->fetch(PDO::FETCH_ASSOC);

$project = new Project($result['id']);

$num = $_GET['num'];
$offset = $_GET['offset'];
$last = $_GET['last'];

$sth = $dbh->prepare("SELECT id FROM messages where projectID='$project->id' and replyTo = '0' order by dateAdded desc limit $offset,$num");
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
foreach($result as $m){

$messages[] = new Message($m['id']);

}

?>
<style>
.message{
padding-bottom: 1em;
border-bottom: 1px solid #ddd;
margin-bottom: 2em;

}

.message .reply{

	margin-bottom: 1em;
}
</style>
<script>
$(function() {

var msgURL = "/ajax/projectMessages";



});
</script>
<? foreach($messages as $message): ?>
<div class='message'>
	<div class='row-fluid'>
	<div class='span1'>
		<img src='<?= $message->user->avatar ?>' style='width: 32px'>
	</div>
	<div class='span11'>
		<div>
			<b><a href='/users/<?= $message->user->username ?>'><?= $message->user->username ?></a>:</b> <?= nl2br($message->body) ?>
		</div>
		<div style='text-align: right; font-size: 0.8em'><a href="/messages/<?= $message->uuid ?>"><?= getRelativeTime($message->dateAdded) ?></a> <i class='icon-share replyButton'></i> Reply</div>
	</div>
</div>
	<? if(!empty($message->replies)): $replies = array_slice($message->replies, 0,3); ?>
	<div class='replies' style='margin-top: 1em'>
		<? foreach($replies as $reply): ?>
		
		<div class='reply row-fluid clearfix'>
			<div class='span2 offset2'>
				<img src='<?= $reply->user->avatar ?>' style='width: 32px'> 
			</div>
			<div class='span7'>
				<div><a href='/users/<?= $reply->user->username ?>'><?= $reply->user->username ?></a>:</b> <?= nl2br($reply->body) ?></div>
						<div style='text-align: right; font-size: 0.8em'><a href="/messages/<?= $message->uuid ?>#reply-<?= $reply->uuid ?>"><?= getRelativeTime($reply->dateAdded) ?></a></div>

			</div>
		</div>
		<? endforeach; ?>
				<? if(count($message->replies) > 3): ?>
		<div style='text-align:right'><a href="/messages/<?= $message->uuid ?>">See All <?= count($message->replies) ?> replies</a></div>
		<? endif; ?>
	</div>
<?  endif; ?>
		<form <? if(count($message->replies) == 0): ?>style='display:none'<? endif; ?> action='/ajax/postMessage' method='post' class='replyForm well well-small offset2'>
			<input type='hidden' name='projectID' value='<?= $this->project->uuid ?>'>
			<input type='hidden' name='replyTo' value='<?= $this->message->id ?>'>
			<textarea name='body' style='width: 98%; height: 8em'></textarea><br>
			<button type='submit' class='btn pull-right'>Add Reply</button>
			<div class='clearfix'></div>
		</form>


	</div>
</div>

<? endforeach;

}


}

?>