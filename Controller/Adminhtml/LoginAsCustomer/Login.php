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

use Exception;
use KiwiCommerce\LoginAsCustomer\Helper\Data;
use KiwiCommerce\LoginAsCustomer\Model\LoginAsCustomer;
use KiwiCommerce\LoginAsCustomer\Model\LoginAsCustomerFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Auth\Session;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\HTTP\PhpEnvironment\RemoteAddress;
use Magento\Framework\Url;

class Login extends Action
{
    /**
     * @var RemoteAddress
     */
    private $remoteAddress;
    /**
     * @var Session
     */
    private $session;
    /**
     * @var Url
     */
    private $urlBuilder;
    /**
     * @var Data
     */
    private $helper;
    /**
     * @var AuthorizationInterface
     */
    private $authorization;
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;
    /**
     * @var LoginAsCustomerFactory
     */
    private $loginAsCustomerFactory;

    /**
     * Login constructor.
     * @param Context $context
     * @param RemoteAddress $remoteAddress
     * @param Session $session
     * @param Url $urlBuilder
     * @param LoginAsCustomerFactory $loginAsCustomerFactory
     * @param CustomerRepositoryInterface $customerRepository
     * @param Data $helper
     */
    public function __construct(
        Context $context,
        Url $urlBuilder,
        RemoteAddress $remoteAddress,
        Session $session,
        LoginAsCustomerFactory $loginAsCustomerFactory,
        CustomerRepositoryInterface $customerRepository,
        Data $helper
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->remoteAddress = $remoteAddress;
        $this->session = $session;
        $this->loginAsCustomerFactory = $loginAsCustomerFactory;
        $this->customerRepository = $customerRepository;
        $this->helper = $helper;
        $this->authorization = $context->getAuthorization();

        parent::__construct($context);
    }

    /**
     * Index action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $customerId = +$this->getRequest()->getParam('customer_id');
        $loginFrom = +$this->getRequest()->getParam('login_from');

        try {
            $this->validateResourceId($loginFrom);
            $customer = $this->getFrontendCustomer($customerId);

            $adminUser = $this->session->getUser();

        } catch (Exception $e) {
            $this->messageManager->addErrorMessage(__($e->getMessage()));
            return $this->_redirect('dashboard');
        }

        /** @var LoginAsCustomer $login */
        $login = $this->loginAsCustomerFactory->create();

        $login->setCustomerId($customer->getId());

        // Delete older entries
        $login->deleteNotUsed();

        $login->generate(
            $adminUser->getId(),
            $adminUser->getName(),
            $adminUser->getUserName(),
            $loginFrom,
            $customer->getEmail(),
            $this->remoteAddress->getRemoteAddress()
        );

        $this->getResponse()
                ->setRedirect(
                    $this->getFrontendLoginUrl($customer, $login)
                );
    }

    public function validateResourceId(int $loginFrom): void
    {
        $resourceId = $this->helper->getAclResourceId($loginFrom);

        // Check if user has access to given resource
        if (! $this->authorization->isAllowed($resourceId)) {
            throw new Exception('Requested resource is not allowed');
        }
    }

    /**
     * @param int $customerId
     * @return CustomerInterface
     * @throws LocalizedException
     * @throws NoSuchEntityException
     */
    public function getFrontendCustomer(int $customerId): CustomerInterface
    {
        return $this->customerRepository->getById($customerId);
    }

    public function getFrontendLoginUrl(CustomerInterface $customer, LoginAsCustomer $loginAsCustomer)
    {
        return $this->urlBuilder->getUrl(
            'loginascustomer/login/index',
            [
                'secret' => $loginAsCustomer->getSecret(),
                '_nosid' => true,
                '_scope' => $customer->getStoreId()
            ]
        );
    }
}
