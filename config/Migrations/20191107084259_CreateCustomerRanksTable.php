<?php
use Migrations\AbstractMigration;

class CreateCustomerRanksTable extends AbstractMigration
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
        $table = $this->table('customer_ranks');

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('rank_id', 'integer', [
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
        $table->addIndex('rank_id');


        $table->create();
    }
}
