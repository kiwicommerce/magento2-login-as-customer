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

namespace KiwiCommerce\LoginAsCustomer\Block\Adminhtml\Customer\Edit;

use Magento\Customer\Block\Adminhtml\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
use KiwiCommerce\LoginAsCustomer\Model\Connector;

/**
 * Login as customer button
 */
class Login extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var \Magento\Framework\AuthorizationInterface
     */
    protected $authorization;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;
    /**
     * @var Connector
     */
    protected $connector;

    /**
     * Login constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param Connector $connector
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry,
        Connector $connector
    ) {
        parent::__construct($context, $registry);
        $this->authorization = $context->getAuthorization();
        $this->scopeConfig = $context->getScopeConfig();
        $this->urlBuilder = $context->getUrlBuilder();
        $this->connector = $connector;
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        $customerId = $this->getCustomerId();
        $data = [];

        $canModify = $customerId && $this->authorization->isAllowed('KiwiCommerce_LoginAsCustomer::CustomerView');

        /*check config setting for customer view page*/

        $loginAsCustomerEnabled = $this->connector->isCustomerLoginEnabled();

        /*check config setting for customer edit page*/

        $customerDetailLoginEnabled = $this->connector->isShowOnCustomerView();

        if ($canModify == "1" && $loginAsCustomerEnabled == "1" && $customerDetailLoginEnabled == "1") {
            $urlData = $this->urlBuilder->getUrl(
                'loginascustomer/loginascustomer/login',
                ['customer_id' => $customerId, 'login_from' => 2]
            );

            $data = [
                'label' =>  __('Login As Customer'),
                'class' => 'login login-button',
                'on_click' => 'window.open(\'' . $urlData . '\', \'_blank\')'
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getInvalidateTokenUrl()
    {
        return $this->getUrl('loginascustomer/login/login', ['customer_id' => $this->getCustomerId()]);
    }
}
