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


use KiwiCommerce\LoginAsCustomer\Model\Connector;
use KiwiCommerce\LoginAsCustomer\Ui\Component\Listing\Column;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

/**
 * Class CustomerActions
 */
class Actions extends Column
{

    /**
     * @var Connector
     */
    private $connector;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        AuthorizationInterface $authorization,
        Connector $connector,
        array $components = [],
        array $data = []
    ) {
        $this->connector = $connector;
        parent::__construct($context, $uiComponentFactory, $urlBuilder, $authorization, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if ($this->isFeatureEnabled() && isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                $item['customer_id'] = $item['entity_id'];
            }
        }

        return parent::prepareDataSource($dataSource);
    }

    /**
     * @inheritDoc
     */
    public function getLoginFrom(): int
    {
        return 1;
    }

    /**
     * @inheritDoc
     */
    public function isGridViewEnabled(): bool
    {
        return $this->connector->isShowOnCustomerGrid();
    }
}
