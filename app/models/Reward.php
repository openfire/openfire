<? class Reward extends Thingy{

    protected $table = 'rewards';

     
    
        function __construct($id = null) {
        parent::__construct($id);

        if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/../assets.openfi.re/images/rewards/" . $this->uuid . ".png")){
        	$this->image = "http://assets.openfi.re/images/rewards/" . $this->uuid . ".png";
        }else{
        	$this->image = null;
        }


    }



}