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

/**
 * Login as customer button
 */
class Login extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var \Magento\Framework\AuthorizationInterface
     */
    private $authorization;
    /**
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;

    /**
     * Login constructor.
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry
    ) {
        parent::__construct($context, $registry);

        $this->authorization = $context->getAuthorization();
        $this->urlBuilder = $context->getUrlBuilder();
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        $customerId = $this->getCustomerId();
        if (! $customerId || ! $this->authorization->isAllowed('KiwiCommerce_LoginAsCustomer::CustomerView')) {
            return [];
        }

        $urlData = $this->urlBuilder->getUrl(
            'loginascustomer/loginascustomer/login',
            ['customer_id' => $customerId, 'login_from' => 2]
        );

        return [
            'label' =>  __('Login As Customer'),
            'class' => 'login login-button',
            'on_click' => 'window.open(\'' . $urlData . '\', \'_blank\')'
        ];
    }

}
