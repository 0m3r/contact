<?php
/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 * @copyright 2017
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Omer\Contact\Controller\Adminhtml\Message;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Omer\Contact\Model\ContactFactory;

/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 */
class MassDelete extends Action
{
    /**
     * @var ContactFactory
     */
    protected $contactFactory;

    /**
     * @param Context $context
     * @param ContactFactory $contactFactory
     */
    public function __construct(
        Context $context,
        ContactFactory $contactFactory
    ) {
        parent::__construct($context);
        $this->contactFactory = $contactFactory;
    }

    /**
     * Mass delete action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $messageIds = $this->getRequest()->getParam('ids');
        $messageIds = explode(',', $messageIds);

        foreach ($messageIds as $messageId) {
            $messageModel = $this->contactFactory->create();
            $messageModel->load($messageId);
            if ($messageModel->getId()) {
                $messageModel->delete();
            }
        }
        $this->messageManager->addSuccess(__('Total of %1 record(s) were deleted.', count($messageIds)));
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setUrl($this->_redirect->getRefererUrl());
    }

    /**
     * Check admin permissions for this controller
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Omer_Contact::delete');
    }
}
