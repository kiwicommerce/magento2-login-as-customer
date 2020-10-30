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

namespace KiwiCommerce\LoginAsCustomer\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

/**
 * Class Data
 * @package KiwiCommerce\LoginAsCustomer\Helper
 */
class Data extends AbstractHelper
{
    private $loginOptions = [
        1 => "Customer Grid",
        2 => "Customer Edit",
        3 => "Order View",
        4 => "Order Grid",
        5 => "Invoice View",
        6 => "Invoice Grid",
        7 => "Shipment View",
        8 => "Shipment Grid",
        9 => "Credit Memo View",
        10 => "Credit Memo Grid",
    ];

    /**
     * @return array
     */
    public function loginOptionsForFilter()
    {
        return array_map(function ($label, $value) {
            return [
                'value' => $value,
                'label' => $label
            ];
        }, $this->loginOptions, array_keys($this->loginOptions));
    }

    /**
     * @return array
     */
    public function loginOptionsForListing()
    {
        return $this->loginOptions;
    }
}
