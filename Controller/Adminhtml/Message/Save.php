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
use Magento\Contact\Model\MailInterface;
use Magento\Framework\Controller\ResultFactory;
use Omer\Contact\Model\ContactFactory;

/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 */
class Save extends Action
{
    /**
     * @var ContactFactory
     */
    protected $contactFactory;

    /**
     * @var MailInterface
     */
    private $mail;

    /**
     * @param Context $context
     * @param ContactFactory $contactFactory
     * @param MailInterface $mail
     */
    public function __construct(
        Context $context,
        ContactFactory $contactFactory,
        MailInterface $mail
    ) {
        parent::__construct($context);
        $this->contactFactory = $contactFactory;
        $this->mail = $mail;
    }

    /**
     * Delete action
     *
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $messageId = $this->getRequest()->getParam('id');

        $messageModel = $this->contactFactory->create();
        $messageModel->load($messageId);
        if ($messageModel->getId()) {
            $status = $this->getRequest()->getParam('status');
            try {
                $answer = $this->getRequest()->getParam('answer');
                if (!empty($answer)) {
                    $this->_eventManager->dispatch(
                        'omer_contact_fast_answer',
                        ['message' => $messageModel, 'request' => $this->getRequest(), 'answer' => $answer]
                    );
                    $status = \Omer\Contact\Api\Data\ContactInterface::STATUS_ANSWERED;
                    $this->messageManager->addSuccess(__('The letter with answer has been sent.'));
                }

                $messageModel->setStatus($status);

                $messageModel->save();
                $this->messageManager->addSuccess(__('The record has been saved.'));
                $this->_objectManager->get(\Magento\Backend\Model\Session::class)->setFormData(false);
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['id' => $messageModel->getId(), '_current' => true]);
                }
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\RuntimeException $e) {
                $this->messageManager->addError($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addException($e, __('Something went wrong while saving the record.'));
            }
        } else {
            $this->messageManager->addError(__('This record no longer exists.'));
        }

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
        return $this->_authorization->isAllowed('Omer_Contact::save');
    }
}
