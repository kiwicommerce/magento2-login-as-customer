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

namespace KiwiCommerce\LoginAsCustomer\Model;

use KiwiCommerce\LoginAsCustomer\Api\Data\LoginAsCustomerInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class LoginAsCustomer extends \Magento\Framework\Model\AbstractModel implements LoginAsCustomerInterface
{

    const TIME_FRAME = 30;
    /**
     * @var string
     */
    protected $eventPrefix = 'kiwicommerce_loginascustomer';
    /**
     * @var string
     */
    protected $eventObject = 'loginascustomer_login';
    /**
     * @var \Magento\Customer\Model\CustomerFactory
     */
    protected $customerFactory;
    /**
     * @var \Magento\Customer\Model\Session
     */
    protected $customerSession;
    /**
     * @var $customer
     */
    protected $customer;
    /**
     * @var \Magento\Framework\Stdlib\DateTime\DateTime
     */
    protected $dateTime;
    /**
     * @var \Magento\Framework\Math\Random
     */
    protected $random;
    /**
     * @var \Magento\Checkout\Model\Cart
     */
    protected $cart;
    /**
     * @var \Magento\Framework\Stdlib\DateTime
     */
    private $dt;

    /**
     * LoginAsCustomer constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Customer\Model\CustomerFactory $customerFactory
     * @param \Magento\Customer\Model\Session $customerSession
     * @param \Magento\Framework\Stdlib\DateTime $dt
     * @param \Magento\Framework\Stdlib\DateTime\DateTime $dateTime
     * @param \Magento\Framework\Math\Random $random
     * @param \Magento\Checkout\Model\Cart $cart
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     */

    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Customer\Model\Session $customerSession,
        \Magento\Framework\Stdlib\DateTime $dt,
        \Magento\Framework\Stdlib\DateTime\DateTime $dateTime,
        \Magento\Framework\Math\Random $random,
        \Magento\Checkout\Model\Cart $cart,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->customerFactory = $customerFactory;
        $this->customerSession = $customerSession;
        $this->dateTime = $dateTime;
        $this->random = $random;
        $this->cart = $cart;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
        $this->dt = $dt;
    }
    protected function _construct()
    {
        $this->_init('KiwiCommerce\LoginAsCustomer\Model\ResourceModel\LoginAsCustomer');
    }
    /**
     * Get entity_id
     * @return string
     */
    public function getLoginAsCustomerId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * @param $loginAsCustomerId
     * @return $this
     */
    public function setLoginAsCustomerId($loginAsCustomerId)
    {
        return $this->setData(self::ENTITY_ID, $loginAsCustomerId);
    }

    /**
     * Get customer_id
     * @return string
     */
    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER_ID);
    }

    /**
     * @param $customerId
     * @return $this
     */
    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER_ID, $customerId);
    }

    /**
     * Get customer_email
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->getData(self::CUSTOMER_EMAIL);
    }

    /**
     * @param $customerEmail
     * @return $this
     */
    public function setCustomerEmail($customerEmail)
    {
        return $this->setData(self::CUSTOMER_EMAIL, $customerEmail);
    }

    /**
     * Get admin_username
     * @return string
     */
    public function getAdminUsername()
    {
        return $this->getData(self::ADMIN_USERNAME);
    }

    /**
     * @param $adminUsername
     * @return $this
     */
    public function setAdminUsername($adminUsername)
    {
        return $this->setData(self::ADMIN_USERNAME, $adminUsername);
    }

    /**
     * @return mixed
     */
    public function getAdminId()
    {
        return $this->getData(self::ADMIN_ID);
    }

    /**
     * @param $adminId
     * @return $this
     */
    public function setAdminId($adminId)
    {
        return $this->setData(self::ADMIN_ID, $adminId);
    }

    /**
     * Get admin_name
     * @return string
     */
    public function getAdminName()
    {
        return $this->getData(self::ADMIN_NAME);
    }

    /**
     * @param $adminName
     * @return $this
     */
    public function setAdminName($adminName)
    {
        return $this->setData(self::ADMIN_NAME, $adminName);
    }

    /**
     * Get login_from
     * @return string
     */
    public function getLoginFrom()
    {
        return $this->getData(self::LOGIN_FROM);
    }

    /**
     * @param string $loginFrom
     * @return $this
     */
    public function setLoginFrom($loginFrom)
    {
        return $this->setData(self::LOGIN_FROM, $loginFrom);
    }

    /**
     * Get secret
     * @return string
     */
    public function getSecret()
    {
        return $this->getData(self::SECRET);
    }

    /**
     * @param string $secret
     * @return $this
     */
    public function setSecret($secret)
    {
        return $this->setData(self::SECRET, $secret);
    }

    /**
     * Get used
     * @return string
     */
    public function getUsed()
    {
        return $this->getData(self::USED);
    }

    /**
     * @param string $used
     * @return $this
     */
    public function setUsed($used)
    {
        return $this->setData(self::USED, $used);
    }

    /**
     * Get ip
     * @return string
     */
    public function getIp()
    {
        return $this->getData(self::IP);
    }

    /**
     * @param string $ip
     * @return $this
     */
    public function setIp($ip)
    {
        return $this->setData(self::IP, $ip);
    }

    /**
     * Get logged_at
     * @return string
     */
    public function getLoggedAt()
    {
        return $this->getData(self::LOGGED_AT);
    }

    /**
     * @param string $loggedAt
     * @return $this
     */
    public function setLoggedAt($loggedAt)
    {
        return $this->setData(self::LOGGED_AT, $loggedAt);
    }

    /**
     * Get updated_at
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * @param string $updatedAt
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(self::UPDATED_AT, $updatedAt);
    }

    /**
     * @param $secret
     * @return \Magento\Framework\DataObject
     */
    public function loadNotUsed($secret)
    {
        return $this->getCollection()
            ->addFieldToFilter('secret', $secret)
            ->addFieldToFilter('used', 0)
            ->addFieldToFilter('logged_at', ['gt' => $this->getDateTimePoint()])
            ->setPageSize(1)
            ->getFirstItem();
    }
    /**
     * Delete not used credentials
     * @return void
     */
    public function deleteNotUsed()
    {
        $resource = $this->getResource();
        $resource->getConnection()->delete(
            $resource->getTable('kiwicommerce_login_as_customer'),
            [
                'logged_at < ?' => $this->getDateTimePoint(),
                'used = ?' => 0,
            ]
        );
    }
    /**
     * Retrieve login datetime point
     * @return [type] [description]
     */
    protected function getDateTimePoint()
    {
        // return the difference between current time and -5 second and return the compare time
        $diff = $this->dateTime->gmtTimestamp() - self::TIME_FRAME;
        $date = $this->dt->formatDate($diff);
        return $date;
    }
    /**
     * Retrieve customer
     * @return \Magento\Customer\Model\Customer
     */
    public function getCustomer()
    {
        if ($this->customer === null) {
            $this->customer = $this->customerFactory->create()
                ->load($this->getCustomerId());
        }
        return $this->customer;
    }

    /**
     * @return \Magento\Customer\Model\Customer
     * @throws NoSuchEntityException
     */
    public function authenticateCustomer()
    {
        if ($this->customerSession->getId()) {
            /* Logout if logged in */
            $this->customerSession->logout();
        } else {
            /* Remove items from guest cart */
            foreach ($this->cart->getQuote()->getAllVisibleItems() as $item) {
                $this->cart->removeItem($item->getId());
            }
            $this->cart->save();
        }

        $customer = $this->getCustomer();
        if (!$customer->getId()) {
            throw new NoSuchEntityException(__("Customer are no longer exist."), 1);
        }
        if ($this->customerSession->loginById($customer->getId())) {
            $this->customerSession->regenerateId();
            $this->customerSession->setLoggedAsCustomerAdmindId(
                $this->getAdminId()
            );
        }

        /* Save quote */

        $this->cart->getQuote()->getBillingAddress();
        $this->cart->getQuote()->getShippingAddress();
        $this->cart->getQuote()->setCustomer($this->customerSession->getCustomerDataObject())
            ->setCustomerGroupId($customer->getGroupId())
            ->setTotalsCollectedFlag(false)
            ->collectTotals();
        $this->cart->getQuote()->save();
        $cur_time = $this->dateTime->gmtTimestamp();
        $this->setUpdated_at($cur_time)->save();
        $this->setUsed(1)->save();
        return $customer;
    }
    /**
     * Generate new login credentials
     * @param  int $adminId
     * @return $this
     */
    public function generate($adminId, $adminName, $adminUsername, $loginFrom, $customerEmail, $ip)
    {
        return $this->setData([
            'customer_id' => $this->getCustomerId(),
            'admin_id' => $adminId,
            'customer_email' => $customerEmail,
            'admin_username' => $adminUsername,
            'admin_name' => $adminName,
            'login_from' => $loginFrom,
            'ip' => $ip,
            'updated_at' => $this->dateTime->gmtTimestamp(),
            'secret' => $this->random->getRandomString(64),
            'used' => 0,
            'logged_at' => $this->dateTime->gmtTimestamp(),
        ])->save();
    }
}
