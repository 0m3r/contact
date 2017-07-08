<?php
/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 * @copyright 2017
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Omer\Contact\Observer;

use Magento\Customer\Model\Session;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Omer\Contact\Model\ContactFactory;

/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 */
class SaveByRequestObserver implements ObserverInterface
{

    /**
     * @var ContactFactory
     */
    protected $contactFactory;

    /**
     * Customer session
     *
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;

    /**
     * Constructor
     *
     * @param ContactFactory $contactFactory
     * @param Session $customerSession
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ContactFactory $contactFactory,
        Session $customerSession,
        StoreManagerInterface $storeManager
    ) {
        $this->contactFactory = $contactFactory;
        $this->customerSession = $customerSession;
        $this->storeManager = $storeManager;
    }

    /**
     * Save post request to db
     *
     * @param \Magento\Framework\Event\Observer $observer The observer
     *
     * @return $this
     */
    public function execute(Observer $observer)
    {
        /** @var \Magento\Framework\App\Action\Action $controller */
        $controller = $observer->getControllerAction();

        $params = $controller->getRequest()->getParams();
        $params['customer_id'] = $this->customerSession->getCustomer()->getId();
        $params['store_id'] = $this->storeManager->getStore()->getId();

        $contactModel = $this->contactFactory->create();
        $contactModel->setData($params);
        $contactModel->save();

        return $this;
    }
}
