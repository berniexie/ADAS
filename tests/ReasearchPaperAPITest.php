<?php

require __DIR__ . '/../src/ResearchPaperAPI.php';
class paperTest extends PHPUnit_Framework_TestCase {
  protected $api;
  public function setUp() {
    $this->api = new ResearchPaperAPI();
  }

  //Tests getPapersByAuthor ensuring all papers returned are by a certain author
  public function testGetPapersByAuthor(){
    $author = "Jones";
    $papers = $this->api->getPapersByAuthor($author);
    foreach ($papers as $p) {
      $this->assertEquals($author, $p->getAuthor());
    }
  }

  //Tests that a non-empty set is returned when searching by keyword
  public function testGetPapersByKeywords(){
    $key_words = "computer science";
    $papers = $this->api->getPapersByKeyWords($key_words);
    $this->assertNotEmpty($papers);
  }

  //Tests that all papers are in the given journal
  public function testGetPapersByJournal() {
    $journal = "Journal Name";
    $papers = $this->api->getPapersByJournal($journal);
    foreach ($papers as $p) {
      $this->assertEquals($journal, $p->getJournal());
    }
  }

}