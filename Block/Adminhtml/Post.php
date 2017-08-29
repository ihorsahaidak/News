<?php
/**
 * Mageplaza_HelloWorld extension
 *                     NOTICE OF LICENSE
 *
 *                     This source file is subject to the Mageplaza License
 *                     that is bundled with this package in the file LICENSE.txt.
 *                     It is also available through the world-wide-web at this URL:
 *                     https://www.mageplaza.com/LICENSE.txt
 *
 *                     @category  Mageplaza
 *                     @package   Mageplaza_HelloWorld
 *                     @copyright Copyright (c) 2016
 *                     @license   https://www.mageplaza.com/LICENSE.txt
 */
namespace Thesagaydak\News\Block\Adminhtml;

use Magento\Backend\Block\Widget\Grid\Container;

class Post extends Container
{
    /**
     * constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_post';
        $this->_blockGroup = 'Thesagaydak_News';
        $this->_headerText = __('Posts');
        $this->_addButtonLabel = __('Create New Post');
        parent::_construct();
    }
}
