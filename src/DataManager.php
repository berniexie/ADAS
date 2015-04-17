<?php
include_once('Cloud.php');
include_once('Paper.php');
include_once('Word.php');
include_once('ResearchPaperAPI.php');

class DataManager 
{
	private $words = array();	    //array of Word objects that will be passed back to the cloud
	private $papers = array();      //array of Paper objects used
	private $cloud;
	private $apiManager;
	private $paperIdMap = array();  //maps paperID (string) to paper objects

	public function __construct()
	{
		$this->apiManager = new ResearchPaperAPI();
	}

	public function cmp($a, $b) {
		if($a->getTotalFrequency() == $b->getTotalFrequency()){
			return 0;
		}

		return($a->getTotalFrequency() < $b->getTotalFrequency()) ? 1:-1;
	}

	//clears the array of paper objects for the next word cloud
	public function clearPapers()
	{
		$this->papers = null;
	}

	/*  TEMPORARILY UNIMPLEMENTED FOR SPRINT 1
	public function getAutofillSuggestions($userInput)
	{
		// Passes autofill suggestions from apiManager
		return $this->apiManager->getAuthorSuggestion($userInput);
	}
	*/

	//This function is to count the frequency of the words in the papers and create the word objects
	public function createWordObjects()
	{
		//searches through each paper
		foreach($this->papers as $paper)
		{
			//gets the individual contents from the papers
			$content = $paper->getContent();

			//searches through each word in the paper
			foreach($content as $text => $frequency)
			{
				$flag = false;

				foreach($this->words as $word)
				{
					//if there's a match, increment the frequency of the word in the paper
					if($text == $word->getTerm())
					{
						$word->incrementFrequency($paper->getId(), $frequency); //the key word has been found in the paper
						$flag = true; 
					}
				}

				//if no match is found, a word object is initialized for that word and added to the array
				if($flag == false)
				{
					$word = new Word($text, $paper->getId(), $frequency);
					$this->words[] = $word;
				}
			}
		}
	}

	//This function creates a cloud based on a key word
	public function getCloudByKeyWord($keyWord, $limit){
		$this->clearPapers();

		//sets array of papers using info from API
		$this->papers = $this->apiManager->getPapersByKeyWords($keyWord, $limit);

		//set parsedTitle in all of the papers
		foreach($this->papers as $paper)
		{
			$title = $paper->getTitle();

			$parsedTitle = explode(" ", $title);

			$paper->setParsedTitle($parsedTitle);
		}

		return $this->createWordCloud();
	}

	//This function creates a cloud based on an author
	public function getCloudByAuthor($author, $limit)  {
		$this->clearPapers();

		//sets array of papers using API
		$this->papers = $this->apiManager->getPapersByAuthor($author, $limit);

		//set parsedTitle in all of the papers
		foreach($this->papers as $paper)
		{
			$title = $paper->getTitle();

			$parsedTitle = explode(" ", $title);

			$paper->setParsedTitle($parsedTitle);
		}

		return $this->createWordCloud();
	}

	/*  NOT FOR SPRINT 1
	//This function creates a cloud based on a given subset of papers
	public function getCloudByPapers(array $paperSubset){
		clearPapers();

		return createWordCloud();
	}
	*/

	//Generates the word cloud with the current array of word objects
	public function createWordCloud(){
		$this->createPaperMap();
		$this->createWordObjects();

		//sort by frequency
		uasort($this->words, array("DataManager", 'cmp'));

		//cuts off array at [magic number] elements
		$cloudArray = $this->words;
		$cloudArray = array_slice($cloudArray, 0, 250);

		//make cloud
		$this->cloud = new Cloud($cloudArray, $this->paperIdMap);

		return $this->cloud;
	}

	//Creates paper map
	public function createPaperMap(){
		foreach($this->papers as $object){
			$this->paperIdMap[$object->getId()] = $object; //key = ID, value = paper object
		}
	}

	// This passes the corresponding paper object to the front end
	public function getPaperObject($paperId){
		//use paper ID to access paper object
		return $this->$paperIdMap[$paperId];
	}

}

?>
