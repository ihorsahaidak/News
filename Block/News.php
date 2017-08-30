<?php
namespace Thesagaydak\News\Block;

use Magento\Framework\View\Element\Template;
use Thesagaydak\News\Model\Post;
use Thesagaydak\News\Model\Tag;

class News extends Template
{
    public $model;

    public $tag_model;

    public function __construct(Template\Context $context, Post $model, Tag $tag_model)
    {
        $this->model = $model;
        $this->tag_model = $tag_model;
        parent::__construct($context);
    }

    public function getHelloWorldTxt()
    {
        return 'Hello world!';
    }

    /**
     * Get all posts
     *
     * @return \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    public function getPosts()
    {
        $posts_collection = $this->model->getCollection();
        return $posts_collection;
    }

    /**
     * Get all tags
     *
     * @return \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    public function getTags()
    {
        $tags_collection = $this->tag_model->getCollection();
        return $tags_collection;
    }
}