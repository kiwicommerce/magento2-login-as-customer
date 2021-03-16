<?php
/**
 * KiwiCommerce
 *
 * Do not edit or add to this file if you wish to upgrade to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please contact us https://kiwicommerce.co.uk/contacts.
 *
 * @category   KiwiCommerce
 * @package    KiwiCommerce_LoginAsCustomer
 * @copyright  Copyright (C) 2018 Kiwi Commerce Ltd (https://kiwicommerce.co.uk/)
 * @license    https://kiwicommerce.co.uk/magento2-extension-license/
 */

namespace KiwiCommerce\LoginAsCustomer\Ui\Component\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;
use KiwiCommerce\LoginAsCustomer\Helper\Data;

/**
 * Class CustomerActions
 */
class LoginFromOptions implements OptionSourceInterface
{
    /**
     * @var Data
     */
    private $helper;

    /**
     * LoginFromOptions constructor.
     * @param Data $helper
     */
    public function __construct(Data $helper)
    {
        $this->helper = $helper;
    }
    /**
     * @return array
     */
    public function toOptionArray()
    {
        /*Get Login Option Array Using Helper */

        return $this->helper->loginOptionsForFilter();
    }
}
