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

namespace KiwiCommerce\LoginAsCustomer\Block\Adminhtml\Order;

use KiwiCommerce\LoginAsCustomer\Block\Widget\Button\ToolbarPlugin;
use Magento\Backend\Block\Widget\Context;
use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\AuthorizationInterface;
use Magento\Framework\Registry;
use Magento\Sales\Helper\Reorder;
use Magento\Sales\Model\Config;

class View extends \Magento\Sales\Block\Adminhtml\Order\View
{
    /**
     * @var ToolbarPlugin
     */
    private $toolbarPlugin;

    /**
     * View constructor.
     * @param Context $context
     * @param Registry $registry
     * @param Config $salesConfig
     * @param Reorder $reorderHelper
     * @param ToolbarPlugin $toolbarPlugin
     * @param array $data
     */
    public function __construct(
        Context $context,
        Registry $registry,
        Config $salesConfig,
        Reorder $reorderHelper,
        ToolbarPlugin $toolbarPlugin,
        array $data = []
    ) {
        $this->toolbarPlugin = $toolbarPlugin;
        parent::__construct($context, $registry, $salesConfig, $reorderHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();

        /*Check order is exist or not */
        $order = $this->getOrder();
        if (! $order) {
            return;
        }
        $this->toolbarPlugin->addLoginAsCustomerViaOrder($order, $this->buttonList, 'KiwiCommerce_LoginAsCustomer::OrderView', 3);
    }
}
