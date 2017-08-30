<?php
namespace Thesagaydak\News\Model;

use Magento\Framework\Model\AbstractModel;

class Tag extends AbstractModel
{
    /**
     * Cache tag
     *
     * @var string
     */
    const CACHE_TAG = 'thesagaydak_news_tag';

    /**
     * Cache tag
     *
     * @var string
     */
    protected $_cacheTag = 'thesagaydak_news_tag';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'thesagaydak_news_tag';


    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Thesagaydak\News\Model\ResourceModel\Tag');
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

    /**
     * get entity default values
     *
     * @return array
     */
    public function getDefaultValues()
    {
        $values = [];

        return $values;
    }
}