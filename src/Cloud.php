<?php

class Cloud
{
	private $wordObjectArray = array();	//array of Word items used in the cloud
	private $paperIdMap = array();		//maps paperID (string) to paper objects
	private $wordArray = array();		//
	private $id; // unique int id to identify cloud for history

 	public function __construct($cloud, $IdMap, $id)
 	{
 		$this->wordObjectArray = $cloud;
		$this->paperIdMap = $IdMap;
		$this->id = $id;

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

	function getId() {
		return $this->id;
	}
         
}

?>
