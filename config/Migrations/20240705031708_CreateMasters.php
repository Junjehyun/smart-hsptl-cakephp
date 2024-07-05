<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateMasters extends AbstractMigration
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
        $table = $this->table('masters');
        $table->addColumn('master_key', 'string', ['limit' => 3])
        ->addColumn('master_name', 'string', ['limit' => 128])
        ->addColumn('item_code', 'string', ['limit' => 5])
        ->addColumn('item_name', 'string', ['limit' => 128])
        ->addColumn('item_nm_short', 'string', ['limit' => 64, 'null' => true])
        ->addColumn('item_nm_eng', 'string', ['limit' => 128, 'null' => true])
        ->addColumn('sort_order', 'integer', ['null' => true])
        ->addColumn('use_flag', 'boolean', ['default' => true])
        ->addColumn('remarks', 'text', ['null' => true])
        ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
        ->create();
    }
}
