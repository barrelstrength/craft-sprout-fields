<?php

namespace barrelstrength\sproutfields\migrations;

use barrelstrength\sproutbasefields\migrations\m200109_000000_update_address_tables;
use craft\db\Migration;
use yii\base\NotSupportedException;

/**
 * m200109_000000_update_address_tables_sproutfields migration.
 */
class m200109_000000_update_address_tables_sproutfields extends Migration
{
    /**
     * @return bool
     */
    public function safeUp(): bool
    {
        $migration = new m200109_000000_update_address_tables();

        ob_start();
        $migration->safeUp();
        ob_end_clean();

        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown(): bool
    {
        echo "m200109_000000_update_address_tables_sproutfields cannot be reverted.\n";
        return false;
    }
}
