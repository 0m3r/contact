<?php
/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 * @copyright 2017
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Omer\Contact\Model;

use Omer\Contact\Api\Data\ContactInterface;
use Omer\Contact\Model\ResourceModel\Contact as ContactResourceModel;
use Magento\Framework\DataObject\IdentityInterface;

/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 */
class Contact extends \Magento\Framework\Model\AbstractModel implements ContactInterface, IdentityInterface
{
    /**
     * cache tag
     */
    const CACHE_TAG = 'omer_contact';

    /**
     * @var string
     */
    protected $_cacheTag = 'omer_contact';

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'omer_contact';

    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTimeFactory
     */
    protected $dateFactory;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Stdlib\DateTime\DateTimeFactory $dateFactory
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb $resourceCollection
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Stdlib\DateTime\DateTimeFactory $dateFactory,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->dateFactory = $dateFactory;
    }

    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ContactResourceModel::class);
    }

    /**
     * Return unique ID(s) for each object in system
     *
     * @return array
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->getData(self::TELEPHONE);
    }

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment()
    {
        return $this->getData(self::COMMENT);
    }

    /**
     * Get customer_id
     *
     * @return int
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Get store_id
     *
     * @return int
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * Get created_at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Get updated_at
     *
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set id
     *
     * @param int $id
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set name
     *
     * @param string $name
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set email
     *
     * @param string $email
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setTelephone($telephone)
    {
        return $this->setData(self::TELEPHONE, $telephone);
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setComment($comment)
    {
        return $this->setData(self::COMMENT, $comment);
    }

    /**
     * Set customer_id
     *
     * @param int $customerId
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Set status
     *
     * @param int $status
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Set store_id
     *
     * @param int $storeId
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setStoreId($storeId)
    {
        return $this->setData(self::STORE_ID, $storeId);
    }

    /**
     * Set created_at
     *
     * @param string $createdAt
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setCreatedAt($createdAt)
    {
        return $this->setData(self::CREATED_AT, $createdAt);
    }

    /**
     * Set updated_at
     *
     * @param string $updatedAt
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATE_AT, $updatedAt);
    }

    /**
     * Set updated_at and created_at parameter
     *
     * @return \Magento\Framework\Model\AbstractModel
     */
    public function beforeSave()
    {
        $date = $this->dateFactory->create()->gmtDate();
        if ($this->isObjectNew() && !$this->getCreatedAt()) {
            $this->setCreatedAt($date);
        }
        $this->setUpdatedAt($date);

        return parent::beforeSave();
    }
}
