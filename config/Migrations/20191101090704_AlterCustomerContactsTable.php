<?php
use Migrations\AbstractMigration;

class AlterCustomerContactsTable extends AbstractMigration
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

        $table->addColumn('name', 'string', [
            'default' => null,
            'null' => true,
            'after' => 'customer_id'
        ]);

        $table->addColumn('province_id', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'country_id'
        ]);

        $table->addColumn('city_id', 'integer', [
            'default' => null,
            'null' => true,
            'after' => 'province_id'
        ]);

        $table->addColumn('phone_1', 'string', [
            'limit' => 15,
            'default' => null,
            'null' => true,
            'after' => 'city_id'
        ]);

        $table->addColumn('phone_2', 'string', [
            'limit' => 15,
            'default' => null,
            'null' => true,
            'after' => 'phone_1'
        ]);

        $table->addColumn('address', 'string', [
            'limit' => 255,
            'default' => null,
            'null' => true,
            'after' => 'phone_2'
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);


        $table->update();
    }
}
