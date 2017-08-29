<?php
namespace Thesagaydak\News\Block;

use Magento\Framework\View\Element\Template;
use Thesagaydak\News\Model\Post;

class News extends Template
{
    public $model;

    public function __construct(Template\Context $context, Post $model)
    {
        $this->model = $model;
        parent::__construct($context);
    }

    public function getHelloWorldTxt()
    {
        return 'Hello world!';
    }

    public function getModel()
    {
        $helloCollection = $this->model->getCollection();
        return $helloCollection;
    }
}