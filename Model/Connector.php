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

namespace KiwiCommerce\LoginAsCustomer\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Connector
 * @package KiwiCommerce\LoginAsCustomer\Model
 *
 * @deprecated since 2.0.0 - Fully manageable via acl list
 */
class Connector
{
    /*KiwiCommerce setting */
    const CONFIG_LAC_ENABLED                = 'kiwicommerce/general/login_as_customer_enabled';

    const CONFIG_LAC_INVOICE_VIEW_PAGE      = 'kiwicommerce/button_visibility/invoice_view_page';
    const CONFIG_LAC_INVOICE_GRID_PAGE      = 'kiwicommerce/button_visibility/invoice_grid_page';

    const CONFIG_LAC_CUSTOMER_GRID_PAGE     = 'kiwicommerce/button_visibility/customer_grid_page';
    const CONFIG_LAC_CUSTOMER_VIEW_PAGE     = 'kiwicommerce/button_visibility/customer_edit_page';

    const CONFIG_LAC_ORDER_VIEW_PAGE        = 'kiwicommerce/button_visibility/order_view_page';
    const CONFIG_LAC_ORDER_GRID_PAGE        = 'kiwicommerce/button_visibility/order_grid_page';

    const CONFIG_LAC_SHIPMENT_VIEW_PAGE     = 'kiwicommerce/button_visibility/shipment_view_page';
    const CONFIG_LAC_SHIPMENT_GIRD_PAGE     = 'kiwicommerce/button_visibility/shipment_grid_page';

    const CONFIG_LAC_CREDIT_MEMO_VIEW_PAGE  = 'kiwicommerce/button_visibility/credit_memo_view_page';
    const CONFIG_LAC_CREDIT_MEMO_GRID_PAGE  = 'kiwicommerce/button_visibility/credit_memo_grid_page';

    /**
     * @var ScopeConfigInterface
     */
    private $scopeConfig;

    /**
     * Connector constructor.
     * @param ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        ScopeConfigInterface $scopeConfig
    ) {
        $this->scopeConfig = $scopeConfig;
    }

    private function getConfigValue(string $path)
    {
        return $this->scopeConfig->getValue($path, ScopeInterface::SCOPE_STORE);
    }

    private function getConfigFlag(string $path): bool
    {
        return (bool)$this->getConfigValue($path);
    }

    /**
     * @return bool
     *
     * @deprecated since 2.0.0 - Fully manageable via acl list
     */
    public function isCustomerLoginEnabled(): bool
    {
        return $this->getConfigFlag(static::CONFIG_LAC_ENABLED);
    }

    /**
     * @return bool
     *
     * @deprecated since 2.0.0 - Fully manageable via acl list
     */
    public function isShowInInvoiceView(): bool
    {
        return $this->isCustomerLoginEnabled() && $this->getConfigFlag(static::CONFIG_LAC_INVOICE_VIEW_PAGE);
    }

    /**
     * @return bool
     *
     * @deprecated since 2.0.0 - Fully manageable via acl list
     */
    public function isShowOnInvoiceGrid(): bool
    {
        return $this->isCustomerLoginEnabled() && $this->getConfigFlag(static::CONFIG_LAC_INVOICE_GRID_PAGE);
    }

    /**
     * @return bool
     *
     * @deprecated since 2.0.0 - Fully manageable via acl list
     */
    public function isShowOnCustomerView(): bool
    {
        return $this->isCustomerLoginEnabled() && $this->getConfigFlag(static::CONFIG_LAC_CUSTOMER_VIEW_PAGE);
    }

    /**
     * @return bool
     *
     * @deprecated since 2.0.0 - Fully manageable via acl list
     */
    public function isShowOnCustomerGrid(): bool
    {
        return $this->isCustomerLoginEnabled() && $this->getConfigFlag(static::CONFIG_LAC_CUSTOMER_VIEW_PAGE);
    }

    /**
     * @return bool
     *
     * @deprecated since 2.0.0 - Fully manageable via acl list
     */
    public function isShowOnOrderView(): bool
    {
        return $this->isCustomerLoginEnabled() && $this->getConfigFlag(static::CONFIG_LAC_ORDER_VIEW_PAGE);
    }

    /**
     * @return bool
     *
     * @deprecated since 2.0.0 - Fully manageable via acl list
     */
    public function isShowOnOrderGrid(): bool
    {
        return $this->isCustomerLoginEnabled() && $this->getConfigFlag(static::CONFIG_LAC_ORDER_GRID_PAGE);
    }

    /**
     * @return bool
     *
     * @deprecated since 2.0.0 - Fully manageable via acl list
     */
    public function isShowOnShipmentView(): bool
    {
        return $this->isCustomerLoginEnabled() && $this->getConfigFlag(static::CONFIG_LAC_SHIPMENT_VIEW_PAGE);
    }

    /**
     * @return bool
     *
     * @deprecated since 2.0.0 - Fully manageable via acl list
     */
    public function isShowOnShipmentGrid(): bool
    {
        return $this->isCustomerLoginEnabled() && $this->getConfigFlag(static::CONFIG_LAC_SHIPMENT_GIRD_PAGE);
    }

    /**
     * @return bool
     *
     * @deprecated since 2.0.0 - Fully manageable via acl list
     */
    public function isShowOnCreditMemoView(): bool
    {
        return $this->isCustomerLoginEnabled() && $this->getConfigFlag(static::CONFIG_LAC_CREDIT_MEMO_VIEW_PAGE);
    }

    /**
     * @return bool
     *
     * @deprecated since 2.0.0 - Fully manageable via acl list
     */
    public function isShowOnCreditMemoGrid(): bool
    {
        return $this->isCustomerLoginEnabled() && $this->getConfigFlag(static::CONFIG_LAC_CREDIT_MEMO_GRID_PAGE);
    }
}
