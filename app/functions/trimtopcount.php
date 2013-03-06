<? function trimtopcount($text, $limit = 1, $lead=false) {
 
$ntext = preg_split('/[\r\n]+/', $text);
if(count($ntext) == 1){
$ntext = preg_split('/[\n\n]+/', $text);	
}

if(count($ntext) > $limit){

$ntext = array_slice($ntext, 0, $limit);



}

if($lead == true){
	$ntext[0] = "<p class='lead'>" . $ntext[0];
}
else{
	$ntext[0] = "<p>" . $ntext[0];
}

$text = implode("</p>

<p>",$ntext);

$text .= "</p>";

      return $text;
    }