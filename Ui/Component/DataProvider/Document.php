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

namespace KiwiCommerce\LoginAsCustomer\Ui\Component\DataProvider;

use Magento\Framework\Api\AttributeValueFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use KiwiCommerce\LoginAsCustomer\Helper\Data;

/**
 * Class Document
 */
class Document extends \Magento\Framework\View\Element\UiComponent\DataProvider\Document
{
    /**
     * @var string
     */
    private static $loginFromAttributeCode = 'login_from';

    /**
     * @var Data
     */
    private $helper;

    /**
     * Document constructor.
     * @param AttributeValueFactory $attributeValueFactory
     */
    public function __construct(
        AttributeValueFactory $attributeValueFactory,
        Data $data
    ) {
        parent::__construct($attributeValueFactory);
        $this->helper = $data;
    }

    /**
     * @inheritdoc
     */
    public function getCustomAttribute($attributeCode)
    {
        switch ($attributeCode) {
            case self::$loginFromAttributeCode:
                $this->setLoginFromValue();
                break;
        }
        return parent::getCustomAttribute($attributeCode);
    }
    /**
     * Update login from value
     * Method set from where login text value to match what is shown in grid
     * @return void
     */
    private function setLoginFromValue()
    {
        $value = $this->getData(self::$loginFromAttributeCode);

        if (!$value) {
            $this->setCustomAttribute(self::$loginFromAttributeCode, '');
            return;
        }

        try {
            $valueText = $this->helper->loginOptionsForListing()[$value];
            $this->setCustomAttribute(self::$loginFromAttributeCode, $valueText);
        } catch (NoSuchEntityException $e) {
            $this->setCustomAttribute(self::$loginFromAttributeCode, '');
        }
    }
}
