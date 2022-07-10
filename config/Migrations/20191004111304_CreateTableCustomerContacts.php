<?php
use Migrations\AbstractMigration;

class CreateTableCustomerContacts extends AbstractMigration
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
        $table = $this->table('customer_contacts');

        $table->addColumn('customer_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);

        $table->addColumn('street', 'string', [
            'limit' => 200,
            'null' => false,
        ]);
        $table->addColumn('country_id', 'integer', [
            'limit' => 11,
            'null' => false,
        ]);
        $table->addColumn('zip', 'integer', [
            'limit' => 7,
            'null' => false,
        ]);
        $table->create();
    }
}
