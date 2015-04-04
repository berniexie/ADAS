<?php
include_once('Cloud.php');
include_once('Paper.php');
include_once('Word.php');
include_once('APIManager.php');

class DataManager 
{
	private $words = array();	    //array of Word objects that will be passed back to the cloud
	private $papers = array();      //array of paper objects used
    private $cloud;
    private $apiManager;
    private $paperIdMap = array();  //maps paperID (string) to paper objects

  public function __construct()
  {
    $this->apiManager = new APIManager();
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
      foreach($content as $text=>$frequency)
      {
        $bool = false;

        foreach($this->words as $word)
        {
          //if there's a match, increment the frequency of the word in the paper
          if($text == $word->getTerm())
          {
            $word->incrementFrequency($paper->getId(), $frequency); //the key word has been found in the paper
            $bool = true; 
          }
        }

        //if no match is found, a word object is initialized for that word and added to the array
        if($bool == false)
        {
          $word = new Word($text, $paper->getId(), $frequency);
          $this->words[] = $word;
        }
      }
    }
  }

  //This function creates a cloud based on a key word
  public function getCloudByKeyWord(string $keyWord, int $limit){
      clearPapers();
      //sets array of papers using info from API
      $this->papers = $this->apiManager->getPapersByKeyWords($keyWord, $limit);
      return createWordCloud();
  }

  //This function creates a cloud based on an author
  public function getCloudByAuthor(string $author, int $limit)  {
      clearPapers();
      //sets array of papers using API
      $this->papers = $this->apiManager->getPapersByAuthor($author, $limit);
      return createWordCloud();
  }

/*  NOT FOR SPRINT 1
  //This function creates a cloud based on a given subset of papers
  public function getCloudByPapers(array $paperSubset){
       clearPapers();

       return createWordCloud();
  }
*/

  public function cmp($a, $b){
      if($a->getTotalFrequency() == $b->getTotalFrequency()){
          return 0;
      }
      return($a->getTotalFrequency() < $b->getTotalFrequency()) ? -1:1;
  }

  //Generates the word cloud with the current array of word objects
  public function createWordCloud(){
      createPaperMap();
      createWordObjects();

      //sort by frequency
      uasort($words, "cmp");
      //cuts off array at [magic number] elements
      $cloudArray = $this->words;
      $cloudArray = array_slice($cloudArray, 0, 250);
      //make cloud
      $this->cloud = new Cloud($cloudArray);
      return $this->cloud;
  }

  //Creates paper map
  public function createPaperMap(){
      foreach($this->$papers as $object){
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
