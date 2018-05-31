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

namespace KiwiCommerce\LoginAsCustomer\Test\Unit\Model;

class InformationTest extends \PHPUnit\Framework\TestCase
{
    const ORIG_CUSTOMER_ID = 15;
    const ORIG_PARENT_ID = 15;

    /**
     * @var \Magento\Framework\TestFramework\Unit\Helper\ObjectManager
     */
    protected $objectManager;

    /**
     * @var \Magento\Customer\Model\Address
     */
    protected $address;

    /**
     * @var \Magento\Customer\Model\Address
     */

    /**
     * @var \KiwiCommerce\LoginAsCustomer\Model\LoginAsCustomer
     */
    protected $loginCustomer;

    /**
     * @var \Magento\Customer\Model\Customer | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $customer;

    /**
     * @var \Magento\Customer\Model\CustomerFactory | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $customerFactory;

    /**
     * @var \Magento\Customer\Model\ResourceModel\Address | \PHPUnit_Framework_MockObject_MockObject
     */
    protected $resource;

    protected function setUp()
    {
        $this->objectManager = new \Magento\Framework\TestFramework\Unit\Helper\ObjectManager($this);

        $this->customer = $this->getMockBuilder(\Magento\Customer\Model\Customer::class)
            ->disableOriginalConstructor()
            ->getMock();
        $this->customer->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(self::ORIG_CUSTOMER_ID));
        $this->customer->expects($this->any())
            ->method('load')
            ->will($this->returnSelf());

        $this->customerFactory = $this->getMockBuilder(\Magento\Customer\Model\CustomerFactory::class)
            ->disableOriginalConstructor()
            ->setMethods(['create'])
            ->getMock();
        $this->customerFactory->expects($this->any())
            ->method('create')
            ->will($this->returnValue($this->customer));

        $this->resource = $this->getMockBuilder(\Magento\Customer\Model\ResourceModel\Address::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->logincustomer = $this->objectManager->getObject(
            \KiwiCommerce\LoginAsCustomer\Model\LoginAsCustomer::class,
            [
                'customerFactory' => $this->customerFactory,
                'resource' => $this->resource,
            ]
        );
        $this->address = $this->objectManager->getObject(
            \Magento\Customer\Model\Address::class,
            [
                'customerFactory' => $this->customerFactory,
                'resource' => $this->resource,
            ]
        );
    }

    /**
     * function to test customer check customer id return result
     */
    public function testCustomer()
    {
        $this->address->unsetData('cusomer_id');
        $this->assertFalse($this->address->getCustomer());

        $this->address->setCustomerId(15);

        $customer = $this->address->getCustomer();
        $this->assertEquals(15, $customer->getId());

        /** @var \Magento\Customer\Model\Customer $customer */
        $customer = $this->getMockBuilder(\Magento\Customer\Model\Customer::class)
            ->disableOriginalConstructor()
            ->getMock();
        $customer->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(self::ORIG_CUSTOMER_ID + 1));

        $this->address->setCustomer($customer);
        $this->assertEquals(self::ORIG_CUSTOMER_ID + 1, $this->address->getCustomerId());
    }

    /**
     * function to test customer check Secret key value return result
     */

    public function testSecretkey()
    {
        $secret="Khey675kjuio789798";
        $this->loginCustomer->setSecret("Khey675kjuio789798");
        $getsecrect=$this->loginCustomer->getSecret();
        $this->assertEquals($getsecrect, $secret);
    }
}
