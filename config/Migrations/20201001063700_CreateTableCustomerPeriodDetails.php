<?php
use Migrations\AbstractMigration;

class CreateTableCustomerPeriodDetails extends AbstractMigration
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
        $table = $this->table('customer_period_details');

        $table->addColumn('customer_period_id', 'integer', [
            'limit' => 11,
            'default' => null,
            'null' => true
        ]);

        $table->addColumn('order_id', 'integer', [
            'limit' => 11,
            'default' => null,
            'null' => true
        ]);
        $table->addColumn('amount', 'float', [
            'default' => 0,
            'null' => true,
        ]);
        $table->addColumn('created', 'date', [
            'default' => 0,
			'default' => null,
            'null' => true,
        ]);

        $table->create();
    }
}
