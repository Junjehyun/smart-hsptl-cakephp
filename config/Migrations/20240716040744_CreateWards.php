<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateWards extends AbstractMigration
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
        $table = $this->table('wards');
        $table->addColumn('ward_type', 'string', ['limit' => 2, 'default' => '01', 'null' => false])
            ->addColumn('ward_code', 'string', ['limit' => 10, 'null' => false])
            ->addColumn('ward_name', 'string', ['limit' => 100, 'null' => false])
            ->addColumn('ward_description', 'text', ['null' => true])
            ->addColumn('coordinator_code', 'string', ['limit' => 5, 'null' => true])
            ->addColumn('bgcolor', 'string', ['limit' => 7, 'null' => true])
            ->addColumn('image_name', 'string', ['limit' => 200, 'null' => true])
            ->addColumn('remarks', 'string', ['limit' => 200, 'null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
            ->create();
    }
}
