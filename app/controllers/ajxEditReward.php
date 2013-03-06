<? class ajxEditReward{

function post(){

	$response = array();

		$id = $_POST['id'];
$reward = new Reward($id);

	if($_POST['action'] != "delete"){




$params = array(
"name" => $_POST['name'],
"minAmount" => $_POST['minAmount'],
"description" => $_POST['description'],
"numTotal" => $_POST['numTotal'],
"numStillAvailable" => $_POST['numStillAvailable'],
"status" => $_POST['action']
);

$reward->update($params);

if(!empty($_FILES['image'])){
$destFile = $_SERVER['DOCUMENT_ROOT'] . "/../assets.openfi.re/images/rewards/".$reward->uuid.".png";

$rewardpic = imageToPNG($_FILES['image']['tmp_name'],$destFile, 1024);

$reward = new Reward($id);

}

$response['action'] = "updated";
$response['html'] = "			<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"10000000\" />

				<input type='hidden' name='id' value='" .  $reward->id  . "'>
				  <div class=\"control-group\">
				    <label class=\"control-label\" for=\"minAmount\">Minimum Amount</label>
					    <div class=\"controls\">
					      <div class=\"input-prepend\">
							  <span class=\"add-on\">$</span>
							  <input name='minAmount' class='span6' type=\"text\" placeholder=\"Minimum Amount\" value='" .  $reward->minAmount  . "'>
							</div>
					    </div>
				  </div>
				  				  <div class=\"control-group\">
				    <label class=\"control-label\" for=\"image\">"; if($reward->image !=''): $response['html'] .= "Replace "; else: $response['html'] .= "Add "; endif; $response['html'] .= "Image (optional)</label>
					    <div class=\"controls\">
							  <input name='image' class='input-block-level' type=\"file\" placeholder=\"Image\">
							  "; if($reward->image !=''): $response['html'] .= "<div width='100%'>
				    	<img src='". $reward->image . "' class='span6'></div>"; endif; 
				$response['html'] .=	    "</div>
				  </div>
				  <div class=\"control-group\">
				    <label class=\"control-label\" for=\"name\">Name</label>
					    <div class=\"controls\">
							  <input name='name' class='input-block-level' type=\"text\" placeholder=\"Reward Name\" value='" .  $reward->name  . "'>
					    </div>
				  </div>
				  <div class=\"control-group\">
				    <label class=\"control-label\" for=\"description\">Description</label>
					    <div class=\"controls\">
							  <textarea class='input-block-level' style='height: 8em' name='description'>" .  nl2br($reward->description)  . "</textarea>
					    </div>
				  </div>
				   <div class=\"control-group\">
				    <label class=\"control-label\" for=\"numTotal\">Number Total</label>
					    <div class=\"controls\">
							  <input name='numTotal' class='input-block-level' type=\"text\" placeholder=\"Number Total\" value='" .  $reward->numTotal  . "'>
					    </div>
				  </div>
				   <div class=\"control-group\">
				    <label class=\"control-label\" for=\"numStillAvailable\">Number Still Available</label>
					    <div class=\"controls\">
							  <input name='numStillAvailable' class='input-block-level' type=\"text\" placeholder=\"Number Still Available\" value='" .  $reward->numStillAvailable  . "'>
					    </div>
				  </div>
				  <div class='form-actions'>
				  	<div>Status: <b>" .  ucwords($reward->status)  . "</b></div>
				  	<div class='pull-right'>";

				  	if($reward->status == "draft"): $response['html'] .= "<button type='submit' class='btn' name='action' value='draft'>Save Draft</button> <button type='submit' class='btn btn-success' name='action' value='published'>Publish Reward</button>"; else:  $response['html'] .= " <button type='submit' class='btn btn-success' name='action' value='published'>Update Reward</button>"; endif;  $response['html'] .= "</div> <button type='submit' class='pull-left btn btn-danger' name='action' value='delete'>Delete Reward</button></div>";
}else{

$params = array("deleted" => "1");
$reward->update($params);
$response['action'] = "deleted";

}

echo json_encode($response);

}


}