<?php
namespace Thesagaydak\News\Controller\Adminhtml\Post;

use Thesagaydak\News\Model\PostFactory;

class Edit extends \Thesagaydak\News\Controller\Adminhtml\Post
{
    /**
     * Backend session
     *
     * @var \Magento\Backend\Model\Session
     */
    protected $_backendSession;

    /**
     * Page factory
     *
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $_resultPageFactory;

    /**
     * Result JSON factory
     *
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_resultJsonFactory;

    public function __construct(
        \Magento\Backend\Model\Session $backendSession,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        PostFactory $postFactory,
        \Magento\Framework\Registry $registry,
        \Magento\Backend\Model\View\Result\RedirectFactory $resultRedirectFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_backendSession    = $backendSession;
        $this->_resultPageFactory = $resultPageFactory;
        $this->_resultJsonFactory = $resultJsonFactory;
        parent::__construct($postFactory, $registry, $resultRedirectFactory, $context);
    }

    /**
     * is action allowed
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Thesagaydak_News::post');
    }

    /**
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Backend\Model\View\Result\Redirect|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $post = $this->_initPost();
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Thesagaydak_News::post');
        $resultPage->getConfig()->getTitle()->set(__('Posts'));
        if ($id) {
            $post->load($id);
            if (!$post->getId()) {
                $this->messageManager->addError(__('This Post no longer exists.'));
                $resultRedirect = $this->_resultRedirectFactory->create();
                $resultRedirect->setPath(
                    [
                        'id' => $post->getId(),
                        '_current' => true
                    ]
                );
                return $resultRedirect;
            }
        }
        $title = $post->getId() ? $post->getName() : __('New Post');
        $resultPage->getConfig()->getTitle()->prepend($title);
        $data = $this->_backendSession->getData('thesagaydak_news_post_data', true);
        if (!empty($data)) {
            $post->setData($data);
        }


        return $resultPage;
    }
}
