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

namespace KiwiCommerce\LoginAsCustomer\Model\ResourceModel\LoginAsCustomer;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    /**
     * Define resource model
     *
     * @return void
     */
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';
    protected function _construct()
    {
        $this->_init(
            'KiwiCommerce\LoginAsCustomer\Model\LoginAsCustomer',
            'KiwiCommerce\LoginAsCustomer\Model\ResourceModel\LoginAsCustomer'
        );
    }
}
