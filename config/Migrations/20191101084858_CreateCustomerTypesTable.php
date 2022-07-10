<?php
use Migrations\AbstractMigration;

class CreateCustomerTypesTable extends AbstractMigration
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
        $table = $this->table('customer_types');

        $table->addColumn('name', 'string', [
            'limit' => 150,
            'default' => null,
            'null' => true,
        ]);


        $table->create();
    }
}
