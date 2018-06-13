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

namespace KiwiCommerce\LoginAsCustomer\Block\Widget\Button;

use Magento\Backend\Block\Widget\Button\Toolbar as ToolbarContext;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Backend\Block\Widget\Button\ButtonList;
use KiwiCommerce\LoginAsCustomer\Model\Connector;
use Magento\Framework\UrlInterface;
use Magento\Framework\AuthorizationInterface;

class CreditMemo
{
    /**
     * @var Connector
     */
    protected $connector;
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;
    /**
     * @var AuthorizationInterface
     */
    protected $authorization;
    /**
     * @var \Magento\Customer\Model\ResourceModel\CustomerRepository
     */
    protected $customer;

    /**
     * CreditMemo constructor.
     * @param Connector $connector
     * @param AuthorizationInterface $authorization
     * @param UrlInterface $urlBuilder
     * @param \Magento\Customer\Model\ResourceModel\CustomerRepository $customer
     */
    public function __construct(
        Connector $connector,
        AuthorizationInterface $authorization,
        UrlInterface $urlBuilder,
        \Magento\Customer\Model\ResourceModel\CustomerRepository $customer
    ) {
        $this->connector = $connector;
        $this->urlBuilder = $urlBuilder;
        $this->authorization = $authorization;
        $this->customer = $customer;
    }
    /**
     * @param ToolbarContext $toolbar
     * @param AbstractBlock $context
     * @param ButtonList $buttonList
     * @return array
     */
    public function beforePushButtons(
        ToolbarContext $toolbar,
        \Magento\Framework\View\Element\AbstractBlock $context,
        \Magento\Backend\Block\Widget\Button\ButtonList $buttonList
    ) {
        if (!$context instanceof \Magento\Sales\Block\Adminhtml\Order\Creditmemo\View) {
            return [$context, $buttonList];
        }

        /* Check customer id and configuration
         * setting to show Button or not
        **/

        $customerId = $context->getCreditmemo()->getOrder()->getCustomerId();
        $loginAsCustomerEnabled = $this->connector->getCustomerLoginEnable();
        $invoiceViewPage = $this->connector->getCreditMemoViewPage();

        try {
            /* Check customer is exist in customer table or not if not then return on detail page */

            $this->customer->getById($customerId)->getId();
        } catch (\Exception $e) {
            return [$context, $buttonList];
        }

        /*Check ACL setting option*/

        $hidden = $this->authorization->isAllowed('KiwiCommerce_LoginAsCustomer::CreditMemoGrid');

        if (isset($customerId) && $loginAsCustomerEnabled == "1" && $invoiceViewPage == "1" && $hidden == "1") {
            $urlData = $this->urlBuilder->getUrl(
                'loginascustomer/loginascustomer/login',
                ['customer_id' => $customerId,
                    'login_from' => 10
                ]
            );
            $buttonList->add(
                'print_invoice',
                [
                    'label' => __('Login As Customer'),
                    'class' => 'loginascustomer',
                    'onclick' => 'window.open(\'' . $urlData . '\', \'_blank\')'
                ]
            );
        }

        return [$context, $buttonList,$toolbar];
    }
}
