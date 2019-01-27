<?php

use yii\db\Migration;

/**
 * Class m190127_150155_create_table_url
 */
class m190127_150155_create_table_url extends Migration
{
    private $_tableName = 'url';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->_tableName, [
            'short_url'     => $this->string(6)->notNull(),
            'full_url'      => $this->text()->notNull(),
            'full_url_hash' => $this->string(32)->notNull(),
            'date_created'  => $this->dateTime()->defaultExpression('NOW()'),
            'date_updated'  => $this->dateTime()->defaultExpression('NOW()'),
        ]);

        $this->addPrimaryKey('pk_short_url', $this->_tableName, 'short_url');
        $this->createIndex('idx_short_url', $this->_tableName, 'short_url', true);
        $this->createIndex('idx_date_updated', $this->_tableName, 'date_updated');
        $this->createIndex('idx_full_url_hash', $this->_tableName, 'full_url_hash', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->_tableName);
    }
}
