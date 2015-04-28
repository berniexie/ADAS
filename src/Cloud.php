<?php

class Cloud
{
	private static $maxID = 0;
	private $wordObjectArray = array();	//array of Word items used in the cloud
	private $paperIdMap = array();		//maps paperID (string) to paper objects
	private $wordArray = array();		//
	private $cloudID;

 	public function __construct($cloud, $IdMap)
 	{
 		$this->wordObjectArray = $cloud;
		$this->paperIdMap = $IdMap;
		$this->cloudID = self::$maxID;
		self::$maxID = self::$maxID + 1;


		foreach($this->wordObjectArray as $word)
		{
			$this->wordArray[] = array(
				'text' => $word->getTerm(),
				'weight' => $word->getTotalFrequency(),
				'link' => "/papers?term=" . $word->getTerm()
			);
		}
 	}

	function getWordArray() {
		return $this->wordArray;
	}

    // This passes the corresponding paper object to the front end
    public function getPaperObject($paperId){
        //use paper ID to access paper object
        return $this->paperIdMap[$paperId];
    }

	function getWordObject($word) {
		for($i = 0; $i < count($this->wordObjectArray); $i++){
			$wordObj = $this->wordObjectArray[$i];
			if($wordObj->getTerm() == $word){
				return $wordObj;
			}
		}
	}

	public function getId() {
		return $this->cloudID;
	}
         
}

?>
