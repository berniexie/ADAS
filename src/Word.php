<?php

include_once('Paper.php');

class Word
{
	private $term;						// string
	private $totalFrequency;			// int
	private $termFrequency = array();	// Maps (string) paperID to (int) frequency
 
	public function __construct($term, $paperId, $frequency)
	{
		$this->term = $term;

		// When created, it's the first time the word is encountered
		$this->totalFrequency = $frequency;
		$this->termFrequency[$paperId] = $frequency;

	}

	public function getTerm()
	{
		return $this->term;
	}

	public function getTotalFrequency()
	{
		return $this->totalFrequency;
	}

	public function getTermFrequency()
	{
		arsort($this->termFrequency);
		return $this->termFrequency;
	}

	// User by data manager to signal that the word has been found in $paper
	// Must appropriately increment frequencies
	public function incrementFrequency($paperId, $frequency)
	{
		$this->totalFrequency += $frequency;

		// If the paper is already in the list, increment its frequency
		if(array_key_exists($paperId, $this->termFrequency))
		{
			$this->termFrequency[$paperId] += $frequency;
		}

		// Add the paper to the list
		else
		{	
			$this->termFrequency[$paperId] = $frequency;
		}
	}
}
?>
