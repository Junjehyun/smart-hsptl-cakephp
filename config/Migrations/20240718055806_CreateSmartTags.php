<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateSmartTags extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change(): void
    {
        $table = $this->table('smart_tags');
        $table->addColumn('tag_id', 'string', ['limit' => 16, 'null' => false])
            ->addColumn('mac_address', 'string', ['limit' => 32, 'null' => true])
            ->addColumn('tag_location', 'string', ['limit' => 32, 'null' => true])
            ->addColumn('tag_location_nm', 'string', ['limit' => 128, 'null' => true])
            ->addColumn('tag_type', 'string', ['limit' => 2, 'null' => true])
            ->addColumn('gateway_ip', 'string', ['limit' => 32, 'null' => true])
            ->addColumn('job_type', 'string', ['limit' => 16, 'null' => true])
            ->addColumn('job_result', 'string', ['limit' => 16, 'null' => true])
            ->addColumn('battery_charge_rate', 'string', ['limit' => 8, 'null' => true])
            ->addColumn('temperature', 'string', ['limit' => 8, 'null' => true])
            ->addColumn('receive_power', 'string', ['limit' => 8, 'null' => true])
            ->addColumn('version', 'string', ['limit' => 8, 'null' => true])
            ->addColumn('use_flag', 'boolean', ['default' => false, 'null' => false])
            ->addColumn('old_tag_location', 'string', ['limit' => 32, 'null' => true])
            ->addColumn('old_tag_location_nm', 'string', ['limit' => 128, 'null' => true])
            ->addColumn('latest_update', 'datetime', ['null' => true])
            ->addColumn('creator_id', 'integer', ['null' => true])
            ->addColumn('updater_id', 'integer', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
            ->addColumn('deleted_at', 'timestamp', ['null' => true])
            ->addIndex(['tag_id'], ['unique' => true])
            ->addIndex(['mac_address'], ['unique' => true])
            ->create();
    }
}
