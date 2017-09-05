<?php
namespace Thesagaydak\News\Model;

use Magento\Framework\Model\AbstractModel;

class Post extends AbstractModel
{
    /**
     * Cache tag
     *
     * @var string
     */
    const CACHE_TAG = 'thesagaydak_news_post';

    /**
     * Cache tag
     *
     * @var string
     */
    protected $_cacheTag = 'thesagaydak_news_post';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'thesagaydak_news_post';


    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Thesagaydak\News\Model\ResourceModel\Post');
    }

    /**
     * Get identities
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }


    public function getPostLink()
    {
        $values = '/news/post/view/id/' . $this->getData('id');

        return $values;
    }
}