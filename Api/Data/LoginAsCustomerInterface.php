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

namespace KiwiCommerce\LoginAsCustomer\Api\Data;

interface LoginAsCustomerInterface
{

    const CUSTOMER_ID = 'customer_id';
    const ENTITY_ID = 'entity_id';
    const LOGGED_AT = 'logged_at';
    const ADMIN_NAME = 'admin_name';
    const IP = 'ip';
    const USED = 'used';
    const CUSTOMER_EMAIL = 'customer_email';
    const SECRET = 'secret';
    const ADMIN_USERNAME = 'admin_username';
    const LOGIN_FROM = 'login_from';
    const ADMIN_ID = 'admin_id';
    const UPDATED_AT = 'updated_at';
    /**
     * Get ENTITY_ID
     * @return string|null
     */
    public function getLoginAsCustomerId();

    /**
     * @param $loginAsCustomerId
     * @return mixed
     */
    public function setLoginAsCustomerId($loginAsCustomerId);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * @param $customerId
     * @return mixed
     */
    public function setCustomerId($customerId);

    /**
     * Get customer_email
     * @return string|null
     */
    public function getCustomerEmail();

    /**
     * @param $customerEmail
     * @return mixed
     */
    public function setCustomerEmail($customerEmail);

    /**
     * Get admin_username
     * @return string|null
     */
    public function getAdminUsername();

    /**
     * @param $adminUsername
     * @return mixed
     */
    public function setAdminUsername($adminUsername);

    /**
     * Get admin_id
     * @return string|null
     */
    public function getAdminId();

    /**
     * @param $adminId
     * @return mixed
     */
    public function setAdminId($adminId);

    /**
     * Get admin_name
     * @return string|null
     */
    public function getAdminName();

    /**
     * @param $adminName
     * @return mixed
     */
    public function setAdminName($adminName);

    /**
     * Get login_from
     * @return string|null
     */
    public function getLoginFrom();

    /**
     * @param $loginFrom
     * @return mixed
     */
    public function setLoginFrom($loginFrom);

    /**
     * Get secret
     * @return string|null
     */
    public function getSecret();

    /**
     * @param $secret
     * @return mixed
     */
    public function setSecret($secret);

    /**
     * Get used
     * @return string|null
     */
    public function getUsed();

    /**
     * @param $used
     * @return mixed
     */
    public function setUsed($used);

    /**
     * Get ip
     * @return string|null
     */
    public function getIp();

    /**
     * @param $ip
     * @return mixed
     */
    public function setIp($ip);

    /**
     * Get logged_at
     * @return string|null
     */
    public function getLoggedAt();

    /**
     * @param $loggedAt
     * @return mixed
     */
    public function setLoggedAt($loggedAt);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * @param $updatedAt
     * @return mixed
     */
    public function setUpdatedAt($updatedAt);
}
