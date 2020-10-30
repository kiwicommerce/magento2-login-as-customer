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

namespace KiwiCommerce\LoginAsCustomer\Ui\Component\Listing\Column;

use KiwiCommerce\LoginAsCustomer\Ui\Component\Listing\Column;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\AuthorizationInterface;
use KiwiCommerce\LoginAsCustomer\Model\Connector;

/**
 * Class CustomerActions
 */
class OrderAction extends Column
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @var Connector
     */
    protected $connector;

    /**
     * OrderAction constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param AuthorizationInterface $authorization
     * @param Connector $connector
     * @param CustomerRepositoryInterface $customerRepository
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        AuthorizationInterface $authorization,
        Connector $connector,
        CustomerRepositoryInterface $customerRepository,
        array $components = [],
        array $data = []
    ) {
        $this->customerRepository = $customerRepository;
        $this->connector = $connector;
        parent::__construct($context, $uiComponentFactory, $urlBuilder, $authorization, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if ($this->isFeatureEnabled() && isset($dataSource['data']['items'])) {

            foreach ($dataSource['data']['items'] as &$item) {
                if (! $item['customer_id']) {
                    continue;
                }

                try {
                    /**
                     * Get customer id from customer table customer not exist it will
                     * throw exception handel by catch
                     */
                    $this->customerRepository->getById($item['customer_id']);
                } catch (NoSuchEntityException $e) {
                    $item['customer_id'] = null;
                }
            }
        }

        return parent::prepareDataSource($dataSource);
    }

    /**
     * @inheritDoc
     */
    public function getLoginFrom(): int
    {
        return 4;
    }

    /**
     * @inheritDoc
     */
    public function isGridViewEnabled(): bool
    {
        return $this->connector->isShowOnOrderGrid();
    }
}
