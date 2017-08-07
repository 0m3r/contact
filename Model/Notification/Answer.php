<?php
/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 * @copyright 2017
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Omer\Contact\Model\Notification;

use Magento\Framework\Event\ObserverInterface;

/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 */
class Answer implements ObserverInterface
{
    /**
     * @var \Magento\Framework\Translate\Inline\StateInterface
     */
    protected $inlineTranslation;

    /**
     * Store manager
     *
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Magento\Framework\Mail\Template\TransportBuilder
     */
    protected $transportBuilder;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

     /**
      * @var \Magento\Store\Model\App\Emulation
      */
    protected $appEmulation;

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    protected $authSession;


    /**
     * Initialize dependencies.
     *
     * @param \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param \Magento\Store\Model\App\Emulation $appEmulation
     * @param \Magento\Backend\Model\Auth\Session $authSession
     */
    public function __construct(
        \Magento\Framework\Translate\Inline\StateInterface $inlineTranslation,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Mail\Template\TransportBuilder $transportBuilder,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        \Magento\Store\Model\App\Emulation $appEmulation,
        \Magento\Backend\Model\Auth\Session $authSession
    ) {
        $this->inlineTranslation = $inlineTranslation;
        $this->storeManager = $storeManager;
        $this->transportBuilder = $transportBuilder;
        $this->scopeConfig = $scopeConfig;
        $this->appEmulation = $appEmulation;
        $this->authSession = $authSession;
    }

    /**
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $request = $observer->getEvent()->getRequest();
        $message = $observer->getEvent()->getMessage();
        $answer  = $observer->getEvent()->getAnswer();

        $id = $request->getParam('id');
        $message->load($id);
        if (!$message->getId() || empty($answer)) {
            return $this;
        }

        $store = $this->storeManager->getStore($message->getStoreId());

        $area = \Magento\Framework\App\Area::AREA_FRONTEND;
        $this->appEmulation->startEnvironmentEmulation($store->getId(), $area);

        $adminUser = $this->authSession->getUser();
        $from = ['email' => $adminUser->getEmail(), 'name' => $adminUser->getUsername()];
        $to = ['email' => $message->getEmail(), 'name' => $message->getName()];

        $templateId = 'omer_contact_fast_answer';

        $vars = [
            'user_name' => $message->getName(),
            'comment'   => $message->getComment(),
            'answer'    => $answer,
        ];

        $this->inlineTranslation->suspend();
        $transport = $this->transportBuilder
            ->setTemplateIdentifier($templateId)
            ->setTemplateOptions([
                'area' => $area,
                'store' => $store->getId(),
            ])
            ->setTemplateVars($vars)
            ->setFrom($from)
            ->addTo($to['email'], $to['name'])
            ->getTransport();
        $transport->sendMessage();
        $this->inlineTranslation->resume();

        $this->appEmulation->stopEnvironmentEmulation();

        return $this;
    }
}
