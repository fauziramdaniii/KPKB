<?php
use Migrations\AbstractMigration;

class CreateCustomerBanksTable extends AbstractMigration
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
        $table = $this->table('customer_banks');

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('bank_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('branch', 'string', [
            'limit' => 50,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('city', 'string', [
            'limit' => 50,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('account_name', 'string', [
            'limit' => 50,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('account_number', 'string', [
            'limit' => 25,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addIndex('customer_id');
        $table->addIndex('bank_id');


        $table->create();
    }
}
