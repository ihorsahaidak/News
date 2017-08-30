<?php

namespace Thesagaydak\News\Setup;

//TODO change upgrade shema to install schema and make all requirements
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();
        if (!$installer->tableExists('thesagaydak_news_post')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('thesagaydak_news_post')
            )
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'ID'
                )
                ->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Title'
                )
                ->addColumn(
                    'url_key',
                    Table::TYPE_TEXT,
                    255,
                    [],
                    'Post URL Key'
                )
                ->addColumn(
                    'content',
                    Table::TYPE_TEXT,
                    '64k',
                    [],
                    'Content'
                )
                ->addColumn(
                    'tags',
                    Table::TYPE_TEXT,
                    255,
                    [],
                    'Tags'
                )
                ->addColumn(
                    'status',
                    Table::TYPE_INTEGER,
                    1,
                    [],
                    'Status'
                )
                ->addColumn(
                    'featured_image',
                    Table::TYPE_TEXT,
                    255,
                    [],
                    'Post Featured Image'
                )
                ->addColumn(
                    'sample_upload_file',
                    Table::TYPE_TEXT,
                    255,
                    [],
                    'Post Sample File'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Post Created At'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Post Updated At'
                )
                ->setComment('Post Table');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('thesagaydak_news_post'),
                $setup->getIdxName(
                    $installer->getTable('thesagaydak_news_post'),
                    ['title','url_key','content','tags','featured_image','sample_upload_file'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['title','url_key','content','tags','featured_image','sample_upload_file'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }

        /**
         * Tag table
         */
        if (!$installer->tableExists('thesagaydak_news_tag')) {
            $table = $installer->getConnection()->newTable(
                $installer->getTable('thesagaydak_news_tag')
            )
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    null,
                    [
                        'identity' => true,
                        'nullable' => false,
                        'primary'  => true,
                        'unsigned' => true,
                    ],
                    'ID'
                )
                ->addColumn(
                    'title',
                    Table::TYPE_TEXT,
                    255,
                    ['nullable => false'],
                    'Title'
                )
                ->addColumn(
                    'url',
                    Table::TYPE_TEXT,
                    255,
                    [],
                    'URL'
                )
                ->addColumn(
                    'created_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Post Created At'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [],
                    'Post Updated At'
                )
                ->setComment('Tag Table');
            $installer->getConnection()->createTable($table);

            $installer->getConnection()->addIndex(
                $installer->getTable('thesagaydak_news_tag'),
                $setup->getIdxName(
                    $installer->getTable('thesagaydak_news_tag'),
                    ['title','url'],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                ['title','url'],
                AdapterInterface::INDEX_TYPE_FULLTEXT
            );
        }

        $installer->endSetup();
    }
}