<?php
/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 * @copyright 2017
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Omer\Contact\Block\Adminhtml\Message\Grid\Filter;

use Omer\Contact\Model\Contact\Status as Statusses;

/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 */
class Status extends \Magento\Backend\Block\Widget\Grid\Column\Filter\Select
{

    /**
     * Get options
     *
     * @return array
     */
    protected function _getOptions()
    {
        $types = Statusses::getOptionArray();
        $result = [
            null => null
        ];
        foreach ($types as $code => $label) {
            $result[] = ['value' => $code, 'label' => __($label)];
        }

        return $result;
    }

    /**
     * Get condition
     *
     * @return array|null
     */
    public function getCondition()
    {
        if ($this->getValue() === null) {
            return null;
        }

        return ['eq' => $this->getValue()];
    }
}
