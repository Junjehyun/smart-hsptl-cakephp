<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateMedicalInfos extends AbstractMigration
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
        $table = $this->table('medical_infos');
        $table
            ->addColumn('customer_no', 'string', ['limit' => 32])
            ->addColumn('department', 'string', ['limit' => 32, 'null' => true])
            ->addColumn('doctor_name', 'string', ['limit' => 32, 'null' => true])
            ->addColumn('department_code', 'string', ['limit' => 8, 'null' => true])
            ->addColumn('severity', 'string', ['limit' => 8, 'null' => true])
            ->addColumn('fall', 'string', ['limit' => 8, 'null' => true])
            ->addColumn('blood_warn', 'boolean', ['default' => false])
            ->addColumn('contact_warn', 'boolean', ['default' => false])
            ->addColumn('air_warn', 'boolean', ['default' => false])
            ->addColumn('current_flag', 'boolean', ['default' => true])
            ->addColumn('remarks', 'text', ['null' => true])
            ->addColumn('creator_id', 'biginteger', ['null' => true])
            ->addColumn('updater_id', 'biginteger', ['null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
            ->addColumn('deleted_at', 'timestamp', ['null' => true])
            ->create();
    }
}
