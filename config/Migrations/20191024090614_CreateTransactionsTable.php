<?php
use Migrations\AbstractMigration;

class CreateTransactionsTable extends AbstractMigration
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
        $table = $this->table('transactions');

        $table->addColumn('transaction_type_id', 'integer', [
            'limit' => 4,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('txid', 'string', [
            'limit' => 64,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('description', 'string', [
            'limit' => 255,
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

        $table->addIndex('txid');


        $table->create();
    }
}
