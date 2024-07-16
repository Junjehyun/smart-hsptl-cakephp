<?php
declare(strict_types=1);

use Migrations\AbstractMigration;

class CreateUsers extends AbstractMigration
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
        $table = $this->table('users');
        $table->addColumn('name', 'string', ['limit' => 255, 'null' => false])
                ->addColumn('email', 'string', ['limit' => 255, 'null' => false])
                ->addColumn('email_verified_at', 'timestamp', ['null' => true])
                ->addColumn('password', 'string', ['limit' => 255, 'null' => false])
                ->addColumn('two_factor_secret', 'text', ['null' => true])
                ->addColumn('two_factor_recovery_codes', 'text', ['null' => true])
                ->addColumn('two_factor_confirmed_at', 'timestamp', ['null' => true])
                ->addColumn('remember_token', 'string', ['limit' => 100, 'null' => true])
                ->addColumn('current_team_id', 'biginteger', ['null' => true])
                ->addColumn('profile_photo_path', 'string', ['limit' => 2048, 'null' => true])
                ->addColumn('telephone', 'string', ['limit' => 16, 'null' => true])
                ->addColumn('department', 'string', ['limit' => 32, 'null' => true])
                ->addColumn('employ_id', 'string', ['limit' => 32, 'null' => true])
                ->addColumn('roles', 'string', ['limit' => 3, 'null' => true])
                ->addColumn('user_type', 'string', ['limit' => 3, 'default' => '000'])
                ->addColumn('approval_date', 'datetime', ['null' => true])
                ->addColumn('approval_user', 'biginteger', ['null' => true])
                ->addColumn('last_activity_date', 'datetime', ['null' => true])
                ->addColumn('visit_count', 'biginteger', ['null' => true])
                ->addColumn('wards_in_charge', 'string', ['limit' => 1024, 'null' => true])
                ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
                ->addColumn('updated_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
                ->addColumn('deleted_at', 'timestamp', ['null' => true])
                ->addIndex(['email'], ['unique' => true])
                ->create();
    }
}
