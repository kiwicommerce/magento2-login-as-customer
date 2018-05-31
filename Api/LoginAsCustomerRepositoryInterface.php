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

namespace KiwiCommerce\LoginAsCustomer\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface LoginAsCustomerRepositoryInterface
{
    /**
     * @param Data\LoginAsCustomerInterface $loginAsCustomerId
     * @return mixed
     */
    public function save(
        \KiwiCommerce\LoginAsCustomer\Api\Data\LoginAsCustomerInterface $loginAsCustomerId
    );

    /**
     * @param $loginAsCustomerId
     * @return mixed
     */
    public function getById($loginAsCustomerId);

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return mixed
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * @param Data\LoginAsCustomerInterface $loginAsCustomerId
     * @return mixed
     */
    public function delete(
        \KiwiCommerce\LoginAsCustomer\Api\Data\LoginAsCustomerInterface $loginAsCustomerId
    );

    /**
     * @param $loginAsCustomerId
     * @return mixed
     */
    public function deleteById($loginAsCustomerId);
}
