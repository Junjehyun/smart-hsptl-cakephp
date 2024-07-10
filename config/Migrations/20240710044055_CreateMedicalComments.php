<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateMedicalComments extends AbstractMigration
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
        $table = $this->table('medical_comments');
        $table->addColumn('customer_no', 'string', ['limit' => 32])
        ->addColumn('department_code', 'string', ['limit' => 8, 'null' => true])
        ->addColumn('employ_id', 'string', ['limit' => 32, 'null' => true])
        ->addColumn('comments', 'text', ['null' => true])
        ->addColumn('create_date', 'datetime')
        ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
        ->addColumn('deleted_at', 'timestamp', ['null' => true])
        ->create();
    }
}
