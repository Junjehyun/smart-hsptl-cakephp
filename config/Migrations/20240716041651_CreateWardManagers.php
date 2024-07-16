<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateWardManagers extends AbstractMigration
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
        $table = $this->table('ward_managers');
        $table->addColumn('user_id', 'biginteger', ['null' => false])
                ->addColumn('ward_code', 'string', ['limit' => 10, 'null' => false])
                ->addColumn('creator_id', 'biginteger', ['null' => false])
                ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
                ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'null' => false])
                ->create();
    }
}
