<?php
/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 * @copyright 2017
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Omer\Contact\Api;

/**
 * Contact CRUD interface.
 * @api
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 */

interface ContactRepositoryInterface
{

    /**
     * Save contact.
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     *
     * @param \Omer\Contact\Api\Data\ContactInterface $contact The contact
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function save(Data\ContactInterface $contact);

    /**
     * Retrieve contact by contact id
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     *
     * @param int $id contact id.
     * @return \Omer\Contact\Api\Data\ContactInterface
     */
    public function getById($id);

    /**
     * Retrieve contacts matching the specified criteria.
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria The search criteria
     * @return \Omer\Contact\Api\Data\ContactSearchResultsInterface
     */
    public function getList(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria);

    /**
     * Delete contact.
     *
     * @throws \Magento\Framework\Exception\LocalizedException
     *
     * @param \Omer\Contact\Api\Data\ContactInterface $contact The contact
     * @return bool true on success
     */
    public function delete(Data\ContactInterface $contact);

    /**
     * Delete contact by ID.
     *
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     *
     * @param int $id The contact Id
     * @return bool true on success
     */
    public function deleteById();
}
