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

namespace KiwiCommerce\LoginAsCustomer\Model;

use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use KiwiCommerce\LoginAsCustomer\Api\LoginAsCustomerRepositoryInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use KiwiCommerce\LoginAsCustomer\Model\ResourceModel\LoginAsCustomer as ResourceLoginAsCustomer;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Api\SortOrder;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\DataObjectHelper;
use KiwiCommerce\LoginAsCustomer\Api\Data\LoginAsCustomerInterfaceFactory;
use KiwiCommerce\LoginAsCustomer\Model\ResourceModel\LoginAsCustomer\CollectionFactory as LoginAsCustomerCollectionFactory;
use KiwiCommerce\LoginAsCustomer\Api\Data\LoginAsCustomerSearchResultsInterfaceFactory;

class LoginAsCustomerRepository implements LoginAsCustomerRepositoryInterface
{
    /**
     * @var DataObjectProcessor
     */
    protected $dataObjectProcessor;
    /**
     * @var DataObjectHelper
     */
    protected $dataObjectHelper;
    /**
     * @var LoginAsCustomerCollectionFactory
     */
    protected $loginAsCustomerCollectionFactory;
    /**
     * @var LoginAsCustomerInterfaceFactory
     */
    protected $dataLoginAsCustomerFactory;
    /**
     * @var LoginAsCustomerSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;
    /**
     * @var loginAsCustomerFactory
     */
    protected $loginAsCustomerFactory;
    /**
     * @var ResourceLoginAsCustomer
     */
    protected $resource;
    /**
     * @var StoreManagerInterface
     */
    private $storeManager;

    /**
     * LoginAsCustomerRepository constructor.
     * @param ResourceLoginAsCustomer $resource
     * @param loginAsCustomerFactory $loginAsCustomerFactory
     * @param LoginAsCustomerInterfaceFactory $dataLoginAsCustomerFactory
     * @param LoginAsCustomerCollectionFactory $loginAsCustomerCollectionFactory
     * @param LoginAsCustomerSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceLoginAsCustomer $resource,
        loginAsCustomerFactory $loginAsCustomerFactory,
        LoginAsCustomerInterfaceFactory $dataLoginAsCustomerFactory,
        LoginAsCustomerCollectionFactory $loginAsCustomerCollectionFactory,
        LoginAsCustomerSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->loginAsCustomerFactory = $loginAsCustomerFactory;
        $this->loginAsCustomerCollectionFactory = $loginAsCustomerCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataLoginAsCustomerFactory = $dataLoginAsCustomerFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }
    /**
     * {@inheritdoc}
     */
    public function save(
        \KiwiCommerce\LoginAsCustomer\Api\Data\LoginAsCustomerInterface $loginAsCustomer
    ) {
        try {
            $loginAsCustomer->getResource()->save($loginAsCustomer);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the loginAsCustomer: %1',
                $exception->getMessage()
            ));
        }
        return $loginAsCustomer;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($loginAsCustomerId)
    {
        $loginAsCustomer = $this->loginAsCustomerFactory->create();
        $loginAsCustomer->getResource()->load($loginAsCustomer, $loginAsCustomerId);
        if (!$loginAsCustomer->getId()) {
            throw new NoSuchEntityException(__('loginAsCustomer with id "%1" does not exist.', $loginAsCustomerId));
        }
        return $loginAsCustomer;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->LoginAsCustomerCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }

        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \KiwiCommerce\LoginAsCustomer\Api\Data\LoginAsCustomerInterface $loginAsCustomer
    ) {
        try {
            $loginAsCustomer->getResource()->delete($loginAsCustomer);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the loginAsCustomer: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }
    /**
     * {@inheritdoc}
     */
    public function deleteById($loginAsCustomerId)
    {
        return $this->delete($this->getById($loginAsCustomerId));
    }
}
