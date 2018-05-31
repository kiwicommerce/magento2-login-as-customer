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

namespace KiwiCommerce\LoginAsCustomer\Model;

class Connector
{
    /*KiwiCommerce setting */
    const CONFIG_LAC_ENABLED = 'kiwicommerce/general/login_as_customer_enabled';

    const CONFIG_LAC_INVOICE_VIEW_PAGE = 'kiwicommerce/button_visibility/invoice_view_page';
    const CONFIG_LAC_INVOICE_GRID_PAGE = 'kiwicommerce/button_visibility/invoice_grid_page';

    const CONFIG_LAC_CUSTOMER_GRID_PAGE = 'kiwicommerce/button_visibility/customer_grid_page';
    const CONFIG_LAC_CUSTOMER_VIEW_PAGE = 'kiwicommerce/button_visibility/customer_edit_page';

    const CONFIG_LAC_ORDER_VIEW_PAGE = 'kiwicommerce/button_visibility/order_view_page';
    const CONFIG_LAC_ORDER_GRID_PAGE = 'kiwicommerce/button_visibility/order_grid_page';

    const CONFIG_LAC_SHIPMENT_VIEW_PAGE = 'kiwicommerce/button_visibility/shipment_view_page';
    const CONFIG_LAC_SHIPMENT_GIRD_PAGE = 'kiwicommerce/button_visibility/shipment_grid_page';

    const CONFIG_LAC_CREDIT_MEMO_VIEW_PAGE = 'kiwicommerce/button_visibility/credit_memo_view_page';
    const CONFIG_LAC_CREDIT_MEMO_GRID_PAGE = 'kiwicommerce/button_visibility/credit_memo_grid_page';

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * Connector constructor.
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
    
        $this->scopeConfig = $scopeConfig;
    }

    /**
     * @return mixed
     */
    /*KiwiCommerce check configuration setting code*/

    /**
     * @return mixed
     */
    public function getCustomerLoginEnable()
    {
        $codeStatus =  $this->scopeConfig->getValue(
            self::CONFIG_LAC_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        return $codeStatus;
    }

    /**
     * @return mixed
     */
    public function getInvoiceViewPage()
    {
        $codeStatus =  $this->scopeConfig->getValue(
            self::CONFIG_LAC_INVOICE_VIEW_PAGE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $codeStatus;
    }

    /**
     * @return mixed
     */
    public function getInvoiceGridPage()
    {
        $codeStatus =  $this->scopeConfig->getValue(
            self::CONFIG_LAC_INVOICE_GRID_PAGE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $codeStatus;
    }

    /**
     * @return mixed
     */
    public function getCustomerViewPage()
    {
        $codeStatus =  $this->scopeConfig->getValue(
            self::CONFIG_LAC_CUSTOMER_VIEW_PAGE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $codeStatus;
    }

    /**
     * @return mixed
     */
    public function getCustomerGridPage()
    {
        $codeStatus =  $this->scopeConfig->getValue(
            self::CONFIG_LAC_CUSTOMER_GRID_PAGE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $codeStatus;
    }

    /**
     * @return mixed
     */
    public function getOrderViewPage()
    {
        $codeStatus =  $this->scopeConfig->getValue(
            self::CONFIG_LAC_ORDER_VIEW_PAGE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $codeStatus;
    }

    /**
     * @return mixed
     */
    public function getOrderGridPage()
    {
        $codeStatus =  $this->scopeConfig->getValue(
            self::CONFIG_LAC_ORDER_GRID_PAGE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $codeStatus;
    }

    /**
     * @return mixed
     */
    public function getShipmentViewPage()
    {
        $codeStatus =  $this->scopeConfig->getValue(
            self::CONFIG_LAC_SHIPMENT_VIEW_PAGE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $codeStatus;
    }

    /**
     * @return mixed
     */
    public function getShipmentGridPage()
    {
        $codeStatus =  $this->scopeConfig->getValue(
            self::CONFIG_LAC_SHIPMENT_GIRD_PAGE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $codeStatus;
    }

    /**
     * @return mixed
     */
    public function getCreditMemoViewPage()
    {
        $codeStatus =  $this->scopeConfig->getValue(
            self::CONFIG_LAC_CREDIT_MEMO_VIEW_PAGE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $codeStatus;
    }

    /**
     * @return mixed
     */
    public function getCreditMemoGridPage()
    {
        $codeStatus =  $this->scopeConfig->getValue(
            self::CONFIG_LAC_CREDIT_MEMO_GRID_PAGE,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
        return $codeStatus;
    }
}
