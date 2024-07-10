<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateCustomers extends AbstractMigration
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
        $table = $this->table('customers');
        $table->addColumn('customer_no', 'string', ['limit' => 32])
        ->addColumn('name', 'string', ['limit' => 32])
        ->addColumn('sex', 'string', ['limit' => 2, 'default' => '1'])
        ->addColumn('birthdate', 'string', ['limit' => 8, 'null' => true])
        ->addColumn('telephone', 'string', ['limit' => 32, 'null' => true])
        ->addColumn('address', 'string', ['limit' => 200, 'null' => true])
        ->addColumn('ward_code', 'string', ['limit' => 10, 'null' => true])
        ->addColumn('room_code', 'string', ['limit' => 10, 'null' => true])
        ->addColumn('bed_no', 'string', ['limit' => 5, 'null' => true])
        ->addColumn('blood_type', 'string', ['limit' => 2, 'null' => true])
        ->addColumn('severity', 'string', ['limit' => 8, 'null' => true])
        ->addColumn('fall', 'string', ['limit' => 8, 'null' => true])
        ->addColumn('hospitalized_date', 'date', ['null' => true])
        ->addColumn('remarks', 'text', ['null' => true])
        ->addColumn('old_ward_code', 'string', ['limit' => 10, 'null' => true])
        ->addColumn('old_room_code', 'string', ['limit' => 10, 'null' => true])
        ->addColumn('old_bed_no', 'string', ['limit' => 5, 'null' => true])
        ->addColumn('status', 'string', ['limit' => 2, 'default' => '01'])
        ->addColumn('device_seq', 'biginteger', ['null' => true])
        ->addColumn('device_name', 'string', ['limit' => 100, 'null' => true])
        ->addColumn('creator_id', 'biginteger', ['null' => true])
        ->addColumn('updater_id', 'biginteger', ['null' => true])
        ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
        ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP', 'update' => 'CURRENT_TIMESTAMP'])
        ->addColumn('deleted_at', 'timestamp', ['null' => true])
        ->addIndex(['customer_no'], ['unique' => true])
        ->create();
    }
}
