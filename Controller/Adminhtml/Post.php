<?php

namespace Thesagaydak\News\Controller\Adminhtml;

use Magento\Backend\App\Action;

abstract class Post extends Action
{
    protected $_postFactory;

    protected $_coreRegistry;

    protected $_resultRedirectFactory;

    public function __construct(
        \Thesagaydak\News\Model\Post $postFactory,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_postFactory           = $postFactory;
        $this->_coreRegistry          = $coreRegistry;
        $this->_resultRedirectFactory = $resultRedirectFactory;
        parent::__construct($context);
    }

    protected function _initPost()
    {
        $postId  = (int) $this->getRequest()->getParam('id');
        $post    = $this->_postFactory->create();
        if ($postId) {
            $post->load($postId);
        }
        $this->_coreRegistry->register('thesagaydak_news_post', $post);
        return $post;
    }
}