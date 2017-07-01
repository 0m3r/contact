<?php
/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 * @copyright 2017 
 * @license   Open Software License ("OSL") v. 3.0
 */
namespace Omer\Contact\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 *
 * @category  Omer
 * @package   Omer\Contact
 * @author    Alexander Kras'ko <0m3r.mail@gmail.com>
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $tableName = 'omer_contact';
        $installer->startSetup();
        $table = $installer->getConnection()
            ->newTable($installer->getTable($tableName))
            ->addColumn('id', Table::TYPE_INTEGER, 11, [
                'identity'  => true,
                'unsigned'  => true,
                'nullable'  => false,
                'primary'   => true,
            ], 'Id')
            ->addColumn('name', Table::TYPE_TEXT, null, [
                'nullable'  => false,
            ], 'Name')
            ->addColumn('email', Table::TYPE_TEXT, 128, [
                'nullable'  => false,                
            ], 'Email')
            ->addColumn('telephone', Table::TYPE_TEXT, 16, [
                'nullable'  => false,
                'default'  => '',
            ], 'Email')
            ->addColumn('comment', Table::TYPE_TEXT, null, [
                'nullable'  => false,
            ], 'Text')          
            ->addColumn('customer_id', Table::TYPE_INTEGER, 10, [
                'unsigned'  => true,
                'nullable'  => true,
                'default'  => null,
            ], 'Customer Id')
            ->addColumn('status', Table::TYPE_SMALLINT, 1, [
                'nullable'  => false,
                'default'  => 1, //@todo get right default status 
            ], 'Status')
            ->addColumn('store_id', Table::TYPE_SMALLINT, 5, [
                'unsigned'  => true,
                'nullable'  => false,
            ], 'Store Id')            
            ->addColumn('created', Table::TYPE_DATETIME, null, [
                'nullable'  => true,
                'default'  => null,
            ], 'Created Time')
            ->addColumn('update', Table::TYPE_DATETIME, null, [
                'nullable'  => true,
                'default'  => null,
            ], 'Update Time')
            ->addIndex(
                $installer->getIdxName($tableName, ['customer_id']),
                ['customer_id']
            )
            ->addIndex(
                $installer->getIdxName($tableName, ['store_id']),
                ['store_id']
            )
            ->addForeignKey(
                $installer->getFkName($tableName, 'customer_id', 'customer_entity', 'entity_id'),
                'customer_id',
                $installer->getTable('customer_entity'),
                'entity_id',
                Table::ACTION_SET_NULL
            )
            ->addForeignKey(
                $installer->getFkName($tableName, 'store_id', 'store', 'store_id'),
                'store_id',
                $installer->getTable('store'),
                'store_id',
                Table::ACTION_CASCADE
            )
            ->addIndex(
                $setup->getIdxName(
                    $installer->getTable($tableName),
                    ['text'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['text'],
                ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
            );
        $installer->getConnection()->createTable($table);
        $setup->endSetup();
    }
}
