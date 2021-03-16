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

namespace KiwiCommerce\LoginAsCustomer\Controller\Login;

use Exception;
use KiwiCommerce\LoginAsCustomer\Model\LoginAsCustomer;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\Action;
use Magento\Framework\Controller\ResultInterface;

/**
 * LoginAsCustomer login action
 */
class Index extends Action
{
    /**
     * @var LoginAsCustomer
     */
    public $loginAsCustomer;

    /**
     * Index constructor.
     * @param Context $context
     * @param LoginAsCustomer $loginAsCustomer
     */

    public function __construct(
        Context $context,
        LoginAsCustomer $loginAsCustomer
    ) {
        $this->loginAsCustomer = $loginAsCustomer;
        parent::__construct($context);
    }
    /**
     * Login as customer action
     *
     * @return ResultInterface|void
     */
    public function execute()
    {
        try {
            $login = $this->checkLogin();
            $login->authenticateCustomer();

            $customer = $login->getCustomer();
        } catch (Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->_redirect('customer/account/login');
            return;
        }

        $this->messageManager->addSuccessMessage(
            __('You are logged in as customer: %1', $customer->getName())
        );

        $this->_redirect($this->getRedirectUrl());
    }

    /**
     * @return LoginAsCustomer or result in array []
     * @throws Exception
     */
    public function checkLogin(): LoginAsCustomer
    {
        $secret = $this->getRequest()->getParam('secret');
        if (!$secret || !is_string($secret)) {
            throw new Exception(__('Cannot login to account. No secret key provided.'));
        }

        $login = $this->loginAsCustomer->loadNotUsed($secret);
        if (! $login->getId()) {
            throw new Exception(__('Cannot login to account. Secret key is invalid.'));
        }

        return $login;
    }

    public function getRedirectUrl(): string
    {
        return 'customer/account';
    }
}
