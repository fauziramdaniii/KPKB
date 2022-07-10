<?php
use Migrations\AbstractMigration;

class AlterCustomers3Table extends AbstractMigration
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

        $table->addColumn('customer_type_id', 'integer', [
            'default' => 1,
            'null' => true,
            'after' => 'is_active',
            'comment' => '1 member, 2 stokis'
        ]);


        $table->update();
    }
}
