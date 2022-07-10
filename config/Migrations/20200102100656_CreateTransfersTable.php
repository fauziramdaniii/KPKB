<?php
use Migrations\AbstractMigration;

class CreateTransfersTable extends AbstractMigration
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
        $table = $this->table('transfers');

        $table->addColumn('customer_id', 'integer', [
            'null' => false,
        ])->addIndex('customer_id');

        $table->addColumn('target_customer_id', 'integer', [
            'null' => false,
        ])->addIndex('target_customer_id');

        $table->addColumn('transaction_id', 'integer', [
            'null' => true,
            'default' => null
        ])->addIndex('transaction_id');

        $table->addColumn('status', 'integer', [
            'null' => true,
            'default' => 1,
            'comment' => '1 success, 2 failed'
        ]);



        $table->addColumn('amount', 'float', [
            'default' => 0,
            'null' => true,
        ]);

        $table->addColumn('fee', 'float', [
            'default' => 0,
            'null' => true,
        ]);

        $table->addColumn('description', 'string', [
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


        $table->create();
    }
}
