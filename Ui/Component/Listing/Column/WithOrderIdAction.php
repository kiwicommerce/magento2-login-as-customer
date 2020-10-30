<?php


namespace KiwiCommerce\LoginAsCustomer\Ui\Component\Listing\Column;


use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Sales\Api\OrderRepositoryInterface;

class WithOrderIdAction extends OrderAction
{
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        AuthorizationInterface $authorization,
        CustomerRepositoryInterface $customerRepository,
        OrderRepositoryInterface $orderRepository,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $urlBuilder, $authorization, $customerRepository,
            $components, $data);
        $this->orderRepository = $orderRepository;
    }


    public function prepareDataSource(array $dataSource)
    {
        if ($this->isFeatureEnabled() && isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as &$item) {
                if (!$item['order_id']) {
                    continue;
                }

                $order = $this->orderRepository->get($item['order_id']);
                $item['customer_id'] = $order->getCustomerId();
            }
        }

        return parent::prepareDataSource($dataSource);
    }

}
