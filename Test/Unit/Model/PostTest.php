<?php
namespace Thesagaydak\News\Test\Unit\Model;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

class PostTest extends \PHPUnit_Framework_TestCase
{
    protected $helloMessage;

    protected $expectedMessage;

    public function setUp()
    {
        $objectMananger = new ObjectManager($this);
        $this->helloMessage = $objectMananger->getObject('Thesagaydak\News\Model\Post');
    }


    public function testGetNumber()
    {
        $this->assertEquals(true, !empty($this->helloMessage->getPostLink()));
    }
}
