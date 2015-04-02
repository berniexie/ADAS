<?php

require __DIR__ . '/../src/ResearchPaperAPI.php';
class paperTest extends PHPUnit_Framework_TestCase {
  protected $api;
  public function setUp() {
    $this->api = new ResearchPaperAPI();
  }

  //Tests getPapersByAuthor ensuring all papers returned are by a certain author
  public function testGetPapersByAuthor(){
    $author = "James";
    $limit = 25;
    $papers = $this->api->getPapersByAuthor($author, $limit);
    $this->assertNotEmpty($papers);
    $this->assertGreaterThanOrEqual($limit, count($papers));
  }

  //Tests that a non-empty set is returned when searching by keyword
  public function testGetPapersByKeywords(){
    $key_words = "computer science";
    $limit = "25";
    $papers = $this->api->getPapersByKeyWords($key_words, $limit);
    $this->assertNotEmpty($papers);
    $this->assertGreaterThanOrEqual($limit, count($papers));
  }

  //Tests that all papers are in the given journal
  public function testGetPapersByJournal() {
    $journal = "Visualization and Computer Graphics, IEEE Transactions on";
    $limit = 25;
    $papers = $this->api->getPapersByJournal($journal, $limit);
    foreach ($papers as $p) {
      $this->assertEquals($journal, $p->getJournal());
    }
  }

}