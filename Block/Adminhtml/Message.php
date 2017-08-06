<?php
/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 * @copyright 2017
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Omer\Contact\Block\Adminhtml;

/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 */
class Message extends \Magento\Backend\Block\Widget\Grid\Container
{

    /**
     * constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_controller = 'adminhtml_message';
        $this->_blockGroup = 'Omer_Contact';
        $this->_headerText = __('Contact Us Messages');
        $this->setData(self::PARAM_BUTTON_NEW, ''); //disable
        parent::_construct();
    }
}
