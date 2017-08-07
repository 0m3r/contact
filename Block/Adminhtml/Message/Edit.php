<?php
namespace Omer\Contact\Block\Adminhtml\Message;

class Edit extends \Magento\Backend\Block\Widget\Form\Container
{
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * Initialize edit block
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_objectId = 'id';
        $this->_blockGroup = 'Omer_Contact';
        $this->_controller = 'adminhtml_message';

        parent::_construct();

        if ($this->_isAllowedAction('Omer_Contact::save')) {
            $this->buttonList->update('save', 'label', __('Save'));
            $this->buttonList->add(
                'saveandcontinue',
                [
                    'label' => __('Save and Continue Edit'),
                    'class' => 'save',
                    'data_attribute' => [
                        'mage-init' => [
                            'button' => ['event' => 'saveAndContinueEdit', 'target' => '#edit_form'],
                        ],
                    ]
                ],
                -100
            );
        } else {
            $this->buttonList->remove('save');
        }

        if ($this->_isAllowedAction('Omer_Contact::delete')) {
            $this->buttonList->update('delete', 'label', __('Delete'));
        } else {
            $this->buttonList->remove('delete');
        }

        $this->buttonList->remove('reset');

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('widget_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'widget_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'widget_content');
                }
            }
        ";
    }

    /**
     * Retrieve text for header element depending on loaded post
     *
     * @return \Magento\Framework\Phrase
     */
    public function getHeaderText()
    {
        $message = $this->coreRegistry->registry('contact_message');
        if ($message->getId()) {
            return __("Edit Message '%1'", $this->escapeHtml($message->getComment()));
        } else {
            return __('New');
        }
    }

    /**
     * Check permission for passed action
     *
     * @param string $resourceId
     * @return bool
     */
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }

    /**
     * Getter of url for "Save and Continue" button
     * tab_id will be replaced by desired by JS later
     *
     * @return string
     */
    protected function _getSaveAndContinueUrl()
    {
        return $this->getUrl('*/*/save', ['_current' => true, 'back' => 'edit', 'active_tab' => '']);
    }
}
