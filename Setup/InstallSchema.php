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

namespace KiwiCommerce\LoginAsCustomer\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_kiwicommerce_login_as_customer = $setup->getConnection()->newTable(
            $setup->getTable(
                'kiwicommerce_login_as_customer'
            )
        );

        $table_kiwicommerce_login_as_customer->addColumn(
            'entity_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            ['identity' => true,'nullable' => false,'primary' => true,'unsigned' => true,],
            'Entity ID'
        );

        $table_kiwicommerce_login_as_customer->addColumn(
            'customer_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'customer_id'
        );

        $table_kiwicommerce_login_as_customer->addColumn(
            'customer_email',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'customer_email'
        );

        $table_kiwicommerce_login_as_customer->addColumn(
            'admin_username',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'admin_username'
        );

        $table_kiwicommerce_login_as_customer->addColumn(
            'admin_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'admin_id'
        );

        $table_kiwicommerce_login_as_customer->addColumn(
            'admin_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'admin_name'
        );

        $table_kiwicommerce_login_as_customer->addColumn(
            'login_from',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            [],
            'login_from'
        );

        $table_kiwicommerce_login_as_customer->addColumn(
            'secret',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'secret'
        );

        $table_kiwicommerce_login_as_customer->addColumn(
            'used',
            \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
            null,
            ['default' => '0'],
            'used'
        );

        $table_kiwicommerce_login_as_customer->addColumn(
            'ip',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            [],
            'ip'
        );

        $table_kiwicommerce_login_as_customer->addColumn(
            'logged_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [],
            'logged_at'
        );

        $table_kiwicommerce_login_as_customer->addColumn(
            'updated_at',
            \Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
            null,
            [],
            'updated_at'
        );

        $setup->getConnection()->createTable($table_kiwicommerce_login_as_customer);

        $setup->endSetup();
    }
}
