<?php
namespace Thesagaydak\News\Test\Unit\Model;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;

class PostTest extends \PHPUnit_Framework_TestCase
{
    protected $obj;

    protected $expectedMessage;

    public function setUp()
    {
        $objectManager = new ObjectManager($this);
        $this->obj = $objectManager->getObject('Thesagaydak\News\Model\Post');
    }

    public function testGetNumber()
    {
        $this->assertEquals(true, !empty($this->obj->getPostLink()));
    }

    public function testDefaultValue()
    {
        $this->assertEquals(true, is_array($this->obj->getDefaultValues()));
    }
}
