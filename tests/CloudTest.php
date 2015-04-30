<?php

require __DIR__ . '/../src/Cloud.php';
require __DIR__ . '/../src/DataManager.php';
class CloudTest extends PHPUnit_Framework_TestCase {
    protected $cloud1;
    protected $cloud2;
    public function setUp() {
        $dm = new DataManager();
        $this->cloud1 = $dm->getCloudByKeyWord("Computer", 10);
        $this->cloud2 = $dm->getCloudByKeyWord("Robot", 10);
    }

    public function testGetId() {
        $this->assertEquals(0, $this->cloud1->getId());
        $this->assertEquals(1, $this->cloud2->getId());
    }

    public function testGetWordArray() {
        $wordArray = $this->cloud1->getWordArray();
        $this->assertNotEmpty($wordArray);
        foreach ($wordArray as $element) {
            $this->assertArrayHasKey('text', $element);
            $this->assertArrayHasKey('weight', $element);
            $this->assertArrayHasKey('link', $element);
        }
    }

    public function testGetWordObject() {
        $word = $this->cloud1->getWordObject("computer");
        $this->assertNotNull($word);
        $this->assertEquals("computer", $word->getTerm());
    }

}