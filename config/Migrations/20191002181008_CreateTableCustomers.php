<?php
use Migrations\AbstractMigration;

class CreateTableCustomers extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('customers');

        $table->addColumn('username', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('email', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('first_name', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('last_name', 'string', [
            'limit' => 50,
            'null' => false,
        ]);
        $table->addColumn('country_id', 'integer', [
            'limit' => 11,
            'null' => true,
            'default' => 0,
        ]);
        $table->addColumn('phone', 'string', [
            'limit' => 15,
            'null' => false,
        ]);
        $table->addColumn('password', 'string', [
            'limit' => 255,
            'null' => false,
        ]);
        $table->addColumn('activation_code', 'string', [
            'limit' => 255,
            'null' => true,
        ]);
        $table->addColumn('is_active', 'integer', [
            'limit' => 1,
            'null' => false,
            'comment' => '0: not active, 1 : active, 2 : block'
        ]);
        $table->addColumn('created', 'datetime', [
            'null' => true,
        ]);
        $table->addColumn('last_login', 'datetime');
        $table->create();
    }
}
