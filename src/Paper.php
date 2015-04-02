<?php

class Paper
{
	private $id;				// string
	private $author = array(); 	// array of strings
	private $title;				// string
	private $journal;			// string
	private $content;			// map: Word->(int)frequency
	private $link;				// string

	public function __construct($id, $author, $title, $journal, $content, $link)
	{
		$this->id = $id;
		$this->author = $author;
		$this->title = $title;
		$this->journal = $journal;
		$this->content = $content;
		$this->link = $link;
	}

	public function getId()
	{
		return $this->id;
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
