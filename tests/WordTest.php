<?php

require __DIR__ . '/../src/Word.php';
class WordTest extends PHPUnit_Framework_TestCase {
  protected $word;
  public function setUp() {
    $this->word = new Word("test", "001", 10);
  }

  public function testGetTerm() {
    $this->assertEquals("test", $this->word->getTerm());
  }

  public function testGetTotalFrequency() {
    $this->assertEquals(10, $this->word->getTotalFrequency());
  }

  public function testGetTermFrequency() {
    $this->assertEquals(array("001" => 10),$this->word->getTermFrequency());
  }

  public function testIncrementFrequency() {
    $prev_value = $this->word->getTotalFrequency();
    $this->word->incrementFrequency("001", 5);
    $new_value = $this->word->getTotalFrequency();
    $this->assertEquals($prev_value + 5, $new_value);
    $this->assertEquals(array("001" => 15), $this->word->getTermFrequency());

    $prev_value = $this->word->getTotalFrequency();
    $this->word->incrementFrequency("002", 5);
    $new_value = $this->word->getTotalFrequency();
    $this->assertEquals($prev_value + 5, $new_value);
    $this->assertEquals(array( "001" => 15, "002" => 5), $this->word->getTermFrequency());
  }



}