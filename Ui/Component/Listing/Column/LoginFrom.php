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

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use KiwiCommerce\LoginAsCustomer\Helper\Data;

/**
 * Class CustomerActions
 */
class LoginFrom extends Column
{
    /**
     * @var Data
     */
    protected $helper;

    /**
     * LoginFrom constructor.
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param Data $helper
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        Data $helper,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->helper = $helper;
    }

    /**
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        /* This section for create login text using foreach loop*/
        if (isset($dataSource['data']['items'])) {
            $i = 0;
            /*Get all login from options array from helper class*/
            $loginFromData = $this->helper->loginOptionsForListing();
            foreach ($dataSource['data']['items'] as &$item) {
                $currentIndex = $item['login_from'];
                $item['login_from'] = $loginFromData[$currentIndex];
            }
        }
        return $dataSource;
    }
    /**
     * @param string $key
     * @return mixed
     */
    protected function _getData($key)
    {
        if ($key == 'config') {
                $data = parent::_getData($key);
                $data['componentDisabled'] = false;
                return $data;
        }
        return parent::_getData($key);
    }
}
