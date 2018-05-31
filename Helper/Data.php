<?php
/**
 * KiwiCommerce
 *
 * Do not edit or add to this file if you wish to upgrade to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please contact us https://kiwicommerce.co.uk/contacts.
 *
 * @category   KiwiCommerce
 * @package    KiwiCommerce_Modulename
 * @copyright  Copyright (C) 2018 Kiwi Commerce Ltd (https://kiwicommerce.co.uk/)
 * @license    https://kiwicommerce.co.uk/magento2-extension-license/
 */

namespace KiwiCommerce\LoginAsCustomer\Helper;

use Magento\Customer\Model\Session as CustomerSession;

/**
 * Class Data
 * @package KiwiCommerce\LoginAsCustomer\Helper
 */
class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @return array
     */
    public function loginOptionsForFilter()
    {
        $finalArray = [
            ['value' => 1, 'label' => __('Customer Grid')],
            ['value' => 2, 'label' => __('Customer Edit')],
            ['value' => 3, 'label' => __('Order View')],
            ['value' => 4, 'label' => __('Order Grid')],
            ['value' => 5, 'label' => __('Invoice View')],
            ['value' => 6, 'label' => __('Invoice Grid')],
            ['value' => 7, 'label' => __('Shipment View')],
            ['value' => 8, 'label' => __('Shipment Grid')],
            ['value' => 9, 'label' => __('Credit Memo View')],
            ['value' => 10, 'label' => __('Credit Memo Grid')],
        ];
        return $finalArray;
    }

    /**
     * @return array
     */
    public function loginOptionsForListing()
    {
        $returnArrayList = [
            "1" => "Customer Grid",
            "2" => "Customer Edit",
            "3" => "Order View",
            "4" => "Order Grid",
            "5" => "Invoice View",
            "6" => "Invoice Grid",
            "7" => "Shipment View",
            "8" => "Shipment Grid",
            "9" => "Credit Memo View",
            "10" => "Credit Memo Grid"
        ];
        return $returnArrayList;
    }
}
