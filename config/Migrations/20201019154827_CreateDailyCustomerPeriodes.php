<?php
use Migrations\AbstractMigration;

class CreateDailyCustomerPeriodes extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('daily_customer_periods');

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ])
        ->addIndex('customer_id');


        $table->addColumn('customer_periods_id', 'integer', [
            'default' => null,
            'null' => true,
        ])
        ->addIndex('customer_periods_id');

        $table->addColumn('date_called', 'date', [
            'default' => null,
            'null' => true
        ])
        ->addIndex('date_called');

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->create();
    }
}
