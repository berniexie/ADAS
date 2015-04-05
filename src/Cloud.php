<?php

class Cloud
{
	private $wordObjectArray = array();	//array of Word items used in the cloud
	private $paperIdMap = array();		//maps paperID (string) to paper objects
	private $wordArray = array();		//

 	public function __construct($cloud, $IdMap)
 	{
 		$this->wordObjectArray = $cloud;
		$this->paperIdMap = $IdMap;
		
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

	public function getPaperObject($paperId){
		//use paper ID to access paper object
		return $this->$paperIdMap[$paperId];
	}

	function getWordObject($word) {
		for($i = 0; $i < count($this->wordObjectArray); $i++){
			$wordObj = $this->wordObjectArray[$i];
			if($wordObj->getString() == $word){
				return $wordObj;
			}
		}
	}
         
}

?>
