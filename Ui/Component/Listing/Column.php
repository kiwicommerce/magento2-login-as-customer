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

namespace KiwiCommerce\LoginAsCustomer\Ui\Component\Listing;

use KiwiCommerce\LoginAsCustomer\Helper\Data;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\UrlInterface;
use Magento\Framework\AuthorizationInterface;
use KiwiCommerce\LoginAsCustomer\Model\Connector;

/**
 * Class CustomerActions
 */
abstract class Column extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * @var UrlInterface
     */
    private $urlBuilder;
    /**
     * @var \Magento\Framework\AuthorizationInterface
     */
    private $authorization;

    /**
     * Actions constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param AuthorizationInterface $authorization
     * @param Connector $connector
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        AuthorizationInterface $authorization,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
        $this->authorization = $authorization;
    }

    public function prepare()
    {
        if (! $this->isFeatureEnabled()) {
            $config = $this->getData('config');
            $config['componentDisabled'] = true;
            $this->setData('config', $config);
        }
        parent::prepare();
    }

    public function isFeatureEnabled(): bool
    {
        /**
         * Check the condition config setting for login
         * as customer is on or off if it's 0 then it's off hide the column
         */
        $isAllowed = $this->authorization->isAllowed('KiwiCommerce_LoginAsCustomer::CustomerGrid');
        return $isAllowed && $this->isGridViewEnabled();
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        /* This section for create login text using foreach loop*/
        if ($this->isFeatureEnabled() && isset($dataSource['data']['items'])) {
            $columnName = $this->getData('name');

            foreach ($dataSource['data']['items'] as &$item) {
                if (! isset($item['customer_id'])) {
                    continue;
                }

                $item[$columnName] = $this->prepareHtml((int)$item['customer_id'] ?? 0);
            }
        }

        return $dataSource;
    }
    /**
     * @param int $id
     * @return string
     */
    public function prepareHtml(int $id)
    {
        if (! $id) {
            return '';
        }

        $url = $this->urlBuilder->getUrl(
            'loginascustomer/loginascustomer/login',
            ['customer_id' => $id, 'login_from' => $this->getLoginFrom()]
        );

        return '<a href="'.$url.'" target="_blank">' . __('Login') . '</a>';
    }

    /**
     * Get login form
     * @see Data for posible values
     *
     * @return int
     */
    abstract public function getLoginFrom(): int;

    /**
     * Tell whether this grid column is enabled in settings
     *
     * @return bool
     */
    abstract public function isGridViewEnabled(): bool;

}
