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

/**
 * LoginAsCustomer login action
 */
class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \KiwiCommerce\LoginAsCustomer\Model\LoginAsCustomer
     */
    public $kiwiLoginAsCustomer;

    /**
     * Index constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \KiwiCommerce\LoginAsCustomer\Model\LoginAsCustomer $kiwiLoginAsCustomer
     */

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \KiwiCommerce\LoginAsCustomer\Model\LoginAsCustomer $kiwiLoginAsCustomer
    ) {
        $this->kiwiLoginAsCustomer = $kiwiLoginAsCustomer;
        parent::__construct($context);
    }
    /**
     * Login as customer action
     *
     * @return \Magento\Framework\Controller\ResultInterface|void
     */
    public function execute()
    {
        $login = $this->checkLogin();
        if (!$login) {
            $this->_redirect('customer/account/login');
            return;
        }
        try {
            /* Log in */
            $login->authenticateCustomer();
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
            $this->_redirect('customer/account/login');
            return;
        }
        $this->messageManager->addSuccessMessage(
            __('You are logged in as customer: %1', $login->getCustomer()->getName())
        );
        $this->_redirect('customer/account');
    }

    /**
     * @return bool or result in array []
     */
    public function checkLogin()
    {
        $secret = $this->getRequest()->getParam('secret');
        if (!$secret || !is_string($secret)) {
            $this->messageManager->addErrorMessage(__('Cannot login to account. No secret key provided.'));
            return false;
        }
        $login = $this->kiwiLoginAsCustomer->loadNotUsed($secret);
        if ($login->getId()) {
            return $login;
        } else {
            $this->messageManager->addErrorMessage(__('Cannot login to account. Secret key is not valid.'));
            return false;
        }
    }
}
