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
 * @copyright  Copyright (C) 2018 Kiwi Commerce Ltd(https://kiwicommerce.co.uk/)
 * @license    https://kiwicommerce.co.uk/magento2-extension-license/
 */

namespace KiwiCommerce\LoginAsCustomer\Controller\Adminhtml\LoginAsCustomer;

class Login extends \Magento\Backend\App\Action
{
    /**
     * Login constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */

    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    public $resultPageFactory;

    /**
     * @var \KiwiCommerce\LoginAsCustomer\Model\LoginAsCustomer
     */
    public $kiwiLoginCustomer;

    /**
     * @var \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress
     */
    public $kiwiRemoteAddress;

    /**
     * @var \Magento\Backend\Model\Auth\Session
     */
    public $kiwiSession;

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    public $kiwiStoreManager;

    /**
     * @var \Magento\Framework\Url
     */
    public $kiwiUrl;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \KiwiCommerce\LoginAsCustomer\Model\LoginAsCustomer $kiwiLoginCustomer,
        \Magento\Framework\HTTP\PhpEnvironment\RemoteAddress $kiwiRemoteAddress,
        \Magento\Backend\Model\Auth\Session $kiwiSession,
        \Magento\Store\Model\StoreManagerInterface $kiwiStoreManager,
        \Magento\Framework\Url $kiwiUrl
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->kiwiLoginCustomer = $kiwiLoginCustomer;
        $this->kiwiRemoteAddress = $kiwiRemoteAddress;
        $this->kiwiSession = $kiwiSession;
        $this->kiwiStoreManager = $kiwiStoreManager;
        $this->kiwiUrl = $kiwiUrl;
        parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $customerId = (int) $this->getRequest()->getParam('customer_id');
        $loginFrom = (int) $this->getRequest()->getParam('login_from');
        $login = $this->kiwiLoginCustomer->setCustomerId($customerId);

        $login->deleteNotUsed();
        $customer = $login->getCustomer();

        if (!$customer->getId()) {
            $this->messageManager->addErrorMessage(__('This is not valid customer/ Customer not found'));
            $this->_redirect('customer/index/index');
            return;
            }
        $user = $this->kiwiSession->getUser();

        /*Pass admin data*/

        $adminId = $user->getId();
        $adminName = $user->getfirstname();
        $adminUsername = $user->getusername();
        $customerEmail = $customer->getEmail();
        $customerStoreId = $customer->getData('store_id');

        /*Get ip address of client*/
        $ip = $this->kiwiRemoteAddress->getRemoteAddress();

        /*Client ip address code end*/

        $login->generate(
            $adminId,
            $adminName,
            $adminUsername,
            $loginFrom,
            $customerEmail,
            $ip
        );
        $store = $this->kiwiStoreManager->getStore($customerStoreId);
        $url = $this->kiwiUrl->setScope($store);
        $redirectUrl = $url->getUrl(
            'loginascustomer/login/index',
            ['secret' => $login->getSecret(),
                '_nosid' => true]
        );
        $this->getResponse()->setRedirect(
            $redirectUrl
        );

    }
}
