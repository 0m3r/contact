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

use Magento\Framework\Api\SearchResultsInterface;
use Omer\Contact\Api\Data\ContactInterface;

/**
 * Interface for message search results.
 * @api
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 */
interface ContactSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get list.
     *
     * @return ContactInterface[]
     */
    public function getItems();

    /**
     * Set list.
     *
     * @param ContactInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
