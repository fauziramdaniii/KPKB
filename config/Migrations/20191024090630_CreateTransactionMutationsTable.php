<?php
use Migrations\AbstractMigration;

class CreateTransactionMutationsTable extends AbstractMigration
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
        $table = $this->table('transaction_mutations');

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('transaction_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('amount', 'float', [
            'default' => 0,
            'null' => true,
        ]);

        $table->addColumn('balance', 'float', [
            'default' => 0,
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
        $table->addIndex('transaction_id');
        $table->addIndex(['customer_id', 'transaction_id']);


        $table->create();
    }
}
