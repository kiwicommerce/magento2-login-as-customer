<?php
/**
 * KiwiCommerce
 *
 * Do not edit or add to this file if you wish to upgrade to newer versions in the future.
 * If you wish to customize this module for your needs.
 * Please contact us https://kiwicommerce.co.uk/contacts.
 *
 * @category   KiwiCommerce
 * @package    KiwiCommerce_Modulename
 * @copyright  Copyright (C) 2018 Kiwi Commerce Ltd (https://kiwicommerce.co.uk/)
 * @license    https://kiwicommerce.co.uk/magento2-extension-license/
 */

namespace KiwiCommerce\LoginAsCustomer\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Framework\UrlInterface;
use Magento\Framework\AuthorizationInterface;
use KiwiCommerce\LoginAsCustomer\Model\Connector;

/**
 * Class CustomerActions
 */
class Actions extends Column
{
    /**
     * @var UrlInterface
     */
    protected $urlBuilder;
    /**
     * @var Connector
     */
    protected $connector;
    /**
     * @var \Magento\Framework\AuthorizationInterface
     */
    protected $authorization;
    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    protected $scopeConfig;
    /**
     * Actions constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param AuthorizationInterface $authorization
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     * @param Connector $connector
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        AuthorizationInterface $authorization,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        Connector $connector,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->urlBuilder = $urlBuilder;
        $this->authorization = $authorization;
        $this->scopeConfig = $scopeConfig ;
        $this->connector = $connector;
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
        if (isset($dataSource['data']['items'])) {
            $hidden = !$this->authorization->isAllowed('KiwiCommerce_LoginAsCustomer::CustomerGrid');
            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')] = $this->prepareHtml($item['entity_id']);
               }
        }
        return $dataSource;
    }
    /**
     * @param $id
     * @return string
     */
    public function prepareHtml($id)
    {
        $url=$this->urlBuilder->getUrl(
            'loginascustomer/loginascustomer/login',
            ['customer_id' => $id, 'login_from' => 1]
        );
        $finalHtml = '<a href="'.$url.'" target="_blank">Login</a>';;
        return $finalHtml;
    }

    protected function _getData($key)
    {
        /* This method used to hide the column
           if config setting is off for login as customer
        */
            $loginAsCustomerEnabled = $this->connector->getCustomerLoginEnable();

        /*Check config setting for grid listing on or off*/

            $isGridViewEnabled = $this->connector->getCustomerGridPage();

        /*  Check the condition config setting for login
            as customer is on or off if it's 0 then it's off hide the column
        */

            $hidden = $this->authorization->isAllowed('KiwiCommerce_LoginAsCustomer::CustomerGrid');
        if ($loginAsCustomerEnabled != "1" || $isGridViewEnabled != "1" || $hidden != "1") {
            if ($key == 'config') {
                $data = parent::_getData($key);
                $data['componentDisabled'] = true;
                return $data;
            }
        }
        return parent::_getData($key);
    }
}
