<?php

require __DIR__ . '/../Paper.php';
class paperTest extends PHPUnit_Framework_TestCase {
  protected $paper;
  public function setUp() {
    //Paper must be initialized in this format
    $this->paper = new Paper("Test Title", "Test Author", "Test Journal", "Test Link", array("Test", "Content"));
  }

  //Tests to check if the paper title matches up
  public function testGetTitle(){
    $this->assertEquals("Test Title", $this->paper->getTitle());
  }

  //Tests to check if the author matches up to the created author
  public function testGetAuthor(){
    $this->assertEquals("Test Author", $this->paper->getAuthor());
  }

  //Tests to check if the Journal of the paper matches up to the initialized Journal
  public function testGetJournal(){
    $this->assertEquals("Test Journal", $this->paper->getJournal());
  }

  //Tests to check if the Link is the provided link
  public function testGetLink(){
    $this->assertEquals("Test Link", $this->paper->getLink());
  }

  //Tests to check if the content is an array of parsed words
  public function testGetContent(){
    $this->assertEquals(array("Test", "Content"), $this->paper->getContent());
  }

}
