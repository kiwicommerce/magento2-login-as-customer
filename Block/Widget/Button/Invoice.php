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

namespace KiwiCommerce\LoginAsCustomer\Block\Widget\Button;

use Magento\Backend\Block\Widget\Button\Toolbar;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Backend\Block\Widget\Button\ButtonList;
use Magento\Sales\Block\Adminhtml\Order\Invoice\View;

class Invoice extends ToolbarPlugin
{

    /**
     * @param Toolbar $toolbar
     * @param AbstractBlock $context
     * @param ButtonList $buttonList
     * @return array
     */
    public function beforePushButtons(
        Toolbar $toolbar,
        AbstractBlock $context,
        ButtonList $buttonList
    ) {
        if ($context instanceof View) {
            $this->addLoginAsCustomerViaOrder($context->getInvoice()->getOrder(), $buttonList,
                'KiwiCommerce_LoginAsCustomer::InvoiceView', 5);
        }

        return [$context, $buttonList];
    }
}
