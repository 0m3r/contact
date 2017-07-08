<?php
/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 * @copyright 2017
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Omer\Contact\Api\Data;

/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 */
interface ContactInterface
{
    const ID          = 'id';
    const NAME        = 'name';
    const EMAIL       = 'email';
    const TELEPHONE   = 'telephone';
    const COMMENT     = 'comment';
    const CUSTOMER_ID = 'customer_id';
    const STATUS      = 'status';
    const STORE_ID    = 'store_id';
    const CREATED     = 'created';
    const UPDATE      = 'update';

    const STATUS_PENDING  = 1;
    const STATUS_APPROVED = 2;
    const STATUS_CLOSE    = 4;

    /**
     * Get id
     *
     * @return int
     */
    public function getId();

    /**
     * Get name
     *
     * @return string
     */
    public function getName();

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail();

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone();

    /**
     * Get comment
     *
     * @return string
     */
    public function getComment();

    /**
     * Get customer_id
     *
     * @return int
     */
    public function getCustomerId();

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus();

    /**
     * Get store_id
     *
     * @return int
     */
    public function getStoreId();

    /**
     * Get created
     *
     * @return string
     */
    public function getCreated();

    /**
     * Get update
     *
     * @return string
     */
    public function getUpdate();


    /**
     * Set id
     *
     * @param int $id
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setId($id);

    /**
     * Set name
     *
     * @param string $name
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setName($name);

    /**
     * Set email
     *
     * @param string $email
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setEmail($email);

    /**
     * Set telephone
     *
     * @param string $telephone
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setTelephone($telephone);

    /**
     * Set comment
     *
     * @param string $comment
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setComment($comment);

    /**
     * Set customer_id
     *
     * @param int $customerId
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setCustomerId($customerId);

    /**
     * Set status
     *
     * @param int $status
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setStatus($status);

    /**
     * Set store_id
     *
     * @param int $storeId
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setStoreId($storeId);

    /**
     * Set created
     *
     * @param string $created
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setCreated($created);

    /**
     * Set update
     *
     * @param string $update
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function setUpdate($update);
}
