<?php
use Migrations\AbstractMigration;

class AlterCustomers5Table extends AbstractMigration
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

        $table->addColumn('rank_id', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'customer_type_id',
        ]);

        $table->addIndex('rank_id');

        $table->update();
    }
}
