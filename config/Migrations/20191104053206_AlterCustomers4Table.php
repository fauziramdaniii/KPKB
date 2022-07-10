<?php
use Migrations\AbstractMigration;

class AlterCustomers4Table extends AbstractMigration
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



        $table->addColumn('heir', 'string', [
            'default' => null,
            'null' => true,
            'after' => 'customer_type_id',
        ]);

        $table->addColumn('heir_relation', 'string', [
            'default' => null,
            'null' => true,
            'after' => 'heir',
        ]);


        $table->update();
    }
}
