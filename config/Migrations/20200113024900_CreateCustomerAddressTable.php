<?php
use Migrations\AbstractMigration;

class CreateCustomerAddressTable extends AbstractMigration
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
        $table = $this->table('customer_address');

        $table->addColumn('customer_id', 'integer', [
            'default' => null,
            'null' => true,
        ])->addIndex('customer_id');


        $table->addColumn('province_id', 'integer', [
            'null' => true,
            'default' => null,
        ])->addIndex('province_id');

        $table->addColumn('city_id', 'integer', [
            'null' => true,
            'default' => null,
        ])->addIndex('city_id');

        $table->addColumn('subdistrict_id', 'integer', [
            'null' => true,
            'default' => null,
        ])->addIndex('subdistrict_id');

        $table->addColumn('zip', 'integer', [
            'limit' => 5,
            'null' => true,
            'default' => null,
        ]);

        $table->addColumn('address', 'string', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('primary', 'boolean', [
           'default' => 0,
           'null' => true
        ]);

        $table->addColumn('created', 'datetime', [
            'default' => null,
            'null' => true,
        ]);

        $table->addColumn('modified', 'datetime', [
            'default' => null,
            'null' => true,
        ]);


        $table->create();
    }
}
