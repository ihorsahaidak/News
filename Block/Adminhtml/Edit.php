<?php
namespace Thesagaydak\News\Block\Adminhtml\Post;

use Magento\Framework\Registry;
use Magento\Backend\Block\Widget\Context;
use Magento\Backend\Block\Widget\Form\Container;

class Edit extends Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;

    /**
     * constructor
     *
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param array $data
     */
    public function __construct(Registry $coreRegistry, Context $context, array $data = [])
    {
        $this->_coreRegistry = $coreRegistry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize Post edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'post_id';
        $this->_blockGroup = 'Mageplaza_HelloWorld';
        $this->_controller = 'adminhtml_post';
        parent::_construct();
        $this->buttonList->update('save', 'label', __('Save Post'));
        $this->buttonList->add(
            'save-and-continue',
            [
                'label' => __('Save and Continue Edit'),
                'class' => 'save',
                'data_attribute' => [
                    'mage-init' => [
                        'button' => [
                            'event' => 'saveAndContinueEdit',
                            'target' => '#edit_form'
                        ]
                    ]
                ]
            ],
            -100
        );
        $this->buttonList->update('delete', 'label', __('Delete Post'));
    }
    /**
     * Retrieve text for header element depending on loaded Post
     *
     * @return string
     */
    public function getHeaderText()
    {
        $post = $this->_coreRegistry->registry('thesagaydak_news_post');
        if ($post->getId()) {
            return __("Edit Post '%1'", $this->escapeHtml($post->getName()));
        }
        return __('New Post');
    }
}
