<?php
namespace Thesagaydak\News\Controller\Adminhtml\Post;

abstract class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * JSON Factory
     * 
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $_jsonFactory;

    /**
     * Post Factory
     * 
     * @var \Mageplaza\HelloWorld\Model\PostFactory
     */
    protected $_postFactory;

    public function __construct(
        \Magento\Framework\Controller\Result\JsonFactory $jsonFactory,
        \Thesagaydak\News\Model\PostFactory $postFactory,
        \Magento\Backend\App\Action\Context $context
    )
    {
        $this->_jsonFactory = $jsonFactory;
        $this->_postFactory = $postFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultJson = $this->_jsonFactory->create();
        $error = false;
        $messages = [];
        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }
        foreach (array_keys($postItems) as $postId) {
            $post = $this->_postFactory->create()->load($postId);
            try {
                $postData = $postItems[$postId];//todo: handle dates
                $post->addData($postData);
                $post->save();
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithPostId($post, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithPostId($post, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithPostId(
                    $post,
                    __('Something went wrong while saving the Post.')
                );
                $error = true;
            }
        }
        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Add Post id to error message
     *
     * @param \Mageplaza\HelloWorld\Model\Post $post
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithPostId(\Mageplaza\HelloWorld\Model\Post $post, $errorText)
    {
        return '[Post ID: ' . $post->getId() . '] ' . $errorText;
    }
}
