<?php
use Migrations\AbstractMigration;

class CreateTableCustomerActivations extends AbstractMigration
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
        $table = $this->table('customer_activations');

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);


        $table->addColumn('customer_bank_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);
        $table->addColumn('destination_bank', 'string', [
            'limit' => 150,
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('amount', 'float', [
            'default' => 0,
            'null' => true,
        ]);

        $table->addColumn('confirmation_date', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('image_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('note', 'string', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('status', 'integer', [
            'default' => 0,
            'null' => true,
            'comment' => '0 waiting, 1 sukses, 2 failed'
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
        $table->addIndex('customer_bank_id');
        $table->addIndex('image_id');


        $table->create();
    }
}
