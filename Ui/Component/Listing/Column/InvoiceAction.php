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

/**
 * Class CustomerActions
 */
class InvoiceAction extends WithOrderIdAction
{
    /**
     * @inheritDoc
     */
    public function getLoginFrom(): int
    {
        return 6;
    }

    /**
     * @inheritDoc
     */
    public function isFeatureEnabled(): bool
    {
        return (bool)$this->authorization->isAllowed('KiwiCommerce_LoginAsCustomer::InvoiceGrid');
    }
}
