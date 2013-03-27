<? class ajxAddReward{

function post(){

if(!empty($_FILES['rewardimages'])) fixFilesArray($_FILES['rewardimages']);

foreach($_POST['reward'] as $index=>$reward){

	$params = array(
		"uuid" => md5(microtime()),
		"goalID" => $_POST['goalID'],
		"name" => $reward['name'],
		"description" => $reward['description'],
		"minAmount" => $reward['minAmount'],
		"numTotal" => $reward['numTotal'],
		"numStillAvailable" => $reward['numTotal']
		);

	$reward = new Reward();
	$reward->insert($params);

	if(!empty($_FILES['rewardimages'][$index]['name'])){

$destFile = $_SERVER['DOCUMENT_ROOT'] . "/../assets.openfi.re/images/rewards/".$reward->uuid.".png";

$rewardpic = imageToPNG($_FILES['rewardimages'][$index]['tmp_name'],$destFile, 1024);

	}
?>
<form enctype="multipart/form-data" class='well well-small editReward form-horizontal' action='/ajax/editReward' method='post'>
			<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />

				<input type='hidden' name='id' value='<?= $reward->id ?>'>
				  <div class="control-group">
				    <label class="control-label" for="minAmount">Minimum Amount</label>
					    <div class="controls">
					      <div class="input-prepend">
							  <span class="add-on">$</span>
							  <input name='minAmount' class='span6' type="text" placeholder="Minimum Amount" value='<?= $reward->minAmount ?>'>
							</div>
					    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="name">Name</label>
					    <div class="controls">
							  <input name='name' class='input-block-level' type="text" placeholder="Reward Name" value='<?= $reward->name ?>'>
					    </div>
				  </div>
				  <div class="control-group">
				    <label class="control-label" for="description">Description</label>
					    <div class="controls">
							  <textarea class='input-block-level' style='height: 8em' name='description'><?= nl2br($reward->description) ?></textarea>
					    </div>
				  </div>
				   <div class="control-group">
				    <label class="control-label" for="numTotal">Number Total</label>
					    <div class="controls">
							  <input name='numTotal' class='input-block-level' type="text" placeholder="Number Total" value='<?= $reward->numTotal ?>'>
					    </div>
				  </div>
				   <div class="control-group">
				    <label class="control-label" for="numStillAvailable">Number Still Available</label>
					    <div class="controls">
							  <input name='numStillAvailable' class='input-block-level' type="text" placeholder="Number Still Available" value='<?= $reward->numStillAvailable ?>'>
					    </div>
				  </div>
				  <div class='form-actions'>
				  	<div>Status: <b><?= ucwords($reward->status) ?></b></div>
				  	<div class='pull-right'><? if($reward->status == "draft"): ?><button type='submit' class='btn' name='action' value='draft'>Save Draft</button> <button type='submit' class='btn btn-success' name='action' value='published'>Publish Reward</button> <? else: ?> <button type='submit' class='btn btn-success' name='action' value='published'>Update Reward</button><? endif; ?></div> <button type='submit' class='pull-left btn btn-danger' name='action' value='delete'>Delete Reward</button>
				  </div>				  
</form>
<?
}




}

}