<?php
 
class Type {
    public $name;
    public $length;
    public $id;
    public $creator;
    public $lastUpdated;
    
    public function rollEnc(){
        return $this->name[$this->id]['encounters'][rand(0,count($this->name[$this->id]['encounters'])-1);
    }
    
    public function modEnc(){
        //TODO
    }
        
    public function delEnc(){
        //Check if JSON file exists.
        if (file_exists('type.json')){
        deleteJSON("type.json",$this->$id);
        }
    }
   
}
    }
}


?>
