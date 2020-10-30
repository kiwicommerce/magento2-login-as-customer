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

namespace KiwiCommerce\LoginAsCustomer\Block\Adminhtml\Order;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\AuthorizationInterface;

class View extends \Magento\Sales\Block\Adminhtml\Order\View
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * View constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Sales\Model\Config $salesConfig
     * @param \Magento\Sales\Helper\Reorder $reorderHelper
     * @param CustomerRepositoryInterface $customerRepository
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Sales\Model\Config $salesConfig,
        \Magento\Sales\Helper\Reorder $reorderHelper,
        CustomerRepositoryInterface $customerRepository,
        array $data = []
    ) {
        $this->customerRepository = $customerRepository;
        parent::__construct($context, $registry, $salesConfig, $reorderHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();

        /*Check order is exist or not */
        $order = $this->getOrder();
        if (! $order) {
            return;
        }

        try {
            $customerId = $this->getOrder()->getCustomerId();
            /* Check customer is exist in customer table or not if not then return on detail page */
            $this->customerRepository->getById($customerId);
        } catch (\Exception $e) {
            return;
        }

        /*Check ACL config*/
        $hidden = $this->_authorization->isAllowed('KiwiCommerce_LoginAsCustomer::OrderGrid');

        /*Check config setting is on or not for show the login as customer tab*/

        $loginAsCustomerEnabled = $this->_scopeConfig->getValue(
            'kiwicommerce/general/login_as_customer_enabled',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        /*Check condition for order view page*/

        $orderViewPage = $this->_scopeConfig->getValue(
            'kiwicommerce/button_visibility/order_view_page',
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );

        /*Code for show the tab*/

        if ($loginAsCustomerEnabled == "1"
            && $orderViewPage == "1"
            && $hidden == "1"

        ) {
            $urlData = $this->_urlBuilder->getUrl(
                'loginascustomer/loginascustomer/login',
                ['customer_id' => $customerId, 'login_from' => 3]
            );
            $this->buttonList->add(
                'loginascustomer',
                [
                    'label' => __('Login As Customer'),
                    'class' => 'loginascustomer',
                    'onclick' => 'window.open(\'' . $urlData . '\', \'_blank\')'
                ]
            );
        }
    }
}
