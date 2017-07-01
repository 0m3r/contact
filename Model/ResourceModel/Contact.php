<?php
/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 * @copyright 2017
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Omer\Contact\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 * Contact Contact mysql resource
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 */
class Contact extends AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('omer_contact', 'id');
    }
}
