<?php


namespace KiwiCommerce\LoginAsCustomer\Block\Widget\Button;


use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Backend\Block\Widget\Button\ButtonList;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\UrlInterface;
use Magento\Sales\Api\Data\OrderInterface;

class ToolbarPlugin
{

    /**
     * @var UrlInterface
     */
    private $urlBuilder;
    /**
     * @var AuthorizationInterface
     */
    private $authorization;
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * CreditMemo constructor.
     * @param AuthorizationInterface $authorization
     * @param UrlInterface $urlBuilder
     * @param CustomerRepositoryInterface $customerRepository
     */
    public function __construct(
        AuthorizationInterface $authorization,
        UrlInterface $urlBuilder,
        CustomerRepositoryInterface $customerRepository
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->authorization = $authorization;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param OrderInterface $order
     * @param ButtonList $buttonList
     * @param string $aclResourceId
     * @param int $loginFrom
     * @return void
     */
    public function addLoginAsCustomerViaOrder(OrderInterface $order, ButtonList $buttonList, string $aclResourceId, int $loginFrom)
    {
        if (!$this->authorization->isAllowed($aclResourceId)) {
            return;
        }

        $customerId = $order->getCustomerId();
        if (!$customerId) {
            return;
        }

        try {
            /* Check customer is exist in customer table or not if not then return on detail page */
            $this->customerRepository->getById($customerId);
        } catch (Exception $e) {
            return;
        }

        $urlData = $this->urlBuilder->getUrl(
            'loginascustomer/loginascustomer/login',
            [
                'customer_id' => $customerId,
                'login_from' => $loginFrom
            ]
        );
        $buttonList->add(
            'login_as_customer',
            [
                'label' => __('Login As Customer'),
                'class' => 'loginascustomer',
                'onclick' => 'window.open(\'' . $urlData . '\', \'_blank\')'
            ]
        );
    }
}
