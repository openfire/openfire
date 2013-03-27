<? function checkCSRF($csrf){

if($csrf == session_id()){ 
	return true;
	}else{
	return false;
	}

}