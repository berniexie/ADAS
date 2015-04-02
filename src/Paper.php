<?php

class Paper
{
	private $author = array(); 	// array of strings
	private $title;				// string
	private $journal;			// string
	private $content;			// map: Word->(int)frequency
	private $link;				// string

	public function __construct($author, $title, $journal, $content, $link)
	{
		$this->author = $author;
		$this->title = $title;
		$this->journal = $journal;
		$this->content = $content;
		$this->link = $link;
	}

	public function getAuthor()
	{
		return $this->author;
	}

	public function getTitle()
	{
		return $this->title;
	}

	public function getJournal()
	{
		return $this->journal;
	}

	public function getContent()
	{
		return $this->content;
	}

	public function getLink()
	{
		return $this->link;
	}
}

?>
