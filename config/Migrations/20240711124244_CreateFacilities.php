<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateFacilities extends AbstractMigration
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
        $table = $this->table('facilities');
        $table->addColumn('name', 'string', ['limit' => 50, 'null' => true])
        ->addColumn('owner_name', 'string', ['limit' => 50, 'null' => true])
        ->addColumn('description', 'text', ['null' => true])
        ->addColumn('logo_image_name', 'string', ['limit' => 200, 'null' => true])
        ->addColumn('logo_short_image_name', 'string', ['limit' => 200, 'null' => true])
        ->addColumn('background_image_name', 'string', ['limit' => 200, 'null' => true])
        ->addColumn('banner_display_flag', 'boolean', ['default' => true])
        ->addColumn('layout_no', 'string', ['limit' => 2, 'null' => true])
        ->addColumn('room_layout_no', 'string', ['limit' => 2, 'null' => true])
        ->addColumn('bed_layout_no', 'string', ['limit' => 2, 'null' => true])
        ->addColumn('status', 'string', ['limit' => 2, 'default' => '00'])
        ->addColumn('license_count', 'biginteger', ['default' => 100])
        ->addColumn('lang_type', 'string', ['limit' => 2, 'default' => '01'])
        ->addColumn('creator_id', 'biginteger', ['null' => true])
        ->addColumn('updater_id', 'biginteger', ['null' => true])
        ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
        ->addColumn('deleted_at', 'timestamp', ['null' => true])
        ->create();
    }
}
