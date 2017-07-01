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
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Omer\Contact\Model\ResourceModel\Contact');
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
     * Get created
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->getData(self::CREATED);
    }

    /**
     * Get update
     *
     * @return string
     */
    public function getUpdate()
    {
        return $this->getData(self::UPDATE);
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
     * Set created
     *
     * @param string $created
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setCreated($created)
    {
        return $this->setData(self::CREATED, $created);
    }

    /**
     * Set update
     *
     * @param string $update
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setUpdate($update)
    {
        return $this->setData(self::UPDATE, $update);
    }
}
