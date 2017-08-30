<?php
namespace Thesagaydak\News\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\Model\ResourceModel\Db\Context;

class Tag extends AbstractDb
{
    /**
     * Date model
     *
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $_date;

    /**
     * constructor
     *
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $date
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(DateTime $date, Context $context)
    {
        $this->_date = $date;
        parent::__construct($context);
    }

    /**
     * Overwrited abstract class method to init table
     */
    protected function _construct()
    {
        $this->_init('thesagaydak_news_tag', 'id');
    }
}